<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getNotificationList(Request $request)
    {
        $notifications = $this->notificationService->getPostNotificationById(auth()->id());

        return response()->json([
            'html' => view('layouts.notification_block', compact('notifications'))->render()
        ]);
    }
}
