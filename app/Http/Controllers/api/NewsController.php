<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\Stock;

class NewsController extends Controller
{

    //all news
    public function index($locale) {

        $news = News::all();
        $news = $news->translate($locale);

        $stocks_news = Stock::all();
        $stocks_news = $stocks_news->translate($locale);

        $all_news = [];

        foreach ($news as $key => $value) {
            array_push($all_news, $value);
        }

        foreach ($stocks_news as $key => $value) {
            array_push($all_news, $value);
        }

        // dd($all_news);

        // return view('frontend.news.index', compact('news'));
        return response()->json($all_news);
    }

    //news
    public function news($locale) {

        $news = News::where('sale', 0)->get();
        $news = $news->translate($locale);

        // dd($news);

        // return view('frontend.news.index', compact('news'));
        return response()->json($news);
    }

    //stocks_news
    public function stocks_news($locale) {

        $stocks_news = Stock::all();
        $stocks_news = $stocks_news->translate($locale);

        // dd($news);

        // return view('frontend.news.index', compact('news'));
        return response()->json($stocks_news);
    }
}
