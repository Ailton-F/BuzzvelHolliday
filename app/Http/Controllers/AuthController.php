<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Authentication"},
     *     summary="Login the user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="test@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(response="200", description="OK",
     *         @OA\JsonContent(
     *         @OA\Property(property="token", type="string", example="0|lMjfIugpopAsJma2xZHGJ3RdR0873ExvENwdFOxhww2fabbd")
     *     )),
     *     @OA\Response(response="422", description="Unprocessable Entity")
     * )
     *
     * @param AuthRequest $req
     * @return JsonResponse
     */
    public function login(AuthRequest $req) : JsonResponse
    {
        $data = $req->all();
        $user = User::where('email', $data['email'])->first();
        if(password_verify($data['password'], $user['password'])) {
            return response()->json([
                "token"=>$user->createToken(time()*60)->plainTextToken
            ], 200);
        }
        return response()->json([
            "error"=>"unauthorized"
        ], 401);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout the user, deleting the token",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Loged out",
     *     @OA\JsonContent(
     *          @OA\Property(property="data", type="string", example="loged out with success")
     *      )),
     *     ),
     *     @OA\Response(response="403", description="Unauthorized",
     *          @OA\JsonContent(
     *           @OA\Property(property="data", type="string", example="Unauthenticated")
     *       )),
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function logout(Request $req): JsonResponse
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json([
            "data"=>"loged out with success"
        ], 200);
    }
}
