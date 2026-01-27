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
        return Organization::with('users')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function show(Organization $organization)
    {
        return $organization->load('users');
    }

    public function store(OrganizationStoreRequest $request)
    {
        return Organization::create($request->validated() + [
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }

    public function update(OrganizationUpdateRequest $request, Organization $organization)
    {
        $organization->update($request->validated() + [
            'updated_by' => auth()->id(),
        ]);
        return $organization;
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response()->noContent();
    }
}
