<?php
namespace DAO\Interfaces;

interface IConexion {
    
    public static function getConnectionInstance(): IConexion;

    public function getRecord(string $query, array $parameters = null): ?array;

    public function nonQuery(string $query, array $parameters = null): int;

    public function nonQueryID(string $query, array $parameters = null): int;

}