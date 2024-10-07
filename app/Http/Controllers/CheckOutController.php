<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class CheckoutController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );
        
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function createPayment(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = new Item();
        $item1->setName('Item Name') // Replace with your product name
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(100); // Replace with your product price

        $itemList = new ItemList();
        $itemList->setItems([$item1]);

        $transaction = new Transaction();
        $transaction->setAmount(new \PayPal\Api\Amount(['total' => '100', 'currency' => 'USD']))
            ->setItemList($itemList)
            ->setDescription('Transaction description');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('payment/status')) // Specify your return URL
            ->setCancelUrl(url('payment/cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // Handle exception
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        return redirect($payment->getApprovalLink());
    }

    public function paymentStatus(Request $request)
    {
        // Handle successful payment
        // You can use the $request->get('paymentId') and $request->get('PayerID') to confirm the payment
        return 'Payment was successful!';
    }

    public function paymentCancel()
    {
        return 'Payment was cancelled.';
    }
}

