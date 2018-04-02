<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $fillable = ['user_id', 'article_id', 'content'];

    private $fillableUpdate = ['content'];

    public function getFillableUpdate()
    {
        return $this->fillableUpdate;
    }

}