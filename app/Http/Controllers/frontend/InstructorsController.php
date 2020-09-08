<?php

namespace App\Http\Controllers\frontend;

use App\MediaInstructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Review;
use App\Page;

class InstructorsController extends Controller
{

    public static function getLocale()
    {
        $locale = \Session::get('locale');
        return $locale;
    }

    //all instructors
    public function index() {

        $content = Page::where('slug', 'instructors')->get();
        $content = $content->translate(self::getLocale());

        $sliders_array = self::sliderInstructors();
        $sliders= $sliders_array[0];
        $sliders_image = $sliders_array[1];

        //instructors
        $instructors = self::instructors();

        // dd($instructors);

        return view('frontend.instructors.index', compact('sliders', 'sliders_image', 'instructors', 'content'));
    }

    //instructor
    public function instructor($alias) {

        $instructor = Instructor::where('slug', $alias)->first();
        $instructor = $instructor->translate(self::getLocale());
        $media = MediaInstructor::where('instructor_id',$instructor->id)->get()->toArray();

        foreach ($media as $key=>$item) {
            if (empty($item['status']) || empty($item['url_video']) && empty(json_decode($item['file'])[0]->download_link)) {
                unset($media[$key]);
            }
        }

        $medias = array_chunk($media, 2);

        $instructor_banner = preg_split('~[\\\\/]~', $instructor->banner);
        $foto_array = json_decode($instructor->foto, true);
        $foto_newArray = [];
        if($foto_array !== null) {
            foreach ($foto_array as $key => $value) {
                $value = str_replace("\\", "/", $value);
                $value = "/storage/" . $value;
                array_push($foto_newArray, $value);
            }
        }

        if($instructor->video !== null) {
            $video_array = preg_split('/, /', $instructor->video);

            foreach ($video_array as $key => $value) {
                static $j = -1;
                if(($key % 2) == 0) {
                    $j = $j + 1;
                    array_splice($foto_newArray, $j, 0, $value);
                } else {
                    $j = $j + 3;
                    array_splice($foto_newArray, $j, 0, $value);
                }
            }
        }

        //reviews
        $array_review = Review::where('instructor_id', $instructor->id)->get();
        $array_review = $array_review->translate(self::getLocale());
        $array_socials = json_decode($instructor->socials);

        return view('frontend.instructors.item', compact('instructor', 'instructor_banner', 'array_review', 'foto_newArray', 'array_socials', 'medias'));
    }


    public static function sliderInstructors() {
        $sliders = Instructor::where('slider', 1)->get();
        $sliders = $sliders->translate(self::getLocale());

        $slider_image_slug = [];
        foreach ($sliders as $key => $value) {
            array_push($slider_image_slug, preg_split('~[\\\\/]~', $value->banner));
        }

        return [$sliders, $slider_image_slug];
    }

    public static function instructors() {
        $instructors = Instructor::all();
        $instructors = $instructors->translate(self::getLocale());

        return $instructors;
    }
}
