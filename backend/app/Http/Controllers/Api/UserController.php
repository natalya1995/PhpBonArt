<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;

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
    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();
        $user=User::create($validatedData);
        return response()->json($user, 201);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update([
            'name' =>'gdfdfgdf',
            'email' => 'nata@gdgsd.com',
            'phone' =>'275252',
            'bit_id' =>null,
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
