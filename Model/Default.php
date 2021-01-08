<?php
class Cammino_Pixpayment_Model_Default extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'pixpayment';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('pixpayment/default/success');
	}
}