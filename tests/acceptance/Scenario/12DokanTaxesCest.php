<?php 
//namespace Scenario;


class DokanTaxesCest
{
    public function _before(AcceptanceTester $I)
    {
    }
    //Admin uncheck Taxes & set global settings
    public function AdminSettings(\Step\Acceptance\MultiSteps $I)
    {
    	$I->loginAsAdmin();
     	$I->click('WooCommerce');
     	$I->wait(5);
        $I->amOnPage('/wp-admin/admin.php?page=wc-settings');
    	if ($I->tryToSeeCheckboxIsChecked('#woocommerce_calc_taxes')){
             $I->checkOption('#woocommerce_calc_taxes');
        }

        
        $I->click("Save changes");
        $I->see('Your settings have been saved.');

        $I->click('Dokan');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(5);
        $I->click(['link' => 'Selling Options']);
        $I->selectOption('#dokan_selling[tax_fee_recipient]','Vendor');
        //$I->waitForElement('(//input[@id="submit"])[2]', 30);
        $I->click('#dokan_selling #submit');
        $I->waitForElementVisible('#setting-message_updated', 5);
        $I->waitForElement('.metabox-holder',30);
         $I->amOnpage('/wp-admin/admin.php?page=wc-settings&tab=general');
        
        if ($I->tryToDontSeeCheckboxIsChecked('#woocommerce_calc_taxes')){
            $I->checkOption('#woocommerce_calc_taxes');
        }
        $I->click('Save changes');

        $I->wait(5);
        $I->click('Tax');
        $I->click('Standard rates');
        $I->click('Insert row');
        $I->fillfield('//td[5]/input','14.00');
        $I->click('Save changes');
        $I->wait(8);


     }

   //customer View

    public function customerViewTaxes(\Step\Acceptance\MultiSteps $I)
    {
    	$I->loginAsCustomer();
        $I->amOnpage('/shop/');
        $I->selectOption('//select[@name="orderby"]','Sort by latest');
        $I->wait(5);
        $I->click('//main[@id="main"]/ul/li/a/img');
        // $I->wait(5);
        // $I->click('//button[@name="add-to-cart"]');
        // $I->click('View cart');
        // $I->click('Proceed to checkout');
        $I->wait(5);
        $I->placeOrder();
        //$I->click('//div[@id="payment"]/div/button');


    }
}
