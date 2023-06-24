<?php
namespace DAO\Interfaces;

use Modelos\Entity;

interface ICrudRepository {
    public function findAll(): array;
    public function save(Entity $entity): int;
    public function findById(int $id): ?array;
    public function deleteById(int $id): int;

}