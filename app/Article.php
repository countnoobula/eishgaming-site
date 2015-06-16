<?php
namespace App;

class Article extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'created_at', 'updated_at'];

}
