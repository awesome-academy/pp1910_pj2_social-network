<?php

namespace App\Services;

use App\Events\NotificationEvent;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $model;

    public function __construct(Notification $notificationModel)
    {
        $this->model = $notificationModel;
    }

    /**
     * Send Notification Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendNotificationEvent($notificationData)
    {
       if ($notificationData['sender_id'] != $notificationData['receiver_id']) {

           return  event(new NotificationEvent($notificationData['receiver_id']));
       }
    }

    /**
     * Get notification data
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function getPostNotificationById($userId)
    {
        return $this->model->where('receiver_id', $userId)->orderDesc()->paginate(config('notification.page.number'));
    }

    /**
     * Get Notifications count.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotificationCount($userId)
    {
        return Notification::where('receiver_id', $userId)
            ->isNotRead()
            ->count();
    }

    /**
     * Store Notification in database
     *
     * @param Array $data['sender_id', 'receiver_id', 'type', 'post_id']
     * @return Boolean
     */
    public function storeNotification($data)
    {
        try {
            Notification::create($data);

            $this->sendNotificationEvent($data);
        } catch (\Throwable $throwable) {
            Log::error($throwable);

            return false;
        }

        return true;
    }
}