<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreComment;
use App\Model\Article;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
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
     * Store a newly created resource in storage.
     *
     * @param StoreComment $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreComment $request, Article $article)
    {
        $this->commentRepository->store($article->id, $request->user()->id, $request->all());
        return responseJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        //
    }
}
