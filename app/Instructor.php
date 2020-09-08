<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Instructor extends Model
{
    use Translatable;
 
    protected $translatable = ['name', 'age', 'description', 'schedule', 'position', 'ceo_title', 'ceo_description', 'ceo_keywords'];
}
