<?php

/* 
 * PaypalExpress Class 
 * This class is used to handle PayPal API related operations 
 */
// Include configuration file  

require_once 'paypal.config.php';

class PaypalExpress
{
    public $paypalURL = PAYPAL_SANDBOX ? 'https://api-m.sandbox.paypal.com/v1/' : 'https://api-m.paypal.com/v1/';
    public $paypalURL2 = PAYPAL_SANDBOX ? 'https://api-m.sandbox.paypal.com/v2/' : 'https://api-m.paypal.com/v2/';
    public $paypalEnv = PAYPAL_SANDBOX ? 'sandbox' : 'production';
    public $paypalClientID = PAYPAL_API_CLIENT_ID;
    private $paypalSecret = PAYPAL_API_SECRET;

    public function validate($paymentID)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->paypalURL . 'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->paypalClientID . ":" . $this->paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);

        if (empty($response)) {
            return false;
        } else {
            $jsonData = json_decode($response);
            $curl = curl_init($this->paypalURL2 . 'payments/payment/' . $paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/xml',
                'Content-Type: application/json'
            ));
            $respons = curl_exec($curl);
            curl_close($curl);

            // Transaction data
            $result = json_decode($respons);

            return $result;
        }
    }
}
