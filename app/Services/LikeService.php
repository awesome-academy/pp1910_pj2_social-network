<?php

namespace App\Services;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Boolean;

class LikeService
{
    protected $activityService;
    protected $notificationService;

    /**
     * LikeService constructor.
     */
    public function __construct(ActivityService $activityService, NotificationService $notificationService)
    {
        $this->activityService = $activityService;
        $this->notificationService = $notificationService;
    }

    /**
     * Store like and notification in database
     *
     * @param Array $data['user_id', 'likeable_id', 'likeable_type']
     * @return Boolean
     *
     */
    public function storeLike($data)
    {
        $senderId = $data['user_id'];
        $post = Post::findOrFail($data['likeable_id']);
        $receiverId = $post->user->id;
        $postId = $post->id;

        $activityData = [
            'user_id' => $senderId,
            'post_id' => $data['likeable_id']
        ];
        $activityData['type'] = config('activity.type.like');

        $notificationData = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'post_id' => $postId
        ];
        $notificationData['type'] = config('notification.type.like');

        DB::beginTransaction();

        try {
            Like::create($data);
            if ($senderId != $receiverId) {
                $this->notificationService->storeNotification($notificationData);

                if (isset($activityData)) {
                    $this->activityService->storeActivity($activityData);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return false;
        }

        return true;

    }

    /**
     * Find a record by condition in database.
     *
     * @param Array $data['user_id', 'liketable_id', 'likeable_type']
     * @return null | App\Models\Like
     */
    public function findCondition($data)
    {
        $reactData = Like::where($data)->first();

        return $reactData;
    }

    /**
     * Update react in database.
     *
     * @param Int $id
     *  @param Array $data['user_id', 'liketable_id', 'likeable_type']
     * @return Boolean
     */
    public function updateReact($data)
    {
        $reactRecord = $this->findCondition($data);

        if (!$reactRecord) {
            return $this->storeLike($data);
        } else {
            try {
                $reactRecord->delete($data);
            } catch (\Throwable $th) {
                Log::error($th);

                return false;
            }

            return true;
        }
    }
}