<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\DestroyArticle;
use App\Http\Requests\StoreArticle;
use App\Http\Requests\UpdateArticle;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleContentResource;
use App\Http\Resources\PaginationCollection;
use App\Model\Article;
use App\Repository\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = $this->articleRepository->getIndex();
        addIsAuthorToList($request->user()->id, $result);
        return responseJson(new PaginationCollection($result));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticle $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $userId = auth()->user()->id;
        $this->articleRepository->store($userId, $request->all());
        return responseJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return responseJson(new ArticleContentResource($this->articleRepository->getDetail($id)));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return responseJson($this->articleRepository->getEditData(auth()->user()->id, $id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticle $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArticle $request, Article $article)
    {
//        $articleModel = $this->articleRepository->findEditData(auth()->user()->id, $id);
//        dd($articleModel);
        $this->articleRepository->update($article, $request->all());
        return responseJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyArticle $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyArticle $request, Article $article)
    {
        $this->articleRepository->destroy($article);
        return responseJson();
    }

    public function getType()
    {
        return responseJson(__('articleType'));
    }

}