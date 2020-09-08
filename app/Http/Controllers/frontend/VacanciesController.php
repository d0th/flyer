<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Page;
use App\Vacancy;

class VacanciesController extends Controller
{
    public static function getLocale()
    {
        $locale = \Session::get('locale');
        return $locale; 
    }
    //
    public function index() {

        $array_content = self::getContent();
        $content = $array_content[0];
        $content_image = $array_content[1];
        //vacancies
        $vacancies = self::getVacancies();
        // dd($vacancies);

        return view('frontend.vacancies.index', compact('content', 'content_image', 'vacancies'));
    }

    public static function getContent() {
        $content = Page::where('slug', 'vacancies')->get();
        $content = $content->translate(self::getLocale());

        $banner_image = preg_split('~[\\\\/]~', $content[0]->banner);
        
        return [$content, $banner_image];
    }

    public static function getVacancies() {
        $vacancies = Vacancy::all();
        $vacancies = $vacancies->translate(self::getLocale());
        
        return $vacancies;
    }
}
