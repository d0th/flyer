<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\SimilarNews;
use App\Page;
use App\Stock;

class NewsController extends Controller
{
    public static function getLocale()
    {
        $locale = \Session::get('locale');
        return $locale; 
    }

    //all news
    public function index() {

        // $news = News::all();
        // $news = $news->translate(self::getLocale());

        $content = Page::where('slug', 'news')->get();
        $content = $content->translate(self::getLocale());

        // dd($news);

        return view('frontend.news.index', compact('content'));
        // return view('frontend.news.index');
    }

    //article
    public function item($alias) {

        $article = News::where('slug', $alias)->get();
        $article = $article->translate(self::getLocale());
        //similar news
        $similar_news_id = SimilarNews::where('news_id', $article[0]->id)->pluck('similar_news_id')->toArray();
        $similar_news_array = [];
        foreach ($similar_news_id as $key => $value) {
            $item_news = News::where('id', $value)->get();
           array_push($similar_news_array, $item_news->translate(self::getLocale()));
        }

        $slider_array = json_decode($article[0]->slider, true);

        // dd($similar_news_array);

        return view('frontend.news.article', compact('article', 'slider_array', 'similar_news_array'));
    }

    //akcii
    public function akciiItem($alias) {

        $article = Stock::where('slug', $alias)->get();
        $article = $article->translate(self::getLocale());

        $slider_array = json_decode($article[0]->slider, true);

        // dd($similar_news_array);

        return view('frontend.news.article_stock', compact('article', 'slider_array'));
    }
}
