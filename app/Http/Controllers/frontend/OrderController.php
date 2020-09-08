<?php


namespace App\Http\Controllers\frontend;

use App\Lib\WebPay\WebpayHelper;
use App\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Log;

class OrderController extends ApiController
{

    public function createOrder(Request $request)
    {

        $orderTunn = $this->addOrder();
        $res = $orderTunn['results'][0];
        $res_num = $res['num'];
        $res_price = $res['total_ttc'] * 100;

        $email = 'misha@gik.by';
        $phone = '+375297069837';

        $payment = new WebpayHelper();
        $form = $payment->formPayment($res_num, $res['total_ttc'], $email, $phone);
        $order = new Orders();
        $order->setOrderNumber();
        $order->order_data = '';
        $order->phone = $phone;
        $order->email = $email;
        $order->price = $res_price;
        $order->order_num_tunn = $res_num;
        $order->order_id_tunn = '';
        $order->billnumber = '';
        $order->save();

        return view('frontend.order.payment-form', compact(
            'form'
        ));
    }

    public function payOrder($order)
    {
        $res = $this->validOrderToInvoice($order);
        return $res;
    }

    public function thankYouPage($status, Request $request)
    {
        Log::info($request);
        if ($status == 'success' && $request->has('wsb_order_num') && $request->has('wsb_tid')) {
            $billnumber = $request->get('wsb_tid');
            $order_num_tunn = $request->get('wsb_order_num');
            $order = Orders::getByNumber($order_num_tunn);

            if ($order->isStatusNotPaid() == false) {
                return view('frontend.thankyoupage.success', compact('order'));
            }
            $payment = new WebpayHelper();
            $check = $payment->check($billnumber);
            $success_status = [1, 4];
            if ($check['status'] == 'success' && in_array($check['fields']['payment_type'], $success_status)) {

                $order->billnumber = $billnumber;
                $pay_in_tunn = $this->payOrder($order);
                if ($pay_in_tunn['state'] !== true) {
                    return redirect('/typ/err');
                }
                if ($check['fields']['amount'] * 100 != $order['price'] || $order['price'] != $pay_in_tunn['results']['paid_ttc'] * 100) {
                    return redirect('/typ/err');
                }

                $order->status = 1;
                $order->pay_type = 'card';
                $order->save();
            }else{
                return redirect('/typ/err');
            }
        } else {
            return view('frontend.thankyoupage.err');
        }


    }

    public function notifyOrder(Request $request)
    {
        Log::info($request);
    }
}
