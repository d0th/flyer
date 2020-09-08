<?php


namespace App\Http\Controllers\Api;

use App\Orders;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Date;
use App\Http\Controllers\Api\WebpayController;
use Laravel\Passport\ClientRepository;
use App\Lib\WebPay\WebpayHelper;

use Illuminate\Http\Request;

class ApiController
{
    protected $maxSteps;

    public function addCustomer(Request $request)
    {
        $args = [
            "email" => $request->request->get('email'),
            "password" => sha1($request->request->get('password')),
            "firstname" => $request->request->get('firstname'),
            "lastname" => $request->request->get('lastname'),
            "birthdate" => strtotime($request->request->get('birthdate')),
            "title" => $request->request->get('title'),
            "city" => $request->request->get('city'),
            "country" => $request->request->get('country'),
            "phone" => $request->request->get('phone'),
            "newsletter" => $request->request->get('newsletter'),
        ];

        $params = [
            'do' => 'addCustomer',
            'args' => $args,
        ];

        $data = $this->api('POST', '', $params);

        return $data;
    }

    public function editCustomer(Request $request)
    {
        $args = [
            "email" => $request->request->get('email'),
            "password" => sha1($request->request->get('password')),
            "firstname" => $request->request->get('firstname'),
            "lastname" => $request->request->get('lastname'),
            "birthdate" => strtotime($request->request->get('birthdate')),
            "title" => $request->request->get('title'),
            "city" => $request->request->get('city'),
            "country" => $request->request->get('country'),
            "phone" => $request->request->get('phone'),
            "newsletter" => $request->request->get('newsletter'),
        ];

        $params = [
            'do' => 'addCustomer',
            'args' => $args,
        ];

        $data = $this->api('POST', '', $params);

        if ($data['state'] === true) {
            setcookie('token', $data['results']['token'], time() + 3600 * 14, '/');
//            setcookie('num', $data['results']['num'], time() + 3600 * 24, '/');
            return redirect()->route('booking');
        } else {
            return redirect('/create-account?error=' . http_build_query($data['errors'][0]));
        }
    }

    public function loginInTunn($email, $passwd)
    {
        $args = [
            'email' => $email,
            'passwd' => $passwd,
        ];

        $params = [
            'do' => 'loginCustomer',
            'args' => $args,
        ];

        $data = $this->api('POST', '/', $params);

        return $data;
    }

    public function getUser($token, $typeParams, $type = 'email')
    {
        $args = [
            $type => $typeParams,
            'token' => $token,
        ];

        $params = [
            'do' => 'getCustomer',
            'args' => $args,
        ];

        $data = $this->api('POST', '/', $params);

        if ($data['state'] === true) {
            setcookie('token', $data['results']['token'], time() + 3600 * 24, '/');
        }

        return $data;
    }


    public function getFlying()
    {
        $params = [
            'do' => 'getVouchersCatalog',
            'args' => [],
        ];

        $data = $this->api('POST', '', $params);
        return $data['results'];
    }

    public function getChooseDate(Request $request)
    {
        $catalog_ids = $request['catalog_ids'];
        $cart = $request['cart'];
        $day_start = time();
        $date = new \DateTime(date("Y-m-t", strtotime(date("Y-m-t", strtotime('+5 month')))));
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
            'args' => $args,
        ];

        $data = $this->api('POST', '', $params);

        return $data;
    }

    public function getAvailableBookableDaysMulti(Request $request)
    {
        $voucher_ids = $request['voucher_ids'];
        $day_start = time();
        $date = new \DateTime(date("Y-m-t", strtotime(date("Y-m-t", strtotime('+3 month')))));
        $day_end = $date->getTimestamp();

        $args = [
            "facility_id" => "1",
            "day_start" => $day_start,
            "day_end" => $day_end,
            "voucher_ids" => $voucher_ids,
        ];

        $params = [
            'do' => 'getAvailableBookableDaysMulti',
            'args' => $args,
        ];

        $data = $this->api('POST', '', $params);

        $datesActive = [];

        foreach ($data['results'] as $result) {
            $datesActive[] = date("Y-m-d", (str_replace('day_', '', $result) + 60 * 60 * 3));
        }



        $datesDisabled = ['results' => $this->datesDisabled($datesActive)];

        return $datesDisabled;
    }

    public function datesDisabled($datesActive)
    {
        $datesInactive = $this->datesInactive();

        foreach ($datesInactive as $k => $di) {
            foreach ($datesActive as $da) {
                if ($da == $di) {
                    unset($datesInactive[$k]);
                }
            }
        }
        array_values($datesInactive);
        $res = [];
        foreach ($datesInactive as $i) {
            $res[] = $i;
        }
        return $res;
    }

    public function datesInactive()
    {
        $start = new \DateTime();
        $end = new \DateTime('+3 month');
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($start, $interval, $end);

        $dates_disabled = [];
        foreach ($period as $date) {
            $dates_disabled[] = $date->format("Y-m-d");
        }
        return $dates_disabled;
    }

    public function getChooseDay(Request $request)
    {
        $catalog_ids = $request['catalog_ids'];
        $cart = $request['cart'];
        $day_start = $request['seconds'];
        $day_end = $request['seconds'];

        $args = [
            "facility_id" => "1",
            "day_start" => $day_start,
            "day_end" => $day_end,
            "catalog_ids" => $catalog_ids,
            "cart" => $cart
        ];

        $params = [
            'do' => 'getAvailableTimeslotsPerDayMulti',
            'args' => $args,
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

//        $jsonBody = '{"do":"saveBuyBookingTimeslot", "token":"75bca08063e061b3741e232638aeec78d7d4a106", "args":' . json_encode($params) . '}';

        $params = [
            'do' => 'saveBuyBookingTimeslot',
            'args' => json_encode($args),
        ];

        $data = $this->api('POST', '', $params);
        return $data;
    }

    //pay order
    public function validOrderToInvoice($order)
    {
        $args = [
            'order_num' => $order->order_num_tunn,
            'transaction_code' => $order->billnumber,
            'tpev_signature' => $order->billnumber,
            'payment_fee_amount' => '',
            'payment_fee_percentage' => '',
        ];

        $params = [
            'do' => 'validOrderToInvoice',
            'args' => $args,
        ];

        $data = $this->api('POST', '/', $params);
        return $data;
    }

    public function addOrder()
    {
        $args = [
            [
                'voucher_catalog_id' => '3',
                'qte' => '1',
                'facility_id' => '1',
                'customer_id' => '13',
                'price_cat_id' => '5',
                'optional_products' => [],
                'gift' => '0',
                'gift_to' => 'gift to',
                'gift_message' => 'gift message',
            ],
            [
                'voucher_catalog_id' => '3',
                'qte' => '1',
                'facility_id' => '1',
                'customer_id' => '13',
                'price_cat_id' => '6',
                'booking_timeslot' => '1591961400',
                'optional_products' => [],
                'gift' => '0',
                'gift_to' => 'gift to',
                'gift_message' => 'gift message',
            ],
            [
                'voucher_catalog_id' => '3',
                'qte' => '1',
                'facility_id' => '1',
                'customer_id' => '13',
                'price_cat_id' => '5',
                'booking_timeslot' => '1591961400',
                'optional_products' => [],
                'gift' => '0',
                'gift_to' => 'gift to',
                'gift_message' => 'gift message',
            ]
        ];

        $params = [
            'do' => 'addOrder',
            'args' => $args,
        ];

        $data = $this->api('POST', '/', $params);

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
