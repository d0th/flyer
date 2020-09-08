<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Page;
use App\MediaAlbum;

class MediaController extends Controller
{
    //
        //all media
        public function index($slug, $locale) {

            $media = MediaAlbum::where('slug', $slug)->first();
            $media = $media->translate($locale);

            // $banner_image = preg_split('~[\\\\/]~', $content[0]->banner);

            $foto_array = json_decode($media->images, true);
            $foto_newArray = [];
            foreach ($foto_array as $key => $value) {
                $value = str_replace("\\", "/", $value);
                $value = "/storage/" . $value;
                array_push($foto_newArray, $value);
            }
            $total_images = count($foto_array);
            // $foto_newArray = array_chunk($foto_newArray, 8);

            $video_array = preg_split('/, /', $media->video);
            $total_video = count($video_array);
            // $array_video = array_chunk($array_video, 8);

            $all_total = $total_images + $total_video;

            foreach ($video_array as $key => $value) {
                static $j = -1;
                if(($key % 2) == 0) {
                    $j = $j + 4;
                    array_splice($foto_newArray, $j, 0, $value);
                    // $foto_newArray[$j] = $value;
                } else {
                    $j = $j + 6;
                    array_splice($foto_newArray, $j, 0, $value);
                    // $foto_newArray[$j] = $value;
                }
            }

            $foto_newArray = array_chunk($foto_newArray, 10);
            array_unshift($foto_newArray, $all_total);

            return response()->json($foto_newArray);
        }

        //Foto
        public function mediaFoto($slug, $locale) {

            $media = MediaAlbum::where('slug', $slug)->first();
            $media = $media->translate($locale);

            $foto_array = json_decode($media->images, true);
            $foto_newArray = [];
            foreach ($foto_array as $key => $value) {
                $value = str_replace("\\", "/", $value);
                $value = "/storage/" . $value;
                array_push($foto_newArray, $value);
            }

            $total_page = count($foto_array);
            $foto_newArray = array_chunk($foto_newArray, 9);

            array_unshift($foto_newArray, $total_page);
            // dd($foto_array);

            return response()->json($foto_newArray);
        }

        //Video
        public function mediaVideo($slug, $locale) {

            $media = MediaAlbum::where('slug', $slug)->first();
            $media = $media->translate($locale);

            $array_video = preg_split('/, /', $media->video);
            $total_video = count($array_video);
            $array_video = array_chunk($array_video, 8);

            array_unshift($array_video, $total_video);

            return response()->json($array_video);
        }
}
