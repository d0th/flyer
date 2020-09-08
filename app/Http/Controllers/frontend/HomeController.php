<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Facades\Voyager;

use App\HomePage;
use App\Advantage;
use App\Contact;
use App\Program;
use App\Stock;
use App\Network;

class HomeController extends Controller
{
    static $mediaDataInsta = [];

    public static function getLocale()
    {
        $locale = \Session::get('locale');
        return $locale;
    }
    //
    public function index() {

        $inst_array = self::insta();
        $facebook_array = self::facebook();
        //dd($inst_array);

        $advantages = Advantage::all();
        $advantages = $advantages->translate(self::getLocale());
        $new_array_advantages = [];
        foreach ($advantages as $key => $value) {
            array_push($new_array_advantages, preg_split('~[\\\\/]~', $value->image));
        }

        $contacts = self::contacts();
        //
        $programs_array = self::programs();
        $programs = $programs_array[0];
        $programs_preview_array = $programs_array[1];
        //
        $stocks_array = self::stocks();
        $stocks = $stocks_array[0];
        $stocks_preview_array = $stocks_array[1];

        //home_data
        $home_data = HomePage::all();
        $home_data = $home_data->translate(self::getLocale());
        $banner_sertificat = preg_split('~[\\\\/]~', $home_data[0]->banner_sertificat);
        // dd($home_data[0]);
        return view('frontend.home', compact('advantages', 'new_array_advantages', 'contacts', 'programs', 'programs_preview_array', 'stocks', 'stocks_preview_array', 'inst_array', 'home_data', 'facebook_array', 'banner_sertificat'));
    }

    public function lang($lang) {

        $languages = ['ru','en'];

        if (in_array($lang, $languages)) {

            \Session::put('locale', $lang);
        }

        return back();
    }

    public static function contacts() {
        $contacts = Contact::all();
        $contacts = $contacts->translate(self::getLocale());

        return $contacts;
    }

    public static function programs() {
        $programs = Program::all();
        $programs = $programs->translate(self::getLocale());

        $program_image_slug = [];
        foreach ($programs as $key => $value) {
            array_push($program_image_slug, preg_split('~[\\\\/]~', $value->image_preview));
        }

        return [$programs, $program_image_slug];
    }

    public static function stocks() {
        $stocks = Stock::all();
        $stocks = $stocks->translate(self::getLocale());

        $stock_image_slug = [];
        foreach ($stocks as $key => $value) {
            array_push($stock_image_slug, preg_split('~[\\\\/]~', $value->image_preview));
        }

        return [$stocks, $stock_image_slug];
    }

    public static function insta() {
        $token = '21247831137.1677ed0.ca77a6ee80c147d197c03f2f23af67ad';

        $user_id = '21247831137';
        $instagram_cnct = curl_init(); // инициализация cURL подключения
        curl_setopt( $instagram_cnct, CURLOPT_URL, "https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $token . '&count=50'); // подключаемся
        curl_setopt( $instagram_cnct, CURLOPT_RETURNTRANSFER, 1 ); // просим вернуть результат
        curl_setopt( $instagram_cnct, CURLOPT_TIMEOUT, 15 );
        $media = json_decode( curl_exec( $instagram_cnct ) ); // получаем и декодируем данные из JSON
        curl_close( $instagram_cnct ); // закрываем соединение

        if (!empty($media->data)) {

            if (!empty($media->pagination->next_url)) {
                self::$mediaDataInsta = $media->data;
                self::recursiveInsta($media->pagination->next_url);
            } else {
                self::$mediaDataInsta = $media->data;
            }

            if (!empty(self::$mediaDataInsta)) {
                return self::$mediaDataInsta;
            }
        }

        return '';
    }

    private static function recursiveInsta($link) {
        $instagram_cnct = curl_init(); // инициализация cURL подключения
        curl_setopt( $instagram_cnct, CURLOPT_URL, $link); // подключаемся
        curl_setopt( $instagram_cnct, CURLOPT_RETURNTRANSFER, 1 ); // просим вернуть результат
        curl_setopt( $instagram_cnct, CURLOPT_TIMEOUT, 15 );
        $media = json_decode( curl_exec( $instagram_cnct ) ); // получаем и декодируем данные из JSON
        curl_close( $instagram_cnct ); // закрываем соединение

        self::$mediaDataInsta = array_merge(self::$mediaDataInsta, $media->data);

        if (!empty($media->pagination->next_url)) {
            self::recursiveInsta($media->pagination->next_url);
        }
    }

    public static function facebook() {

        $token = Voyager::setting('admin.token_facebook');
        $me = curl_init();
        curl_setopt($me, CURLOPT_URL, "https://graph.facebook.com/v6.0/103590011045949/posts?fields=full_picture,message,likes,comments&limit=100&access_token=" . $token);
        curl_setopt($me, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($me, CURLOPT_TIMEOUT, 15 );

        $media = json_decode(curl_exec($me));

        curl_close($me);

        if (!empty($media->data)) {
            return $media->data;
        }

        return '';
    }

    // public function send()
    // {
    //     $objDemo = new \stdClass();
    //     $objDemo->demo_one = 'Demo One Value';
    //     $objDemo->demo_two = 'Demo Two Value';
    //     $objDemo->sender = 'SenderUserName';
    //     $objDemo->receiver = 'ReceiverUserName';

    //     Mail::to("receiver@example.com")->send(new MailNotify($objDemo));
    // }

    //Claim Voucher Code


    public function claimVoucherCodeForm(Request $request)
    {
        return redirect()->away('https://shop.iflyminsk.by/index.php?ctrl=do&do=claim_voucher_code&goto=store_3&voucher_code='. $request->certificate);
    }
}



