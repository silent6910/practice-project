<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $username = auth()->user()->name;
        $this->collection->map(function ($item) use ($username) {
            $item->isAuthor = ($item->author == $username);
        });
        return parent::toArray($request);
    }
}
