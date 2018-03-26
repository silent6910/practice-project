<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreArticle;
use App\Http\Resources\ArticleCollection;
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
        return responseJson(new ArticleCollection($this->articleRepository->getIndex()));
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
        return responseJson($this->articleRepository->getDetail($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}