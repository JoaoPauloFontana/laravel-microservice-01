<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompany;
use App\Http\Resources\CompanyResource;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): object
    {
        $companies = $this->companyService->getCompanies($request->get('filter', ''));

        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCompany $request): object
    {
        $data = $request->all();

        $category = $this->companyService->create($data);

        return new CompanyResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid): object
    {
        $company = $this->companyService->show($uuid);

        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $uuid): object
    {
        $data = $request->all();

        $response = $this->companyService->update($uuid, $data);

        return response()->json(['updated' => $response]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $uuid): object
    {
        $response = $this->companyService->delete($uuid);

        return response()->json(['deleted' => $response], 204);
    }
}
