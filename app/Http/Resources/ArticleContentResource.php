<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class  ArticleContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
       // $this->setIsAuthor();
        $this->removeUselessData();

        return parent::toArray($request);
    }

    private function removeUselessData(): void
    {
        unset($this->user_id);
        unset($this->user->id);
    }

//    private function setIsAuthor(): void
//    {
//        $userId = auth()->user()->id;
//        $this->offsetSet('isAuthor', ($this->user_id == $userId));
//    }
}
