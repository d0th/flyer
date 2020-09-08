<?php

namespace App\Http\Controllers\frontend;

use App\AerotubeSport;
use App\Http\Controllers\frontend\HomeController;
use App\PageSportsman;
use App\TariffSportsman;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\AboutUs;
use App\WhatAwait;
use App\BirthdayParty;
use App\MediaAlbum;
use Illuminate\Support\Facades\Date;

class PagesController extends Controller
{
    protected $maxSteps;

    public static function getLocale()
    {
        $locale = \Session::get('locale');
        return $locale;
    }

    public function zakazPoleta()
    {
        $content = Page::where('slug', 'zakaz-poleta')->get();
        $content = $content->translate(self::getLocale());

        return view('frontend.pages.zakazPoleta', compact('content'));
    }

    public function howItWorks()
    {
        $content = Page::where('slug', 'kak-eto-rabotaet')->get();
        $content = $content->translate(self::getLocale());

        return view('frontend.pages.howItWorks', compact('content'));
    }

    public function aboutUs()
    {
        $content = Page::where('slug', 'about-us')->get();
        $content = $content->translate(self::getLocale());

        $about_array = AboutUs::all();
        $about_array = $about_array->translate(self::getLocale());
        $array_images = [];

        foreach ($about_array as $key => $value) {
            array_push($array_images, preg_split('~[\\\\/]~', $value->image));
        }

        return view('frontend.pages.aboutPage', compact('about_array', 'array_images', 'content'));
    }

    public function whatAwaitsYou()
    {
        $content = Page::where('slug', 'chto-vas-jdet')->get();
        $content = $content->translate(self::getLocale());

        $slids_array = WhatAwait::all();
        $slids_array = $slids_array->translate(self::getLocale());
        $array_images = [];
        foreach ($slids_array as $key => $value) {
            array_push($array_images, preg_split('~[\\\\/]~', $value->image));
        }

        return view('frontend.pages.whatWaitPage', compact('slids_array', 'array_images', 'content'));
    }

    public function giftCards()
    {
        $content = Page::where('slug', 'podarochnii-sertifikat')->get();
        $content = $content->translate(self::getLocale());

        $programs_array = HomeController::programs();
        $programs = $programs_array[0];
        $programs_preview_array = $programs_array[1];

        return view('frontend.pages.giftCards', compact('content', 'programs', 'programs_preview_array'));
    }

    public function programsIfly()
    {
        $content = Page::where('slug', 'programs-poletov')->get();
        $content = $content->translate(self::getLocale());

        $programs_array = HomeController::programs();
        $programs = $programs_array[0];
        $programs_preview_array = $programs_array[1];

        return view('frontend.pages.programsFly', compact('content', 'programs', 'programs_preview_array'));
    }

    public function partiesPage()
    {
        $content = Page::where('slug', 'korporativi')->get();
        $content = $content->translate(self::getLocale());

        $contacts = HomeController::contacts();

        //dd( str_replace('\\', '/', $content[0]->banner));
        //dd($content[0]->media_video);

        return view('frontend.pages.partiesPage', compact('content', 'contacts'));
    }

    public function birthdayPage()
    {
        $content = Page::where('slug', 'dni-rojdeniya')->get();
        $content = $content->translate(self::getLocale());

        $birthday_array = BirthdayParty::all();
        $birthday_array = $birthday_array->translate(self::getLocale());
        $array_images = [];
        foreach ($birthday_array as $key => $value) {
            array_push($array_images, preg_split('~[\\\\/]~', $value->image));
        }

        return view('frontend.pages.birthdayFly', compact('birthday_array', 'array_images', 'content'));
    }

    public function businessPage()
    {
        $content = Page::where('slug', 'business')->get();
        $content = $content->translate(self::getLocale());
        $contacts = HomeController::contacts();

        $birthday_array = BirthdayParty::all();
        $birthday_array = $birthday_array->translate(self::getLocale());
        $array_images = [];
        foreach ($birthday_array as $key => $value) {
            array_push($array_images, preg_split('~[\\\\/]~', $value->image));
        }

        return view('frontend.pages.businessPage', compact('birthday_array', 'array_images', 'content', 'contacts'));
    }


    public function statSportsmenomPage()
    {
        $content = Page::where('slug', 'stat-sportsmenom')->get();
        $content = $content->translate(self::getLocale());

        $banner_image = preg_split('~[\\\\/]~', $content[0]->banner);

        $slider_array = json_decode($content[0]->slider, true);

        return view('frontend.pages.athleteFly', compact('slider_array', 'content', 'banner_image'));
    }

    public function mediaGallery()
    {
        $content = Page::where('slug', 'media')->get();
        $content = $content->translate(self::getLocale());

        $albums = MediaAlbum::all();
        $albums = $albums->translate(self::getLocale());
        $newAlbums = [];

        foreach ($albums as $item) {
            array_push($newAlbums, $item);
        }

        usort($newAlbums, function ($a, $b) {
            return strtotime($a->date) < strtotime($b->date);
        });

        $albums = $newAlbums;

        return view('frontend.pages.media', compact('content', 'albums'));
    }

    public function mediaGalleryAlbum($slug)
    {
        $media = MediaAlbum::where('slug', $slug)->first();
        $media = $media->translate(self::getLocale());

        // dd($media);
        // $albums = MediaAlbum::all();
        // $albums = $albums->translate(self::getLocale());

        // dd($content[0]->slider);

        return view('frontend.pages.albumItem', compact('media'));
    }

