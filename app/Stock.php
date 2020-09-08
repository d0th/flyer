<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Stock extends Model
{
    use Translatable;
 
    protected $translatable = ['title', 'text', 'description_before', 'description_after', 'date', 'ceo_title', 'ceo_description', 'ceo_keywords'];
}
