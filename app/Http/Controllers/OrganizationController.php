<?php
namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        return Organization::with('users')->paginate(15);
    }

    public function show(Organization $organization)
    {
        return $organization->load('users', 'animals');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Organization::class);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2'
        ]);

        $organization = Organization::create($data);

        $organization->users()->attach($request->user()->id, ['role' => 'owner']);

        return response()->json($organization, 201);
    }

    public function update(Request $request, Organization $organization)
    {
        $this->authorize('update', $organization);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'email' => 'sometimes|email',
            'phone' => 'nullable|string',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string|max:2'
        ]);

        $organization->update($data);

        return response()->json($organization);
    }

    public function destroy(Organization $organization)
    {
        $this->authorize('delete', $organization);

        $organization->delete();

        return response()->json(['message' => 'Organização removida']);
    }
}