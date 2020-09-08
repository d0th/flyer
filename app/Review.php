<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Review extends Model
{
    use Translatable;
 
    protected $translatable = ['description', 'name_persone', 'position_persone'];
    
}
