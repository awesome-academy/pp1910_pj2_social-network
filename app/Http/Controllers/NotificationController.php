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

    /**
     * Mark all notifications as read
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function markAllAsRead()
    {
        $markAllNotification = $this->notificationService->markAllAsRead(auth()->id());
        $notifications = $this->notificationService->getPostNotificationById(auth()->id());

        if ($markAllNotification) {
            return response()->json([
                'status' => true,
                'html' => view('layouts.notification_block', compact('notifications'))->render()
            ]);
        }
    }

    /**
     * Show all notification
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllNotification()
    {
        $notifications = $this->notificationService->getPostNotificationById(auth()->id());

        return view('notification.index', compact('notifications'));
    }
}
