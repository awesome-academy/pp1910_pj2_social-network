<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $userService, $postService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, PostService $postService)
    {
        $this->middleware(['auth','verified']);
        $this->userService = $userService;
        $this->postService = $postService;
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
