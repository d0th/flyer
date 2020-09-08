<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class MediaAlbum extends Model
{
    use Translatable;
 
    protected $translatable = ['preview_description', 'date', 'ceo_title', 'ceo_description', 'ceo_keywords'];
}
