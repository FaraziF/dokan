<?php
use Codeception\Util\Locator;



class DokanShippingCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function AdminSettings(\Step\Acceptance\MultiSteps $I)
    {
        $I->loginAsAdmin();
     	$I->click('WooCommerce');
     	$I->wait(5);
        $I->amOnPage('/wp-admin/admin.php?page=wc-settings');
    	$I->click('Shipping');
        $I->click('Add shipping zone');
        $I->wait(4);
        $I->fillField('zone_name','Everywhere');
        $I->click('Add shipping method');
        $I->wait('3');
        $I->selectOption('add_method_id','Vendor Shipping							');
        $I->click('#btn-ok');
        $I->wait(4);
        $I->click('Save changes');
        $I->wait(4);
        $I->amOnPage('/wp-admin/admin.php?page=dokan#/settings/');
        $I->wait(5);
        $I->click(['link' => 'Selling Options']);
        $I->selectOption('#dokan_selling[shipping_fee_recipient]','Vendor');
        $I->click('#dokan_selling #submit');
        $I->waitForElementVisible('#setting-message_updated', 5);
        $I->see('Setting has been saved successfully.');
    }

    public function VendorSettings(\Step\Acceptance\MultiSteps $I)
    {
    	$I->loginAsVendor();
    	$I->amOnPage('/dashboard/settings/shipping/#/');
        $I->wait(3);
        $I->click('//td/a');
        $I->wait(3);
    	$I->click('//a[contains(text(),"Add Shipping Method")]');
    	$I->wait(3);
        $I->selectOption('#shipping_method','Flat Rate');
    	$I->click('//button[contains(.,"Add Shipping Method")]');
        $I->wait(5);
        $I->moveMouseOver(Locator::elementAt('//td',1));
        $I->wait(3);
        $I->click('Edit');
        $I->wait(10);
        $I->fillField('#method_cost','20');
        $I->click('Save Settings');
        $I->wait(3);
        $I->click('Save Changes');

    }

     public function customerViewShipping(\Step\Acceptance\MultiSteps $I)
    {
        $I->loginAsCustomer();
        $I->amOnpage('/shop/');
        $I->selectOption('//select[@name="orderby"]','Sort by latest');
        $I->wait(5);
        $I->click('//main[@id="main"]/ul/li/a/img');
        $I->placeOrder();


    }

}
