<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Orders
 * @package App
 * @method static \Illuminate\Database\Query\Builder|\App\Orders whereOrderNumTunn($value)
 */
class Orders extends Model
{
    const _ORDER_STATUS_NEW = 0;
    const _ORDER_STATUS_ORDERED = 1;
    const _ORDER_STATUS_ORDERED_PAID = 2;
    const _ORDER_STATUS_APPROVED = 3;
    const _ORDER_STATUS_REJECTED = 4;
    const _ORDER_STATUS_NEED_CHECK = 5;
    const _ORDER_STATUS_PROCESSED = 6;
    const _ORDER_STATUS_CANCELED = 7;

    public function setOrderNumber()
    {
        return $this->order_number = md5(time() + rand(1, 1000));
    }

    /**
     * Load order by order number
     *
     * @param string $number
     * @return \self
     */
    public static function getByNumber($number)
    {
        return self::whereOrderNumTunn($number)
            ->first();
    }

    /**
     * Check order status is new (not paid)
     *
     * @return bool
     */
    public function isStatusNotPaid()
    {
        return $this->status == self::_ORDER_STATUS_NEW || $this->status == self::_ORDER_STATUS_REJECTED;
    }


}
