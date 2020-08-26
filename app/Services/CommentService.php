<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Services\ActivityService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentService
{
    protected $activityService;

    public function __construct(ActivityService $activityService, NotificationService $notificationService)
    {
        $this->activityService = $activityService;
        $this->notificationService = $notificationService;
    }

    /**
     * Store Comment in database.
     *
     * @param Array $data['user_id', 'content', 'post_id']
     * @return Boolean | App\Models\Comment
     */
    public function storeComment($data)
    {
        $senderId = $data['user_id'];

        $post = Post::findOrFail($data['post_id']);

        $receiverId = $post->user->id;

        $activityData = [
            'user_id' => $senderId,
            'post_id' => $data['post_id'],
        ];

        $activityData['type'] = config('activity.type.comment');

        $notificationData = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'post_id' => $data['post_id'],
        ];

        DB::beginTransaction();

        try {
            $comment = Comment::create($data);

            $notificationData['type'] = config('notification.type.comment');

            if ($senderId != $receiverId) {
                $this->notificationService->storeNotification($notificationData);
                $this->activityService->storeActivity($activityData);
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);

            DB::rollBack();

            return false;
        }

        return $comment;
    }
}