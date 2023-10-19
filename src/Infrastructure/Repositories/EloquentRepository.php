<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\Repositories;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\SaveRequest;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Ebolution\BaseCrudModuleScaffold\Infrastructure\Models\BaseCrudModuleScaffoldEntity;

class EloquentRepository implements RepositoryInterface
{
    public function __construct(
        private readonly BaseCrudModuleScaffoldEntity $model
    ) {}


    public function findAll(): array
    {
        return $this->model->all()->toArray();
    }

    public function findById(Id $id): ?array
    {
        $response = $this->model->find($id->value());
        return $response ? $response->toArray() : [];
    }

    public function deleteById(Id $id): bool
    {
        return $this->model->where('id', $id->value())->delete();
    }

    public function create(SaveRequest $request): ?int
    {
        $response = $this->model->create($request->handler());
        return $response ? $response->id : null;
    }

    public function updateById(Id $id, SaveRequest $request): ?int
    {
        $response = $this->model->findOrFail($id->value())->update($request->handler());
        return $response ? $id->value() : null;
    }
}
