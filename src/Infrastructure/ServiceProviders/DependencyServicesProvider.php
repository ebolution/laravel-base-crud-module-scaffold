<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\ServiceProviders;

use Ebolution\BaseCrudModule\Application\Collaborator\RequestDataProcessor;
use Ebolution\BaseCrudModule\Domain\Contracts;
use Ebolution\BaseCrudModule\Domain\Contracts\RequestDataProcessorInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases;
use Ebolution\BaseCrudModule\Domain\SaveRequestFactory;
use Ebolution\BaseCrudModule\Infrastructure\Contracts\ValidatorLoaderInterface;
use Ebolution\BaseCrudModuleScaffold\Application;
use Ebolution\BaseCrudModuleScaffold\Infrastructure\Controllers;
use Ebolution\BaseCrudModuleScaffold\Infrastructure\Repositories\EloquentRepository;
use Ebolution\BaseCrudModuleScaffold\Infrastructure\Requests\SaveRequest;
use Ebolution\BaseCrudModuleScaffold\Infrastructure\Requests\UpdateRequest;
use Illuminate\Support\ServiceProvider;

final class DependencyServicesProvider extends ServiceProvider
{
    private array $defaultImplementations = [
        Contracts\RepositoryInterface::class => EloquentRepository::class,
        Contracts\SaveRequestFactoryInterface::class => SaveRequestFactory::class,
        RequestDataProcessorInterface::class => RequestDataProcessor::class,
    ];

    private array $useCases = [
        Application\Create\CreateUseCase::class => [
            Contracts\RepositoryInterface::class,
            Contracts\SaveRequestFactoryInterface::class,
            RequestDataProcessorInterface::class,
        ],
        Application\Delete\DeleteByIdUseCase::class => [
            Contracts\RepositoryInterface::class
        ],
        Application\Read\FindByIdUseCase::class => [
            Contracts\RepositoryInterface::class
        ],
        Application\Read\FindAllUseCase::class => [
            Contracts\RepositoryInterface::class
        ],
        Application\Update\UpdateByIdUseCase::class => [
            Contracts\RepositoryInterface::class,
            RequestDataProcessorInterface::class,
        ],
    ];

    public function register(): void
    {
        $this->loadUseCases();
        $this->loadControllers();
        $this->loadHttpApi();
        $this->loadFormRequests();
    }

    private function loadUseCases(): void
    {
        foreach ($this->useCases as $useCase => $interfaces) {
            foreach ($interfaces as $interface) {
                if (array_key_exists($interface, $this->defaultImplementations)) {
                    $this->app
                        ->when($useCase)
                        ->needs($interface)
                        ->give($this->defaultImplementations[$interface]);
                }
            }
        }
    }

    private function loadControllers(): void
    {
        $this->app
            ->when(Controllers\DeleteByIdController::class)
            ->needs(UseCases\DeleteInterface::class)
            ->give(Application\Delete\DeleteByIdUseCase::class);

        $this->app
            ->when(Controllers\FindAllController::class)
            ->needs(UseCases\FindAllInterface::class)
            ->give(Application\Read\FindAllUseCase::class);

        $this->app
            ->when(Controllers\FindByIdController::class)
            ->needs(UseCases\FindByIdInterface::class)
            ->give(Application\Read\FindByIdUseCase::class);

        $this->app
            ->when(Controllers\UpdateByIdController::class)
            ->needs(UseCases\UpdateInterface::class)
            ->give(Application\Update\UpdateByIdUseCase::class);
    }

    private function loadHttpApi(): void
    {
        $this->app
            ->when(Controllers\SaveController::class)
            ->needs(UseCases\CreateInterface::class)
            ->give(Application\Create\CreateUseCase::class);

        $this->app
            ->when(Controllers\Http\Api\Delete::class)
            ->needs(Contracts\ControllerRequestByIdInterface::class)
            ->give(Controllers\DeleteByIdController::class);

        $this->app
            ->when(Controllers\Http\Api\Find::class)
            ->needs(Contracts\ControllerRequestByIdInterface::class)
            ->give(Controllers\FindByIdController::class);

        $this->app
            ->when(Controllers\Http\Api\FindAll::class)
            ->needs(Contracts\ControllerInterface::class)
            ->give(Controllers\FindAllController::class);

        $this->app
            ->when(Controllers\Http\Api\Save::class)
            ->needs(Contracts\ControllerSaveRequestInterface::class)
            ->give(Controllers\SaveController::class);

        $this->app
            ->when(Controllers\Http\Api\Update::class)
            ->needs(Contracts\ControllerRequestByIdInterface::class)
            ->give(Controllers\UpdateByIdController::class);
    }

    private function loadFormRequests(): void
    {
        $this->app
            ->when(Controllers\Http\Api\Save::class)
            ->needs(ValidatorLoaderInterface::class)
            ->give(SaveRequest::class);

        $this->app
            ->when(Controllers\Http\Api\Update::class)
            ->needs(ValidatorLoaderInterface::class)
            ->give(UpdateRequest::class);
    }
}
