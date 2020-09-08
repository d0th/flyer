<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Vacancy extends Model
{
    use Translatable;
 
    protected $translatable = ['title', 'preview_description', 'description'];
}
