<?php

use App\Models\Locations;

function getLocationName($id)
{
    $row = Locations::where('id', $id)->first();
    return $row->name;
}

function hitPay()
{
    // Make Post Fields Array
    $data = [
        'email' => 'tom@test.com',
        'redirect_url' => 'https://test.com/success',
        'reference_number' => 'REF123',
        'webhook' => 'https://test.com/webhook',
        'currency' => 'SGD',
        'amount' => '599'
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.hit-pay.com/v1/payment-requests",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            // Set here requred headers
            'X-BUSINESS-API-KEY' => '9c7f2265843c24bacc8ab2887eb401b28aba5f34871574219bd7943685691503',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'X-Requested-With' => 'XMLHttpRequest'
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return $this->sendSuccess($err, 'All Location');
    } else {
        print_r(json_decode($response));
    }
}
