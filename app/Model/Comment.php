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
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function article()
    {
        return $this->belongsTo('App\Model\Article');
    }

}