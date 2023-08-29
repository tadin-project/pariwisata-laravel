<?php

namespace App\Services;

interface UserService
{
    public function getData(string $type, string $where = "", string $order = "", string $limit = "", array $column = []): array;
    public function getGroup(): array;
}
