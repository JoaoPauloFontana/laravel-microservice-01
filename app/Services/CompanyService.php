<?php

namespace App\Services;

use App\Repositories\CompanyRepositoryInterface;

class CompanyService
{
    private $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getCompanies(string $filter = '')
    {
        return $this->repository
                        ->getCompanies($filter);
    }

    public function create(array $data): object
    {
        $company = $this->repository->create($data);

        return $company;
    }

    public function show(string $uuid): object
    {
        $company = $this->repository->show($uuid);

        return $company;
    }

    public function update(string $uuid, array $data): bool
    {
        $response = $this->repository->update($uuid, $data);

        return $response;
    }

    public function delete(string $uuid): bool
    {
        $response = $this->repository->delete($uuid);

        return $response;
    }
}
