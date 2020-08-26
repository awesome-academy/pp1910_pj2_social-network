<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $this->postService->getPostData($request);

        $data['user_id'] = auth()->user()->id;

        if (isset($data['image'])) {
            $data['image'] = $this->postService->postImage($data['image']);
        }

        $storePost = $this->postService->storePost($data);

        if ($storePost) {
            return back()->with('success', __('post.create.success'));
        }

        return back()->with('error', __('post.error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.index', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->postService->getPostData($request);
        $data['user_id'] = auth()->user()->id;

        if (isset($data['image'])) {
            $data['image'] = $this->postService->postImage($data['image']);
        }

        $updatePost = $this->postService->updatePost($id, $data);

        if ($updatePost) {
            return redirect()->back()->with('success', 'Update post successfully!');
        }

        return redirect()->back()->with('error', 'Something wen\'t wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletePost = $this->postService->deletePost($id);

        if ($deletePost) {
            return redirect()->back()->with('success', __('Delete post successfully!'));
        }

        return redirect()->back()->with('error', __('Something went wrong!'));
    }

    /**
     * Get images in edit post
     *
     * @param int $postId
     * @return \Illuminate\Http\Response
     *
     */
    public function getImageEditPost($postId)
    {
        $post = Post::findOrFail($postId);

        $postImages = json_decode($post->image);

        $html ='';

        if ($postImages) {
            $html = view('block.modals.image_edit', compact('post', 'postImages'));
        }

        return response()->json([
            'html' => $html
        ]);
    }
}
