<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getCompanies(string $filter): object
    {
        $companies = $this->company->with('category')
                            ->where(function ($query) use ($filter) {
                                if ($filter != '') {
                                    $query->where('name', 'LIKE', "%{$filter}%");
                                    $query->orWhere('email', '=', $filter);
                                    $query->orWhere('phone', '=', $filter);
                                }
                            })
                            ->paginate();

        return $companies;
    }

    public function getCompanyByUUID(string $uuid): ?object
    {
        $company = $this->company
                            ->where('uuid', $uuid)
                                ->first();

        return $company;
    }

    public function create(array $data): object
    {
        $company = $this->company->create($data);

        return $company;
    }

    public function show(string $uuid): object
    {
        $company = $this->company->where('uuid', $uuid)
                                            ->firstOrFail();

        return $company;
    }

    public function update(string $uuid, array $data): bool
    {
        $response = $this->company->where('uuid', $uuid)
                                            ->firstOrFail()
                                                ->update($data);

        return $response;
    }

    public function delete(string $uuid): bool
    {
        $response = $this->company->where('uuid', $uuid)
                                            ->firstOrFail()
                                                ->delete();

        return $response;
    }
}

