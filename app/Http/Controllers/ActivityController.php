<?php

namespace App\Http\Controllers;

use App\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activityService;

    /**
     * ActivityController constructor.
     *
     * @return void
     */
    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Get list Activities
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestActivity()
    {
        $activities = $this->activityService->getLatestActivity(auth()->user());
        $activityCount = $activities->count();
        $html = '';

        if ($activityCount > 0) {
            $html = view('bock.widgets.activity_list', compact('activities'))->render();
        }

        return response()->json([
            'status' => true,
            'html' => $html,
            'count' => $activityCount
        ]);
    }
}
