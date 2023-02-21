<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAll(): object;
    public function create(array $data): object;
    public function show(string $slug): object;
    public function update(string $slug, array $data): bool;
    public function delete(string $slug): bool;
}
