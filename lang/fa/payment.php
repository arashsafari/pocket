<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'enums' => [],
    'messages' => [
        'payment_list_found_successfully' => 'فهرست پرداخت ها با موفقیت پیدا شد',
        'payment_successfuly_created' => 'پرداخت با موفقیت ایجاد شد',
        'payment_successfuly_found' => 'پرداخت با موفقیت پیدا شد',
        'payment_successfully_delete' => 'پرداخت با موفقیت حذف شد',
        'the_payment_was_successfully_rejected' => 'پرداخت با موفقیت رد شد',
        'the_payment_was_successfully_approved' => 'پرداخت با موفقیت تایید شد'
    ],
    'validations' => [],
    'errors' => [
        'payment_already_rejected' => 'پرداخت قبلا رد شده است',
        'payment_cant_by_rejected' => 'نمی توانید این پرداخت را رد کنید.',
        'payment_rejected_cant_approved' => 'پرداخت رد شده قابلیت تایید ندارد',
        'payment_already_approved' => 'پرداخت قبلا تایید شده است',
        'payment_cant_by_approved' => 'نمی توانید این پرداخت را تایید کنید.',
        'payment_has_transaction' => 'پرداخت شامل تراکنش است',
        'payment_currency_deactive' => 'ارز پرداخت غیر فعال است',
        'payment_cant_delete' => 'ارز پرداخت غیر فعال حذف میباشد',
        'currency_key_not_found_or_deactive' => 'ارز مورد نظر وجود ندارد یا غیر فعال میباشد',
        'you_can_only_create_same_paymant_after_minutes' => 'پرداخت مشابه بعد از :minute دقیقه قابل ذخیره شدن هستند'

    ],
];
