<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Faq;
use App\Page;

class FaqController extends Controller
{
    //
    public function index() {

        $locale = \Session::get('locale');

        $content = Page::where('slug', 'faq')->get();
        $content = $content->translate($locale);

        $fags = Faq::all();
        $fags = $fags->translate($locale);
        return view('frontend.faq.index', compact('fags', 'content'));
    }
}
