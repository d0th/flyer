<?php


namespace App\Lib\WebPay;


class WebpayHelper
{
    public function check($transaction_id)
    {
        $postdata = '*API=&API_XML_REQUEST=' . urlencode('
        <?xml version="1.0" encoding="ISO-8859-1" ?>
        <wsb_api_request>
            <command>get_transaction</command>
            <authorization>
                <username>' . $this->configData('login') . '</username>
                <password>' . md5($this->configData('pswd')) . '</password>
            </authorization>
            <fields>
                <transaction_id>' . $transaction_id . '</transaction_id>
            </fields>
        </wsb_api_request>
        ');

        $curl = curl_init($this->configData('check_url'));
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode >= 200 && $httpcode < 300) {
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);
        } else {
            return ['status' => 'error'];
        }

        return $array;
    }

    public function formPayment($orderNumber, $orderAmount, $userMail, $userPhone)
    {
        $webpay_args = array(
            'wsb_version' => "2",
            'wsb_language_id' => "russian",
            'wsb_email' => $userMail,
            'wsb_phone' => $userPhone,
            'wsb_order_num' => (string)$orderNumber,
            'wsb_currency_id' => 'BYN',
            'wsb_total' => $orderAmount,
            'site_redirect_url' => $this->configData('APP_URL') . '/typ/success',
            'wsb_notify_url ' => $this->configData('APP_URL') . '/api/v1/payment/notify',
            'wsb_return_url' => $this->configData('APP_URL') . '/typ/success',
            'wsb_cancel_return_url' => $this->configData('APP_URL') . '/typ/err',
            'wsb_storeid' => $this->configData('store_id'),
            'wsb_customer_name' => $this->configData('invoice_item_name'),
            'wsb_seed' => $this->configData('wsb_seed'),
            'wsb_test' => $this->configData('wsb_test'),
            'wsb_invoice_item_name[0]' => 'Оплата заказа',
            'wsb_invoice_item_quantity[0]' => 1,
            'wsb_invoice_item_price[0]' => $orderAmount,
        );

        $webpay_args['wsb_signature'] = $this->calculateSignature($webpay_args);
        $url_wp = $this->configData('submit_url');

        return [
            'link' => $url_wp,
            'form' => $webpay_args
        ];
    }

    private function calculateSignature($params)
    {
        $hash = sha1($params["wsb_seed"] . $params["wsb_storeid"] . $params["wsb_order_num"] . $params["wsb_test"] . $params["wsb_currency_id"] . $params["wsb_total"] . $this->configData('secret_key'));
        return $hash;
    }

    private function configData($type)
    {
        $testMode = config('payments.MERCHANT_TESTMODE');
        $data = $testMode ? config('payments.test.' . $type) : config('payments.prod.' . $type);

        return $data;
    }
}
