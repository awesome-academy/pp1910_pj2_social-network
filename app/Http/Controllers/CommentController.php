<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
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

    /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(CommentRequest $request)
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
                'comment' => view('block.comment', compact('comment', 'post', 'postId'))->render(),
                'count_comments' => $post->parentComments()->count(),
            ]);
        }

        return response()->json([
            'status' => false,
        ]);

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

    /**
     * View more comment
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function viewMoreComment(Request $request)
    {
        $postId = $request->post_id;

        $post = Post::findOrFail($postId);

        if ($post) {
            $comments = $post->parentComments()->orderBy('created_at', 'desc')->paginate(config('post.comment.paginate'));

            $moreComments = $comments->sortBy('created_at');

            $html = '';

            if ($moreComments->count() > 0) {
                $html = view('block.comment-list', compact('post', 'moreComments'))->render();
            }

            return response()->json([
                'status' => true,
                'html' => $html,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
