<?php
// namespace Vendor;


class AddNewProductCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    //Add new category
    public function addNewCategory(\Step\Acceptance\MultiSteps $I, 
                                    \Page\Acceptance\AdminPage $adminCreate)
    {
      $I->loginAsAdmin();
      $I->amOnPage($adminCreate::$URL);
      $adminCreate->category('Food');
    }
    // Multiple Vendor Add New Product
    public function addNewProduct(\Step\Acceptance\MultiSteps $I,
                                  \Page\Acceptance\AccountPage $vendor,
                                  \Page\Acceptance\ProductPage $product)
    {
      // Vendor Two Add new product
        $I->loginAsVendorTwo();
        $product->create('Burger','450','Food');
        $I->waitForText('Edit Product', 30);
        $I->click('Log out');
      // Vendor One Add New product
        $I->loginAsVendor();
        $product->create('Pizza','250','Food');
        $I->waitForText('Edit Product', 30);

    }
}
