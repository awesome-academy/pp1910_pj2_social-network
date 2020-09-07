<?php

return [
    'to_present_user' => [
        'like' => "đã thích <a href='/posts/:post_id'>ảnh</a> của bạn",
        'comment' => "đã bình luận về <a href='/posts/:post_id'>ảnh</a> của bạn",
    ],
    'to_others' => [
        'like' => "đã thích <a href='/posts/:post_id'>ảnh</a> của :user_name",
        'comment' => "đã bình luận về <a href='/posts/:post_id'>ảnh</a> của :user_name",
    ],
];