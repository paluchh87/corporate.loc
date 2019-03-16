<?php

namespace Corp\Http\Controllers;

use Corp\Services\CommentServices;
use Corp\Http\Requests\CommentRequest;

class CommentController extends SiteController
{
    public function __construct(CommentServices $commentServices)
    {
        parent::__construct();

        $this->service = $commentServices;
        $this->bar = 'right';
        $this->template = config('settings.theme') . '.articles';
    }
    /**
     * Store a newly created resource in storage.
     *
     * @throws
     * @param  CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentRequest $request)
    {
        $data = $this->service->prepareDataComment($request);
        $comment = new \Corp\Comment($data);
        $data['result']=$this->service->addComment($data, $comment);
        $data['id'] = $comment->id;
        $data['hash'] = md5($data['email']);

        $view_comment = view(config('settings.theme') . '.content_one_comment', compact('data'))->render();

        return response()->json(['success' => true, 'comment' => $view_comment, 'data' => $data]);
    }
}
