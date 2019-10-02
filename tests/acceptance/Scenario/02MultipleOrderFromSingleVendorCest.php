<?php
use Codeception\Util\Locator;

class MultipleOrderFromSingleVendorCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // Customer add to cart multiple order
    public function multipleOrderFromSingleVendor(AcceptanceTester $I,
                                  \Step\Acceptance\Login $customer,
                                  \Step\Acceptance\Order $customerMultiple)
    {
      $customer->loginAsCustomer();
      $I->amOnPage('store-listing/');
      $I->click('//div[@id="dokan-seller-listing-wrap"]/div/ul/li/div/div[2]/a');
      $I->click('//div[@id="dokan-content"]/div[4]/ul/li/a/img');
      $I->click('Add to cart');
      $I->amOnPage('store-listing/');
      $I->click('//div[@id="dokan-seller-listing-wrap"]/div/ul/li/div/div[2]/a');
      $I->click('//div[@id="dokan-content"]/div[4]/ul/li[2]/a/img');
      $customerMultiple->orderProcessing();

    }

    //Vendore update multiple order status
    public function orderStatusChange(\Step\Acceptance\Login $I,
                                        \Step\Acceptance\Vendor $vendor)
    {
      $I->loginAsVendor();
      $vendor->updateOrderStatus();
    }
}