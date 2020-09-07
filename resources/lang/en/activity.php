<?php

return [
    'to_present_user' => [
        'like' => "liked your <a href='/posts/:post_id'>photo</a>",
        'comment' => "commented to your <a href='/posts/:post_id'>photo</a>",
    ],
    'to_others' => [
        'like' => "liked :user_name's <a href='/posts/:post_id'>photo</a>",
        'comment' => "commented to :user_name's <a href='/posts/:post_id'>photo</a>",
    ],
];