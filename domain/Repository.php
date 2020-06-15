<?php
declare(strict_types=1);

namespace Domain;

/**
 * Interface Repository
 * @package Domain
 */
interface Repository
{
    public function find(Id $id): Entity;

    public function delete(Id $id): void;

    public function create(Entity $entity): void;

    public function update(Entity $entity): void;

    public function fetch(Query $query): array;
}
