<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Page extends Model
{
    use Translatable;
 
    protected $translatable = ['title', 'preview_description', 'description', 'ceo_title', 'ceo_description', 'ceo_keywords'];
}
