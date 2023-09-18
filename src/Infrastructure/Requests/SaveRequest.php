<?php

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\Requests;

use Ebolution\BaseCrudModule\Infrastructure\Contracts\ValidatorLoaderInterface;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest as BaseSaveRequest;

final class SaveRequest implements ValidatorLoaderInterface
{
    // TODO: Add your simple validation rules here
    protected array $rules = [];

    // TODO: Add your validation error messages here
    protected array $messages = [];

    public function load(BaseSaveRequest $request): void
    {
        // TODO: Add your complex validation rules here

        $request->load($this->rules, $this->messages);
    }
}
