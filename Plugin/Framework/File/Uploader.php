<?php
namespace ShiftSST\Core\Plugin\Framework\File;
use Magento\Framework\File\Uploader as Sb;
// 2019-10-03
// "Transfer the `Magento\Framework\File\Uploader::checkMimeType()` method modification to a plugin":
// https://github.com/shiftsst/core/issues/12
final class Uploader {
	/**
	 * 2019-10-03
	 * @see \Magento\Framework\File\Uploader::checkMimeType()
	 * @return bool
	 */
	function aroundCheckMimeType() {return true;}
}