<?php
namespace ShiftSST\Core\Plugin\Framework\Image\Adapter;
use Magento\Framework\Image\Adapter\AbstractAdapter as Sb;
// 2019-10-03
// "Transfer the `Magento\Framework\Image\Adapter\AbstractAdapter::getSupportedFormats()`
// method modification to a plugin": https://github.com/shiftsst/core/issues/13
final class AbstractAdapter {
	/**
	 * 2019-10-03
	 * @see \Magento\Framework\Image\Adapter\AbstractAdapter::getSupportedFormats()
	 * @param Sb $sb
	 * @param string[] $r
	 * @return string[]
	 */
	function afterGetSupportedFormats(Sb $sb, $r) {return array_unique(array_merge($r, ['pdf']));}
}

