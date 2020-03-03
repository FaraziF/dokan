<?php 


class DokanStripePaymentCest
{
    public function _before(AcceptanceTester $I)
    {
    }

  //  tests
    public function adminsetDokanStripe(\Step\Acceptance\MultiSteps $I)
    {
    	$I->loginAsAdmin();
     	$I->click('WooCommerce');
     	$I->wait(5);
        $I->amOnPage('/wp-admin/admin.php?page=wc-settings');
        $I->click('Payments');

        
        $I->wait(3);
        $I->click(['css'=>'tr:nth-child(7) .wc-payment-gateway-method-title']);
        $I->wait(4);

        if ($I->tryToSeeCheckboxIsChecked('#woocommerce_dokan-stripe-connect_enabled')){
             $I->checkOption('#woocommerce_dokan-stripe-connect_enabled');
        }

        if ($I->tryToSeeCheckboxIsChecked('#woocommerce_dokan-stripe-connect_testmode')){
             $I->checkOption('#woocommerce_dokan-stripe-connect_testmode');
        }

        //  if ($I->tryToSeeCheckboxIsChecked('#woocommerce_dokan-stripe-connect_stripe_checkout')){
        //      $I->checkOption('#woocommerce_dokan-stripe-connect_stripe_checkout');
        // }

        $I->fillField('#woocommerce_dokan-stripe-connect_test_secret_key','sk_test_DoMOe1KGxXxEqDi0DWqRqggp00zHAkctNi');
        $I->fillField('#woocommerce_dokan-stripe-connect_test_publishable_key','pk_test_Hg1UlS12grPn9EMWCj3j9qng00VYJ7sx4w');
        $I->fillField('#woocommerce_dokan-stripe-connect_test_client_id','ca_GNk3MaeyPFft911y4ruiyZeZirFMsSl5');
        
        $I->click('Save changes');

        $I->click('Dokan');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(2);
        $I->click(['link'=>'Withdraw Options']);
        if ($I->tryToSeeCheckboxIsChecked('#woocommerce_dokan-stripe-connect_stripe_checkout')){
             $I->checkOption('#woocommerce_dokan-stripe-connect_stripe_checkout');
         }
         $I->click('Save Changes');
        $I->wait(5);


    }  
     public function vendorsetDokanStripe(\Step\Acceptance\MultiSteps $I)  
     {
     	$I->loginAsVendor();
     	$I->amOnPage('/dashboard/settings/payment/');
     	$I->wait(4);
     	//$I->moveMouseOver('//a[@class="clear"]//img');
     	if ($I->tryToClick('//a[@class="clear"]//img')){
             $I->trytoDontsee('//a[@class="clear"]//img');
             //$I->click('//a[@class="clear"]//img');
         }
     	//$I->click(['css'=>'img']);
     	$I->wait(5);
     	if ($I->tryToclick(['link'=> 'Skip this account form'])){
             $I->wait(4);
         }
     	//$I->click(['link'=> 'Skip this account form']);
     	$I->wait(4);


     }

       public function customerPayWithStripe(\Step\Acceptance\MultiSteps $I)
    {
        $I->loginAsCustomer();
        $I->amOnpage('/shop/');
        $I->selectOption('//select[@name="orderby"]','Sort by latest');
        $I->wait(5);
        $I->click('//main[@id="main"]/ul/li/a/img');
        $I->click('Add to cart');
		$I->click('View cart');
		$I->click('Proceed to checkout');
		$I->click('#payment_method_dokan-stripe-connect');
		$I->wait(5);
		
       
		$I->fillField('#dokan-stripe-connect-card-number','customerone@gmail.com');
		$I->fillField('#dokan-stripe-connect-card-number','4242 4242 4242 4242');
		$I->fillField('#dokan-stripe-connect-card-expiry','02/27');
		$I->fillField('#dokan-stripe-connect-card-cvc','1234');
		$I->click('Place order');
		
		$I->wait(3);
       $I->waitForText('Thank you. Your order has been received.', 30, '.woocommerce-order');
		$I->see('Thank you. Your order has been received.');

    }
}
