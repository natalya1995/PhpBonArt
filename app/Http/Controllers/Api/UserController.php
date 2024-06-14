<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
 
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Валидация запроса
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        // Обновить данные пользователя
        $user->update([
            'name' => $validatedData['name'] ?? $user->name,
            'email' => $validatedData['email'] ?? $user->email,
            'password' => isset($validatedData['password']) ? Hash::make($validatedData['password']) : $user->password,
        ]);

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }


    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

      
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
