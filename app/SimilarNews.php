<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SimilarNews extends Model
{
    protected $fillable = ['news_id', 'similar_news'];
}
