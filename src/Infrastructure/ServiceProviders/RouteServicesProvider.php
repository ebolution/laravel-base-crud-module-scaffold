<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */


namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\ServiceProviders;

use Ebolution\ModuleManager\Infrastructure\ServiceProviders\RouteServicesProvider as ModuleManagerRouteServicesProvider;

class RouteServicesProvider extends ModuleManagerRouteServicesProvider
{
    const BASE_PATH = __DIR__;
}
