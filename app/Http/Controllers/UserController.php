<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\HolidayPlan;
use App\Models\User;
use FontLib\TrueType\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all users",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                   @OA\Property(property="name", type="string", example="test"),
     *                   @OA\Property(property="email", type="string", example="test@gmail.com"),
     *                   @OA\Property(property="password", type="string", example="12345")
     *               )
     *          )
     *     ),
     *     @OA\Response(response="401", description="Unauthorized")
     * )
     *
     * @return EloquentCollection
     */
    public function list(): EloquentCollection
    {
        return User::all();
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Get user by ID",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         description="User ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer", example="2"),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="name", type="string", example="test"),
     *                  @OA\Property(property="email", type="string", example="test@gmail.com"),
     *                  @OA\Property(property="password", type="string", example="12345")
     *              )
     *         )
     *     ),
     *     @OA\Response(response="404", description="User not found")
     * )
     *
     * @param int $id
     * @return User
     */
    public function listById(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Create a new user",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="test"),
     *             @OA\Property(property="email", type="string", example="test@gmail.com"),
     *             @OA\Property(property="password", type="string", example="12345")
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="User created successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="name", type="string", example="test"),
     *                  @OA\Property(property="email", type="string", example="test@gmail.com"),
     *                  @OA\Property(property="password", type="string", example="12345")
     *              )
     *          )
     *      ),
     *     @OA\Response(response="422", description="Unprocessable Entity")
     * )
     *
     * @param UserRequest $req
     * @return JsonResponse
     */
    public function add(UserRequest $req): JsonResponse
    {
        $data = $req->all();
        $data['password'] = bcrypt($req->password);
        $user = User::create($data);
        return response()->json([
            "data"=>$user
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Edit a user",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          description="User ID",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(type="integer", example="2"),
     *      ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="test"),
     *             @OA\Property(property="email", type="string", example="test@gmail.com"),
     *             @OA\Property(property="password", type="string", example="12345")
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="User edited successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="name", type="string", example="test"),
     *                  @OA\Property(property="email", type="string", example="test@gmail.com"),
     *                  @OA\Property(property="password", type="string", example="12345")
     *              )
     *          )
     *      ),
     *     @OA\Response(response="422", description="Unprocessable Entity"),
     *     @OA\Response(response="404", description="Plan not found")
     * )
     *
     * @param UserRequest $req
     * @param int $id
     * @return JsonResponse
     */
    public function edit(UserRequest $req, int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $data = $req->all();
        $user->update($data);
        return response()->json([
            "data"=>$user
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer", example="2")
     *     ),
     *     @OA\Response(response="200", description="User deleted successfully",
     *           @OA\JsonContent(
     *               @OA\Property(
     *                  property="data",
     *                  type="string",
     *                  example="User deleted with success"
     *               )
     *           )
     *     ),
     *     @OA\Response(response="404", description="User not found"),
     * )
     *
     * @param int $id
     * @return jsonResponse
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data'=>'User deleted with success'], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/users/{id_event}",
     *     tags={"Users"},
     *     security={{"bearerAuth": {}}},
     *     summary="Attach an user to an event",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Event ID",
     *         required=true,
     *         @OA\Schema(type="integer", example="2")
     *     ),
     *     @OA\Response(response="200", description="User participate of an event",
     *           @OA\JsonContent(
     *               @OA\Property(
     *                  property="data",
     *                  type="string",
     *                  example="User is now participating of the event: Event"
     *               )
     *           )
     *     ),
     *     @OA\Response(response="404", description="Plan not found")
     * )
     *
     * @param int $id
     * @return jsonResponse
     */
    public function participate(int $id_event): JsonResponse
    {
        $user = auth()->user()->load('plans');
        $event = HolidayPlan::findOrFail($id_event);

        if($user->plans->contains($event)){
            return response()->json([
                "message"=>"User already participating of this event"
            ], 400);
        }
        $user->plans()->attach($id_event);

        return response()->json([
            "data"=>"$user->name is now participating of the event: $event->title"
         ], 200);
    }
}
