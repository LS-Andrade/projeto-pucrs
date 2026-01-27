<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        return User::orderBy('created_at', 'desc')->paginate(10);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated() + [
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated() + [
            'updated_by' => auth()->id(),
        ]);
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
