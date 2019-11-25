<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;

class Paypal extends Model
{
    //
    protected $apiContext;
    public function __construct(){

    }
    public static function getContext(){
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AVu2LHmEWE3zFyB0o_zfZMeJcCCTkrIX7HtUHH7lttkFtSO6ktnWS4zRcGOxpiJPKDpQwbujPx6odxLQ',     // ClientID
                'EGQ0cte9yRGcqmByVomt__nMh5dnT0shYFeBGlVD-UJlnlkP6PvRBFOrJMejtap1tDNuoDLupsFGeEn9'      // ClientSecret
            )
        );
        $apiContext->setConfig(
            array(
              'log.LogEnabled' => true,
              'log.FileName' => 'PayPal.log',
              'log.LogLevel' => 'DEBUG'
            )
        );
        return $apiContext;
    }

    public static function configCall($itemList,$totalAmount){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($totalAmount);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:8000/executePayment")
            ->setCancelUrl("http://localhost:8000/cancelPayment");

        $payment = new Payment();
        $payment->setIntent('Order')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        return $payment;
    }

    public static function makeCall($itemList,$totalAmount){
        // After Step 3
        try {
            $payment = self::configCall($itemList,$totalAmount);
            $payment->create(self::getContext());
            //echo $payment;
            //echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
            return $payment->getApprovalLink();
        }
        catch (PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
            return $ex->getData();
        }
    }
}
