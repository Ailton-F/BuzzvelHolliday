<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayPlanRequest;
use App\Models\HolidayPlan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class HolidayPlansController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/holiday-plans",
     *     tags={"Holiday plans"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all plans",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(
     *               @OA\Property(property="data", type="object",
     *                    @OA\Property(property="title", type="string", example="Halloween"),
     *                    @OA\Property(property="description", type="string", example="costume party"),
     *                    @OA\Property(property="location", type="string", example="Wallstreet, 25"),
     *                    @OA\Property(property="date", type="string", example="YYYY-MM-DD"),
     *                )
     *           )
     *     )
     * )
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return HolidayPlan::all()->load('participants');
    }

    /**
     * @OA\Get(
     *     path="/api/holiday-plans/{id}",
     *     tags={"Holiday plans"},
     *     summary="Get plan by ID",
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
     *                 @OA\Property(property="data", type="object",
     *                     @OA\Property(property="title", type="string", example="Halloween"),
     *                     @OA\Property(property="description", type="string", example="costume party"),
     *                     @OA\Property(property="location", type="string", example="Wallstreet, 25"),
     *                     @OA\Property(property="date", type="string", example="YYYY-MM-DD"),
     *                 )
     *         )
     *         )
     *     ),
     *     @OA\Response(response="404", description="User not found")
     * )
     *
     * @param int $id
     * @return HolidayPlan
     */
    public function listById(int $id): HolidayPlan
    {
        return HolidayPlan::findOrFail($id)->load('participants');
    }

    /**
     * @OA\Post(
     *     path="/api/holiday-plans",
     *     tags={"Holiday plans"},
     *     summary="Create a new plan",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *               @OA\Property(property="data", type="object",
     *                     @OA\Property(property="title", type="string", example="Halloween"),
     *                     @OA\Property(property="description", type="string", example="costume party"),
     *                     @OA\Property(property="location", type="string", example="Wallstreet, 25"),
     *                     @OA\Property(property="date", type="string", example="YYYY-MM-DD")
     *               )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="User created successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                     @OA\Property(property="title", type="string", example="Halloween"),
     *                     @OA\Property(property="description", type="string", example="costume party"),
     *                     @OA\Property(property="location", type="string", example="Wallstreet, 25"),
     *                     @OA\Property(property="date", type="string", example="YYYY-MM-DD"),
     *              )
     *          )
     *      ),
     *     @OA\Response(response="422", description="Unprocessable Entity")
     * )
     *
     * @param HolidayPlanRequest $req
     * @return JsonResponse
     */
    public function add(HolidayPlanRequest $req): JsonResponse
    {
        $data = $req->all();
        $plan = HolidayPlan::create($data);
        return response()->json([
            "data"=>$plan
        ], 200);
    }
    /**
     * @OA\Put(
     *     path="/api/holiday-plans/{id}",
     *     tags={"Holiday plans"},
     *     summary="Edit a plan",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          description="Plan ID",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(type="integer", example="2"),
     *      ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *              @OA\Property(property="title", type="string", example="Halloween"),
     *              @OA\Property(property="description", type="string", example="costume party"),
     *              @OA\Property(property="location", type="string", example="Wallstreet, 25"),
     *              @OA\Property(property="date", type="string", example="YYYY-MM-DD"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="User edited successfully",
     *               @OA\Property(property="data", type="object",
     *                      @OA\Property(property="title", type="string", example="Halloween"),
     *                      @OA\Property(property="description", type="string", example="costume party"),
     *                      @OA\Property(property="location", type="string", example="Wallstreet, 25"),
     *                      @OA\Property(property="date", type="string", example="YYYY-MM-DD"),
     *               )
     *      ),
     *     @OA\Response(response="422", description="Unprocessable Entity")
     * )
     *
     * @param HolidayPlanRequest $req
     * @param int $id
     * @return JsonResponse
     */
    public function edit(HolidayPlanRequest $req, int $id): JsonResponse
    {
        $holiday_plan = HolidayPlan::findOrFail($id);
        $data = $req->all();
        $holiday_plan->update($data);
        return response()->json([
            "data"=>$holiday_plan
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/holiday-plans/{id}",
     *     tags={"Holiday plans"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete plan by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Plan ID",
     *         required=true,
     *         @OA\Schema(type="integer", example="2")
     *     ),
     *     @OA\Response(response="200", description="Plan deleted successfully",
     *           @OA\JsonContent(
     *               @OA\Property(
     *                  property="data",
     *                  type="string",
     *                  example="Holiday plan deleted with success"
     *               )
     *           )
     *     ),
     *     @OA\Response(response="404", description="User not found")
     * )
     *
     * @param int $id
     * @return jsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $holiday_plan = HolidayPlan::findOrFail($id);
        $holiday_plan->delete();
        return response()->json(['data'=>'Holiday plan deleted with success'], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/holiday-plans/get-pdf/{id}",
     *     tags={"Holiday plans"},
     *     security={{"bearerAuth": {}}},
     *     summary="Generate a pdf of the plan based on plan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Plan ID",
     *         required=true,
     *         @OA\Schema(type="integer", example="2")
     *     ),
     *     @OA\Response(response="200", description="Generate a pdf in another page"),
     *     @OA\Response(response="404", description="Plan not found")
     * )
     *
     * @param int $id
     * @return Response | JsonResponse
     */
    public function getPdf(int $id): Response | JsonResponse
    {
        $holiday_plan = HolidayPlan::findOrFail((int) $id)->load('participants')->toArray();
        return Pdf::loadView('pdf', $holiday_plan)
            ->setPaper('a4')
            ->stream();
    }
}
