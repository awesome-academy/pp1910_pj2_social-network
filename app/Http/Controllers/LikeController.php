<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected $likeService;

    /**
     * LikeController constructor.
     */
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    /**
     * Like post
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'likeable_id'
        ]);

        $post = Post::findOrFail($data['likeable_id']);
        $data['likeable_type'] = 'App\Models\Post';
        $data['user_id'] = auth()->id();
        $like = $this->likeService->updateReact($data);

        if ($like) {

            return response()->json([
                'status' => true,
                'count_react' =>$post->likes()->count(),
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}
