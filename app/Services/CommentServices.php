<?php

namespace Corp\Services;

use Corp\Http\Requests\CommentRequest;
use Corp\Repositories\ArticlesRepository;
use Auth;
use Corp\Comment;

class CommentServices extends Services
{
    public function __construct(ArticlesRepository $a_rep)
    {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->a_rep = $a_rep;
    }

    public function prepareDataComment(CommentRequest $request)
    {
        $data = $request->except('_token', 'comment_post_ID', 'comment_parent');

        $data['article_id'] = $request->input('comment_post_ID');
        $data['parent_id'] = $request->input('comment_parent');

        $user = Auth::user();

        $data['email'] = (!empty($data['email'])) ? $data['email'] : $user->email;
        $data['name'] = (!empty($data['name'])) ? $data['name'] : $user->name;

        if ($user) {
            $data['user_id'] = $user->id;
        }

        return $data;
    }

    public function addComment(array $data, Comment $comment)
    {
        $post = $this->a_rep->find($data['article_id']);
        $post->comments()->save($comment);

        if ($post->comments()->save($comment)) {
            return ['status' => 'Comment added'];
        }

        return ['error' => 'ERROR "Comment added"'];
    }
}
