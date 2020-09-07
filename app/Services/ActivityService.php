<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Activity;
use App\Services\FriendService;

class ActivityService
{
    /**
     * Store Activity in database.
     *
     * @param Array $data['user_id', 'post_id', 'status']
     * @return Boolean
     */
    public function storeActivity($data)
    {
        try {
            Activity::create($data);
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Get list activities
     *
     * @param App\User $user
     * @return \Illuminate\Http\Response
     */
    public function getListActivities($user)
    {
        $userFollowId = $user->followings()->pluck('following_id');

        return Activity::with('user')->whereIn('user_id', $userFollowId)->orderBy('created_at', 'desc')->paginate(config('activity.page'));
    }

    /**
     * Get latest activity
     *
     * @param App\User $user
     * @return \Illuminate\Http\Response
     */
    public function getLatestActivity($user)
    {
        $userFollowId = $user->followings()->pluck('following_id');

        return Activity::with('user')->whereIn('user_id', $userFollowId)->whereBetween('created_at', [now()->subMinutes(config('activity.minutes_between')), now()])->limit(config('activity.display.limit'))->orderBy('created_at', 'desc')->get();
    }

    /**
     * Delete Activity
     *
     * @param int $postId
     * @return boolean
     *
     */
    public function deleteActivity($postId)
    {
        $activity = Activity::where('post_id', $postId);

        try {
            $activity->delete();
        } catch (\Throwable $throwable) {
            Log::error($throwable);

            return false;
        }

        return true;
    }
}
