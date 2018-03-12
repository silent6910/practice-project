<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    Const COLUMN = ['id', 'type', 'title', 'content', 'created_at', 'updated_at'];

    protected $table = 'article';

    protected $dates = ['deleted_at'];

    protected $fillable = ['type', 'title', 'content'];

}