    public function sportsmanTariff()
    {
        $sportsman_tariff = TariffSportsman::where('status', 1)->first();

        return view('frontend.pages.tariff', compact('sportsman_tariff'));
    }

    public function sportsmanPage($slug)
    {
        if ($slug === 'sportsman-tariff') {
            $sportsman_tariff = TariffSportsman::where('status', 1)->first();

            if (!empty($sportsman_tariff)) {
                header('Refresh: 0; ' . $sportsman_tariff->link);
            }
        } else {
            $sportsman_page = PageSportsman::where('slug', $slug)->first();

            if (empty($sportsman_page)) {
                header('Refresh: 0; /');
            } else if ($sportsman_page->template === 'option1') {
                return view('frontend.pages.template.template1', compact('sportsman_page'));
            } else if ($sportsman_page->template === 'option2') {
                return view('frontend.pages.template.template2', compact('sportsman_page'));
            }
        }
    }

    public function aerotubeSports()
    {
        $aerotube_sports = AerotubeSport::where('status', 1)->first();

        return view('frontend.pages.aerotube', compact('aerotube_sports'));
    }

    public function cartPage()
    {
        return view('frontend.pages.cart');
    }

    public function bookingPage()
    {
        $params = [
            'do' => 'getVouchersCatalog',
            'args' => json_encode([]),
        ];

        $data = $this->api('POST', '', $params);

        $catalogFly = [
            "1" => [],
            "4" => [],
            "5" => [],
            "6" => [],
            "2" => [],
        ];

        foreach ($data['results'] as $item) {
            $item['description_ru'] = html_entity_decode($item['description_ru']);
            $catalogFly[$item['category']][] = $item;
        }

        $catalogFly = json_encode($catalogFly);

        return view('frontend.pages.booking', compact('catalogFly'));
    }

    public function getFlying()
    {
        $params = [
            'do' => 'getVouchersCatalog',
            'args' => json_encode([]),
        ];

        $data = $this->api('POST', '', $params);
        return $data['results'];
    }

    public function getChooseDate(Request $request)
    {
        $catalog_ids = $request['catalog_ids'];
        $cart = $request['cart'];
        $day_start = time();
        $date = new DateTime(date("Y-m-t", strtotime(date("Y-m-t", strtotime('+5 month')))));
        $day_end = $date->getTimestamp();

        $args = [
            "facility_id" => "1",
            "day_start" => $day_start,
            "day_end" => $day_end,
            "catalog_ids" => $catalog_ids,
            "cart" => $cart
        ];

        $params = [
            'do' => 'getAvailableBookableDaysMulti',
            'args' => json_encode($args),
        ];

        $data = $this->api('POST', '', $params);

        return $data;
    }

    public function getChooseDay(Request $request)
    {
        $catalog_ids = $request['catalog_ids'];
        $cart = $request['cart'];
        $day_start = $request['seconds'];
        $day_end = $request['seconds'];

        $args = [
            "facility_id" => "2",
            "day_start" => $day_start,
            "day_end" => $day_end,
            "catalog_ids" => $catalog_ids,
            "cart" => $cart
        ];

        $params = [
            'do' => 'getAvailableTimeslotsPerDayMulti',
            'args' => json_encode($args),
        ];

        $data = $this->api('POST', '', $params);
        return $data;
    }

    public function getChooseTime(Request $request)
    {
        $timeslot = $request['timeslot'];
        $price_cat = $request['price_cat'];
        $price = $request['price'];

        $args = [
            "timeslot" => $timeslot,
            "price_cat" => $price_cat,
            "price" => $price,
        ];

        $jsonBody = '{"do":"saveBuyBookingTimeslot", "token":"75bca08063e061b3741e232638aeec78d7d4a106", "args":' . json_encode($params) . '}';

        $params = [
            'do' => 'getAvailableTimeslotsPerDayMulti',
            'args' => json_encode($args),
        ];

        $data = $this->api('POST', '', $params);
        return $data;
    }


    public function apiUrl()
    {
        return getenv('API_URL');
    }

    public function additionalParams()
    {
        return [
            'token' => getenv('API_TOKEN'),
        ];
    }

    public function additionalHeaders()
    {
        return [];
    }

    public function api($method, $uri, $params = [], $headers = [])
    {
        return $this->execute($method, $uri, $params, $headers);
    }

    protected function execute($method, $uri, $params, $headers = [], $step = 1)
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->apiUrl(),
            'exceptions' => false,
        ]);

        $params = array_merge($this->additionalParams(), $params);
        $headers = array_merge($this->additionalHeaders(), $headers);

        try {
            $response = $client->request($method, $this->apiUrl() . $uri, [
                'headers' => $headers,
                'json' => $method !== 'GET' ? $params : [],
                'query' => $method == 'GET' ? $params : [],
                'allow_redirects' => true,
                'connect_timeout' => 4,
            ]);
        } catch (\GuzzleHttp\Exception\CurlException $e) {
            return [];
        }

        if (in_array($response->getStatusCode(), [200, 201, 202, 203, 204, 205])) {
            return json_decode((string)$response->getBody(), true);
        } else {

            if ($step < $this->maxSteps) {
                sleep($step); // Нужно сделать паузу, чтобы сервак не положить нечаянно
                return $this->execute($method, $uri, $params, $headers, $step + 1);
            }

            return $this->errorEvent($response);
        }
    }

    protected function errorEvent($res)
    {
        return [];
    }
}
