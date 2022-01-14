<?php

namespace App\Enums;

/**
 * Class OrderPaymentStatusEnum
 *
 * @package \App\Enums
 */
class OrderPaymentStatusEnum
{
    const NOT_PAID = 'NOT_PAID';
    const PAID = 'PAID';

    const TYPES = [
        self::NOT_PAID,
        self::PAID
    ];
}
