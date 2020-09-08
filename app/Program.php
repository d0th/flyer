<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Program extends Model
{
    use Translatable;
 
    protected $translatable = ['title', 'slug', 'preview_description', 'description', 'price'];
}
