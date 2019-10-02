<?php
namespace ShiftSST\Core\Plugin\CatalogImportExport\Model\Import;
use Magento\CatalogImportExport\Model\Import\Uploader as Sb;
// 2019-10-03
// "Transfer the `Magento\CatalogImportExport\Model\Import\Uploader::init()` method modification to a plugin"
// https://github.com/shiftsst/core/issues/16
class Uploader extends Sb {
	// 2019-10-03
	function __construct() {}
	
	/**
	 * 2019-10-03
	 * @see \Magento\CatalogImportExport\Model\Import\Uploader::init()
	 * @param Sb $sb
	 */
	function aroundExecute(Sb $sb) {
        $sb->setAllowRenameFiles(true);
        $sb->setAllowCreateFolders(true);
        $sb->setFilesDispersion(true);
        $sb->setAllowedExtensions(array_keys($sb->_allowedMimeTypes));
		// 2019-10-03
		// I have commented out the 2 lines below to replicate a custom modification in Magento 2.2.8.
        //$imageAdapter = $sb->_imageFactory->create();
        //$this->addValidateCallback('catalog_product_image', $imageAdapter, 'validateUploadFile');
        $sb->_uploadType = self::SINGLE_STYLE;
	}
}