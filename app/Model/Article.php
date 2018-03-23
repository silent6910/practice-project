<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    Const COLUMN = ['id', 'user_id', 'type', 'title', 'content', 'created_at', 'updated_at'];

    protected $table = 'article';

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'type', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo('App\Model\User')->select('id', 'name');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

}