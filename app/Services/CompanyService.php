<?php

namespace App\Services;

use App\Repositories\CompanyRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    public function create(array $data, UploadedFile $image): object
    {
        $path = $this->uploadImage($image);
        $data['image'] = $path;

        $company = $this->repository->create($data);

        return $company;
    }

    public function show(string $uuid): object
    {
        $company = $this->repository->show($uuid);

        return $company;
    }

    public function update(string $uuid = '', array $data, UploadedFile $image = null): bool
    {
        $company = $this->repository->getCompanyByUUID($uuid);

        if ($image) {
            if (Storage::exists($company->image)) Storage::delete($company->image);

            $path = $this->uploadImage($image);
            $data['image'] = $path;
        }

        $response = $this->repository->update($uuid, $data);

        return $response;
    }

    public function delete(string $uuid): bool
    {
        $response = $this->repository->delete($uuid);

        return $response;
    }

    private function uploadImage(UploadedFile $image)
    {
        return $image->store('companies');
    }
}
