<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\Requests;

use Ebolution\BaseCrudModule\Infrastructure\Contracts\ValidatorLoaderInterface;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;
use Illuminate\Validation\Rule;

class UpdateRequest implements ValidatorLoaderInterface
{
    // TODO: Add your simple validation rules here
    protected array $rules = [];

    // TODO: Add your validation error messages here
    protected array $messages = [];

    public function load(SaveRequest $request): void
    {
        // TODO: Add your complex validation rules here

        $request->load($this->rules, $this->messages);
    }
}
