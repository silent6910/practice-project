<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DestroyComment;
use App\Http\Requests\StoreComment;
use App\Http\Requests\UpdateComment;
use App\Http\Resources\PaginationCollection;
use App\Model\Article;
use App\Model\Comment;
use App\Repository\CommentRepository;
use App\Service\BuildDataService;

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
     * @param Article $article
     * @param BuildDataService $buildDataService
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article, BuildDataService $buildDataService)
    {
        $result = $this->commentRepository->getArticleComment($article->id);
        $buildDataService->addIsAuthorToList(auth()->user()->id, $result);
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
     * @param Article $article
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
     * @param DestroyComment $request
     * @param Article $article
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DestroyComment $request, Article $article, comment $comment)
    {
        $this->commentRepository->destroy($comment);
        return responseJson();
    }
}
