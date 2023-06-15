<?php
namespace DAO\Interfaces;

use Modelos\Entity;

interface IServices {

    public function getAll(): array;
    public function get(int $id): ?array;
    public function register(Entity $entity): ?Entity;
    public function update(Entity $entity,int $id): ?Entity;
    public function delete(int $id): bool;
    public function getEntityServiceName(): string;
}