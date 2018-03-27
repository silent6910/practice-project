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
        $this->buildCollection();

        return parent::toArray($request);
    }

    /**
     * compare the author and remove useless data
     *
     */
    private function buildCollection(): void
    {
        //todo 這邊可以在sql裡面處理，但因為時程的關係，先用這種方法處理
        $userId = auth()->user()->id;
        $this->collection->map(function ($item) use ($userId) {
            $item->isAuthor = ($item->user_id == $userId);
            $item->user_id = null;
        });
    }
}
