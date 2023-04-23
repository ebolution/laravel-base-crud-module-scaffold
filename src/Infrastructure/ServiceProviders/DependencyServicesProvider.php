<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\ServiceProviders;

use Ebolution\BaseCrudModule\Domain\Contracts;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases;
use Ebolution\BaseCrudModuleScaffold\Application;
use Ebolution\BaseCrudModuleScaffold\Infrastructure\Controllers;
use Ebolution\BaseCrudModuleScaffold\Infrastructure\Repositories\EloquentRepository;
use Illuminate\Support\ServiceProvider;

final class DependencyServicesProvider extends ServiceProvider
{
    private array $useCases = [
        Application\Create\CreateUseCase::class,
        Application\Delete\DeleteByIdUseCase::class,
        Application\Read\FindByIdUseCase::class,
        Application\Read\FindAllUseCase::class,
        Application\Update\UpdateByIdUseCase::class
    ];

    public function register(): void
    {
        $this->loadUseCases();
        $this->loadControllers();
        $this->loadHttpApi();
    }

    private function loadUseCases(): void
    {
        foreach ($this->useCases as $useCase) {
            $this->app
                ->when($useCase)
                ->needs(Contracts\RepositoryInterface::class)
                ->give(EloquentRepository::class);
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
}