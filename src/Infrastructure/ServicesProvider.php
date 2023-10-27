<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure;

use Ebolution\ModuleManager\Infrastructure\ServicesProvider as ModuleManagerServiceProviders;

final class ServicesProvider extends ModuleManagerServiceProviders
{
    const BASE_DIR = __DIR__;

    protected $providers = [
        ServiceProviders\DependencyServicesProvider::class,
        ServiceProviders\RouteServicesProvider::class
    ];

    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->registerMigrations();
        }
    }
}
