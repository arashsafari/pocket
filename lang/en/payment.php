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
        'payment_list_found_successfully' => 'Payment list found successfully',
        'payment_successfuly_created' => 'Payment successfully created',
        'payment_successfuly_found' => 'Payment successfully found',
        'payment_successfully_delete' => 'Payment successfully found',
        'the_payment_was_successfully_rejected' => 'The payment was successfully rejected',
        'the_payment_was_successfully_approved' => 'The payment was successfully approved'
    ],
    'validations' => [],
    'errors' => [
        'payment_already_rejected' => 'payment already rejected',
        'payment_cant_by_rejected' => 'payment cant by rejected.',
        'payment_rejected_cant_approved' => 'payment rejected cant approved',
        'payment_already_approved' => 'payment already approved',
        'payment_cant_by_approved' => 'payment cant by approved',
        'payment_has_transaction' => 'payment has transaction',
        'payment_currency_deactive' => 'payment currency deactive',
        'payment_cant_delete' => 'payment cant delete',
        'currency_key_not_found_or_deactive' => 'currency_key not found or deactive',
        'you_can_only_create_same_paymant_after_minutes' => 'you can only create same paymant after :minute minutes'
    ],
];
