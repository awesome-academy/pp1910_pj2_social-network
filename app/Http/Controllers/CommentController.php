<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'post_id',
            'content'
        ]);
        $data['user_id'] = auth()->id();

        $comment = $this->commentService->storeComment($data);

        $postId = $data['post_id'];
        $post = Post::findOrFail($data['post_id']);

        if ($comment) {
            return response()->json([
                'status' => true,
                'comment' => view('block.comment-list', compact('comment', 'post', 'postId'))->render(),
                'count_comments' => $post->parentComments()->count(),
            ]);
        }

        return response()->json([
            'status' => false,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
