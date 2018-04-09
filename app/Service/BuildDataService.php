<?php


namespace App\Service;


class BuildDataService
{

    public function buildArticleListData(int $userId, &$collection)
    {
        $collection->map(function ($item) use ($userId) {
            $item->type = __('articleType.' . $item->type);
            self::buildAuthor($item, $userId);
        });
    }

    public function addIsAuthorToList(int $userId, &$collection)
    {
        $collection->map(function ($item) use ($userId) {
            self::buildAuthor($item, $userId);
        });
    }

    private function buildAuthor(&$item, $userId)
    {
        $item->isAuthor = ($item->user_id == $userId);
        unset($item->user_id);
    }

}