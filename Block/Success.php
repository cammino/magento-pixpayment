<?php
/**
* 
*/
class Cammino_Pixpayment_Block_Success extends Mage_Payment_Block_Form
{
	private $_order;

	public function _construct() {
		$this->_orderValue = Mage::registry("pixpayment_ordervalue");
		$this->_orderId = Mage::registry("pixpayment_orderid");
		$this->setTemplate("pixpayment/success.phtml");
		parent::_construct();
	}

	public function getOrderValue(){
		return $this->_orderValue;
	}

	public function getInstructions() {
		return Mage::getStoreConfig('payment/pixpayment/instructions');
	}

	public function getOrderId(){
		return $this->_orderId;
	}
	
}