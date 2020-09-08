<?php


namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;

class CabinetController
{
    protected $api;

    public function __construct()
    {
        $this->api = new ApiController();
    }

    public function customerAccountPage()
    {
        $user = Auth::user();
        $customer_id = $user->customer_id;
        $token = $user->customer_token;
        $userTunn = $this->api->getUser($token, $customer_id, 'id');

        $paramsCB = [
            'do' => 'getCustomerBookings',
            'args' => [
                'customer_id' => $customer_id,
                'token' => $token,
            ],
        ];

        $getCustomerBookings = $this->api->api('POST', '', $paramsCB);

        $paramsCV = [
            'do' => 'getCustomerVouchers',
            'args' => [
                'customer_id' => $customer_id,
                'token' => $token,
                'order_by' => 'booked',
            ],
        ];

        $getCustomerVouchers​ = $this->api->api('POST', '', $paramsCV);

//        $paramsCI = [
//            'do' => 'getCustomerInvoices',
//            'args' => [
//                'customer_id' => $customer_id,
//                'token' => $token,
//            ],
//        ];
//
//        $getCustomerInvoices = $this->api->api('POST', '', $paramsCI);


        $user_data = $userTunn['results'];
        $getBookings = $getCustomerBookings['results'];
        $getVouchers​ = $getCustomerVouchers​['results'];
//        $getInvoices = $getCustomerInvoices['results'];

        $data_user = json_encode($user_data);
        $data_bookings = json_encode($getBookings);
        $data_vouchers​ = json_encode($getVouchers​);
        return view('frontend.pages.account.customer-account', compact('data_user', 'data_bookings', 'data_vouchers​'));
    }

    public function editCustomerPage()
    {
        $user = Auth::user();
        $customer_id = $user->customer_id;
        $token = $user->customer_token;
        $userTunn = $this->api->getUser($token, $customer_id, 'id');
        $data = json_encode($userTunn);
        return view('frontend.pages.account.edit-account', compact('data'));
    }

    public function bookingVoucherPage()
    {

        $user = Auth::user();
        $customer_id = $user->customer_id;
        $token = $user->customer_token;

        $paramsCV = [
            'do' => 'getCustomerVouchers',
            'args' => [
                'customer_id' => $customer_id,
                'token' => $token,
                'order_by' => 'booked',
            ],
        ];

        $getCustomerVouchers​ = $this->api->api('POST', '', $paramsCV);
        $getVouchers​ = $getCustomerVouchers​['results'];


        $start = new \DateTime();
        $end = new \DateTime('+3 month');
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($start, $interval, $end);

        $dates_disabled = [];
        foreach ($period as $date) {
            $dates_disabled[] = $date->format("d/m/Y");
        }

        $params = [
            'limits' => [
                'min' => date("d/m/Y"),
                'max' => date("d/m/Y", strtotime('+3 month'))
            ],
            'datesDisabled' => $dates_disabled,
        ];
//        dd($params);​
        $data = json_encode([
            'params' => $params,
            'vouchers' => $getVouchers​,
        ]);

//        dd($getVouchers​);
        return view('frontend.pages.account.booking-voucher', compact('data'));
    }


}
