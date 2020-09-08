<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\HomeController;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Contact;
use App\Instructor;

class ContactsController extends Controller
{
    public static function getLocale()
    {
        $locale = \Session::get('locale');
        return $locale;
    }

    //
    public function index() {

        $content = Contact::all();
        $content = $content->translate(self::getLocale());

        $contacts = HomeController::contacts();

        return view('frontend.contacts.index', compact('contacts', 'content'));
    }

    public function contactRequestForm(Request $request)
    {
        if($_FILES['file']){
            $imageName = str_slug($request->name) . '.' . str_slug($request->fname) . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(base_path() . '/public/uploads/CV/', $imageName);
        }

    $to = array_map('trim', explode(',', Voyager::setting('admin.email_vacancies')));

    Mail::send('forms.email', ['email' => request()], function ($m) use ($to) {
        $m->from(config('mail.from.address'));

        $imageName = str_slug(request()->name) . '.' . str_slug(request()->fname) . '.' . request()->file('file')->getClientOriginalExtension();

        $m->to($to)->subject('Заявка на работу')->attach(base_path() . '/public/uploads/CV/'. $imageName);
    });

    return 'true';

    }

    public function requestInstructorsForm(Request $request)
    {

        $instructor = Instructor::where('id', $request->instructor_id)->get();

        $request->instructor = $instructor[0]->name;

        //
        $to = array_map('trim', explode(',', Voyager::setting('admin.email_instructors')));

        Mail::send('forms.email', ['email' => request()], function ($m) use ($to) {
            $m->from(config('mail.from.address'));

            $m->to($to)->subject('Запись к инструктору');
        });

        return 'true';

    }

    public function requestPartiesForm(Request $request)
    {

        $to = array_map('trim', explode(',', Voyager::setting('admin.email_parties')));

        Mail::send('forms.email', ['email' => request()], function ($m) use ($to) {
            $m->from(config('mail.from.address'));

            $m->to($to)->subject('Заявка на проведение праздника');
        });


        return 'true';

    }

    public function requestAthleteForm(Request $request)
    {

        $to = array_map('trim', explode(',', Voyager::setting('admin.email_athlete')));

        Mail::send('forms.email', ['email' => request()], function ($m) use ($to) {
            $m->from(config('mail.from.address'));

            $m->to($to)->subject('Заявка: Как стать спортсменом');
        });


        return 'true';

    }

    public function requestCorporateForm(Request $request)
    {

        $to = array_map('trim', explode(',', Voyager::setting('admin.email_athlete')));

        Mail::send('forms.email-corporate', ['email' => request()], function ($m) use ($to) {
            $m->from(config('mail.from.address'));

            $m->to($to)->subject('Заявка: Корпоративы');
        });


        return 'sended';
    }

    public function requestBusinessForm(Request $request)
    {

        $to = array_map('trim', explode(',', Voyager::setting('admin.email_business')));

        Mail::send('forms.email-business', ['email' => request()], function ($m) use ($to) {
            $m->from(config('mail.from.address'));

            $m->to($to)->subject('Заявка: Бизнес встречи');
        });


        return 'sended';
    }

    public function requestBirthdayForm(Request $request)
    {

        $to = array_map('trim', explode(',', Voyager::setting('admin.email_business')));

        Mail::send('forms.email', ['email' => request()], function ($m) use ($to) {
            $m->from(config('mail.from.address'));

            $m->to($to)->subject('Заявка: Дни рождения');
        });


        return 'sended';
    }
}
