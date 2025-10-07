<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        try {
            // Obtener todos los usuarios usando el procedimiento almacenado
            $users = DB::select('CALL sp_get_all_users()');
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener usuarios',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'phone' => 'required|string',
                'rol' => 'sometimes|string',
                'password' => 'required|string|min:6'
            ]);

            // Usar procedimiento almacenado para crear usuario
            $user = DB::select('CALL sp_create_user(?, ?, ?, ?, ?)', [
                $request->name,
                $request->email,
                $request->phone,
                $request->rol ?? 'user', // Valor por defecto 'user'
                $request->password
            ]);

            return response()->json($user[0], Response::HTTP_CREATED);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Error de validación',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear usuario',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        try {
            // Usar procedimiento almacenado para obtener usuario por ID
            $user = DB::select('CALL sp_get_user_by_id(?)', [$id]);
            
            if (empty($user)) {
                return response()->json([
                    'error' => 'Usuario no encontrado'
                ], 404);
            }

            return response()->json($user[0]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener usuario',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'error' => 'Usuario no encontrado'
                ], 404);
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required|string',
                'rol' => 'sometimes|string'
            ]);

            // Usar procedimiento almacenado para actualizar usuario
            $updatedUser = DB::select('CALL sp_update_user(?, ?, ?, ?, ?)', [
                $id,
                $request->name,
                $request->email,
                $request->phone,
                $request->rol ?? $user->rol
            ]);

            return response()->json($updatedUser[0]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Error de validación',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar usuario',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified user.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'error' => 'Usuario no encontrado'
                ], 404);
            }

            // Usar procedimiento almacenado para eliminar usuario
            DB::select('CALL sp_delete_user(?)', [$id]);

            return response()->json([
                'message' => 'Usuario eliminado correctamente'
            ], Response::HTTP_NO_CONTENT);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar usuario',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}