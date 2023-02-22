<?php

namespace App\Repositories;

interface CompanyRepositoryInterface
{
    public function getCompanies(string $filter): object;
    public function create(array $data): object;
    public function show(string $uuid): object;
    public function update(string $uuid, array $data): bool;
    public function delete(string $uuid): bool;
}
