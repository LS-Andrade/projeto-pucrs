<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationStoreRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Organization::class, 'organization');
    }

    public function index()
    {
        return Organization::with('users')->paginate();
    }

    public function show(Organization $organization)
    {
        return $organization->load('users');
    }

    public function store(OrganizationStoreRequest $request)
    {
        return Organization::create($request->validated());
    }

    public function update(OrganizationUpdateRequest $request, Organization $organization)
    {
        $organization->update($request->validated());
        return $organization;
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response()->noContent();
    }
}
