<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Contact extends Model
{
    use Translatable;
 
    protected $translatable = ['title', 'info', 'ceo_title', 'ceo_description', 'ceo_keywords'];
}
