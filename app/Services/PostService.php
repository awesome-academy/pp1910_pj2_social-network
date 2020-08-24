<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ActivityService;

class PostService
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * @param $request
     * @return array ['title', 'image', 'type']
     */
    public function getPostData($request)
    {
        return $request->only([
            'title',
            'image',
            'type'
        ]);
    }

    /**
     * Get list user's followings
     * @param App\User $user
     * @param bool $isCurrentUser
     * @return array
     */
    public function getListUsers($user, $isCurrentUser = true)
    {
        $userFollowIds = $user->followings->pluck('id');
        if ($isCurrentUser) {
            return $userFollowIds->push($user->id);
        }

        return[$user->id];
    }

    public function postImage($images)
    {
        $imageArray = [];
        foreach ($images as $image) {
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('/posts', $fileName, 'post_images');
            $imageArray[] = $fileName;
        }
        $imageString = json_encode($imageArray);

        return $imageString;
    }

    public function storePost($data)
    {
        try {
            $post = Post::create($data);

            $activityData = [
                'user_id' => $data['user_id'],
                'post_id' => $post->id,
                'type' => config('activity.type.upload')
            ];

            $this->activityService->storeActivity($activityData);
        } catch(\Throwable $th) {
            Log::error($th);

            return false;
        }
        
        return true;
    }

    /**
     * Get list post
     *
     * @param App\User $user
     * @param boolean $isCurrentUser
     * @return \Illuminate\Http\Response
     */
    public function getListPost($user, $isCurrentUser = true)
    {
        $listUserIds = $this->getListUsers($user, $isCurrentUser);

        return Post::with('user')->whereIn('user_id', $listUserIds)->OrderBy('created_at', 'desc')->paginate(config('home.page.number'));
    }

    /**
     * Get Image post
     */
    public function getImage($user, $photoNumber)
    {
        $postImages = $user->posts()->whereNotNull('image')->OrderBy('created_at', 'desc')->pluck('image');
        $imageArray = [];

        foreach ($postImages as $image)
        {
            foreach (json_decode($image) as $postImage) {
                if (count($imageArray) == $photoNumber) {

                    return $imageArray;
                }

                $imageArray[] = $postImage;
            }
        }

        return $imageArray;
    }

    /**
     * Edit post
     *
     * @param int $id
     * @param array $data['user_id', 'title', 'type']
     * @return boolean
     */
    public function updatePost($id, $data)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != auth()->user()->id) {

            return false;
        }

        try {
            $post->update($data);
        } catch (\Throwable $throwable) {
            Log::error($throwable);

            return false;
        }

        return true;
    }

    /**
     * Delete post
     *
     * @param int $id
     * @return boolean
     *
     */
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != auth()->user()->id) {

            return false;
        }

        $this->activityService->deleteActivity($id);

        try {
            $post->delete();
        } catch (\Throwable $throwable) {
            Log::error($throwable);

            return false;
        }

        return true;
    }
}