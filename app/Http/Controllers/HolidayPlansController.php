<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayPlanRequest;
use App\Models\HolidayPlan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HolidayPlansController extends Controller
{
    public function list(): Collection
    {
        return HolidayPlan::all();
    }

    public function listById(int $id): HolidayPlan
    {
        return HolidayPlan::findOrFail($id);
    }

    public function add(HolidayPlanRequest $req): HolidayPlan
    {
        $data = $req->all();
        return HolidayPlan::create($data);
    }

    public function edit(HolidayPlanRequest $req, int $id): HolidayPlan
    {
        $holiday_plan = HolidayPlan::findOrFail($id);
        $data = $req->all();
        $holiday_plan->update($data);
        return $holiday_plan;
    }

    public function destroy(int $id): JsonResponse
    {
        $clinic = HolidayPlan::findOrFail($id);
        $clinic->delete();
        return response()->json(['message'=>'Holiday plan deleted with success'], 200);
    }
}
