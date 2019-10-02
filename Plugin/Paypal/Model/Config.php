<?php
namespace ShiftSST\Core\Plugin\Paypal\Model;
use Magento\Paypal\Model\Config as Sb;
// 2019-10-02 "How to remove the «PayPal CREDIT» button in Magento ≥ 2.3.1?" https://mage2.pro/t/6030
final class Config {
	/**
	 * 2019-10-02
	 * @see \Magento\Paypal\Model\Config::isMethodAvailable()
	 * @param Sb $sb
	 * @param bool $r
	 * @return bool
	 */
	function afterIsMethodAvailable(Sb $sb, $r) {return $r && 'paypal_express_bml' !== $sb->getMethodCode();}
}