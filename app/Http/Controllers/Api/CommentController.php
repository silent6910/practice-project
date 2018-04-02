<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreComment;
use App\Http\Requests\UpdateComment;
use App\Http\Resources\PaginationCollection;
use App\Model\Article;
use App\Model\Comment;
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
    public function index(Article $article)
    {
        $result = $this->commentRepository->getArticleComment($article->id);

        return responseJson(new PaginationCollection($result));
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
     * Update the specified resource in storage.
     *
     * @param UpdateComment $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateComment $request, Article $article, Comment $comment)
    {
        $this->commentRepository->update($comment, $request->all());
        return responseJson();
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
