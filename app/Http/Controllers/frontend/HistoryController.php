<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\History;
use App\Page;

class HistoryController extends Controller
{
    //

    public static function getLocale()
    {
        $locale = \Session::get('locale');
        return $locale; 
    }


    public function index() {

        $history_array = History::all();
        $history_array = $history_array->translate(self::getLocale());

        $array_content = self::getContent();
        $content = $array_content[0];
        $content_image = $array_content[1];

        return view('frontend.history.index', compact('history_array', 'content', 'content_image'));
    }

    public static function getContent() {
        $content = Page::where('slug', 'history')->get();
        $content = $content->translate(self::getLocale());

        $banner_image = preg_split('~[\\\\/]~', $content[0]->banner);
        
        return [$content, $banner_image];
    }
}
