<?php 
/**
* 
*/
class Cammino_Pixpayment_DefaultController extends Mage_Core_Controller_Front_Action
{
	public function successAction(){
		$order_id = Mage::getSingleton('checkout/session')->getLastRealOrderId(); 
        $order_details = Mage::getModel('sales/order')->loadByIncrementId($order_id);
		$order_value = $order_details["base_grand_total"];

		Mage::register("pixpayment_ordervalue", $this->getOrderFormatedValue($order_value));
		Mage::register("pixpayment_orderid", $order_id);

		$order_details->sendNewOrderEmail();

		$this->render();	
	}

	public function getOrderFormatedValue($value){
		$baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode(); 
		$currentCurrencyCode = Mage::app()->getStore()->getCurrentCurrencyCode(); 
		$precision = 2; //float point of price
		return Mage::app()->getLocale()->currency($currentCurrencyCode )->toCurrency($value,array('precision'=>$precision));
	}

	public function render(){
		$block = $this->getLayout()->createBlock('pixpayment/success');
		$this->loadLayout();
		$this->analyticsTrack();
		$this->getLayout()->getBlock('root')->setTemplate('page/1column.phtml');
		$this->getLayout()->getBlock('content')->append($block);
		$this->renderLayout();
	}

	private function analyticsTrack() {
		$session = Mage::getSingleton('checkout/session');
		$orderId = $session->getLastOrderId();
		Mage::dispatchEvent('checkout_onepage_controller_success_action', array('order_ids' => array($orderId)));
	}
}