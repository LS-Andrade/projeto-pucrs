<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Registrar novo usuário
     * 
     * Cria uma nova conta de usuário no sistema.
     * 
     * @group Autenticação
     * @unauthenticated
     * 
     * @bodyParam name string required Nome completo do usuário. Example: João Silva
     * @bodyParam email string required E-mail do usuário. Example: joao@example.com
     * @bodyParam password string required Senha (mínimo 6 caracteres). Example: senha123
     * @bodyParam password_confirmation string required Confirmação da senha. Example: senha123
     * @bodyParam role string required Tipo de usuário (admin, protector, adopter). Example: adopter
     * 
     * @response 201 {
     *   "user": {
     *     "id": 1,
     *     "name": "João Silva",
     *     "email": "joao@example.com",
     *     "role": "adopter",
     *     "created_at": "2026-01-27T10:00:00.000000Z"
     *   },
     *   "token": "1|abcdefghijklmnopqrstuvwxyz123456789"
     * }
     * 
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "email": ["The email has already been taken."]
     *   }
     * }
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,protector,adopter'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return response()->json(compact('user', 'token'), 201);
    }

    /**
     * Login de usuário
     * 
     * Autentica um usuário e retorna um token de acesso.
     * 
     * @group Autenticação
     * @unauthenticated
     * 
     * @bodyParam email string required E-mail do usuário. Example: joao@example.com
     * @bodyParam password string required Senha do usuário. Example: senha123
     * 
     * @response 200 {
     *   "user": {
     *     "id": 1,
     *     "name": "João Silva",
     *     "email": "joao@example.com",
     *     "role": "adopter"
     *   },
     *   "token": "1|abcdefghijklmnopqrstuvwxyz123456789"
     * }
     * 
     * @response 401 {
     *   "message": "Credenciais inválidas"
     * }
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('api')->plainTextToken;

        return response()->json(compact('user', 'token'));
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}