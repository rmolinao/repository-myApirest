<?php
namespace Servicios;

use Modelos\Entity;
use DAO\Interfaces\IServices;
use DAO\Interfaces\ICrudRepository;

class Servicio implements IServices
{   
    private 
        $daoImplement,
        $entityServiceName;
    public function __construct(ICrudRepository $daoImplement, string $entityServiceName)
    {
        $this->daoImplement = $daoImplement;
        $this->entityServiceName = $entityServiceName;             
    }
    
    public function getAll($page = 1): array
    {
        return $this->daoImplement->findAll($page);
    }

    public function get(int $id): ?array
    {
        return  $this->daoImplement->findById($id);
    }

    public function register(Entity $entity): ?Entity
    {
        $numberRowsAffected = $this->daoImplement->save($entity);
        if ($numberRowsAffected > 0) {
            return $entity;
        }
        return null;
    }

    public function update(Entity $entity, int $id): ?Entity
    {
        $attributelist = $this->daoImplement->findById($id);
        foreach ($entity->attributelist as $key => $value) {
            $attributelist[$key] = $entity->attributelist[$key];
        }
        $entity = new Entity($entity->getName(),$attributelist);
        $numberRowsAffected = $this->daoImplement->save($entity);

        if ($numberRowsAffected > 0) {
            return $entity;
        }
        return null;
    }

    public function delete(int $id): bool
    {
        return $this->daoImplement->deleteById($id) > 0;
    }

    public function getEntityServiceName(): string
    {
        return $this->entityServiceName;
    }
}