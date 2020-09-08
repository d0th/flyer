<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class History extends Model
{
    use Translatable;
 
    protected $translatable = ['description'];
    
}
