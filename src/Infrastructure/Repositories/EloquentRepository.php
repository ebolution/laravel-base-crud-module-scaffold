<?php
/**
 * @category  Ebolution
 * @package   Ebolution/__MODULE__
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\Repositories;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\SaveRequest;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;

class EloquentRepository implements RepositoryInterface
{

    public function findAll(): array
    {
        return [];
    }

    public function findById(Id $id): ?array
    {
        return [
            'id' => 1
        ];
    }

    public function deleteById(Id $id): bool
    {
        return true;
    }

    public function create(SaveRequest $request): ?int
    {
        return 1;
    }

    public function updateById(Id $id, SaveRequest $request): ?int
    {
        return 1;
    }
}