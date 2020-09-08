<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class HomePage extends Model
{
    use Translatable;
 
    protected $translatable = ['head_banner_text', 'head_banner_description', 'banner_sertificat_text', 'ceo_title', 'ceo_description', 'ceo_keywords'];
}
