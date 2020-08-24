<?php

namespace App\Http\Controllers;

use App\Services\ActivityService;
use App\Services\PostService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $userService;
    protected $postService;
    protected $activityService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $userService,
        PostService $postService,
        ActivityService $activityService
    )
    {
        $this->userService = $userService;
        $this->postService = $postService;
        $this->activityService = $activityService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $posts = $this->postService->getListPost(auth()->user());

        return view('home', compact('users', 'posts'));
    }

    /**
     * Follow the user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function followUserRequest(Request $request)
    {
        $user = User::find($request->user_id);
        $response = auth()->user()->toggleFollow($user);


        return response()->json(['success'=>$response]);
    }
}
