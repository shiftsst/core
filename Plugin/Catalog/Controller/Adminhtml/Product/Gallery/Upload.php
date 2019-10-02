<?php
namespace ShiftSST\Core\Plugin\Catalog\Controller\Adminhtml\Product\Gallery;
use Magento\Catalog\Controller\Adminhtml\Product\Gallery\Upload as Sb;
use Magento\Framework\App\Filesystem\DirectoryList;
// 2019-10-03
// "Transfer the `Magento\Framework\File\Uploader::checkMimeType()` method modification to a plugin":
// https://github.com/shiftsst/core/issues/12
class Upload extends Sb {
	// 2019-10-03
	function __construct() {}

	/**
	 * 2019-10-03
	 * @see \Magento\Catalog\Controller\Adminhtml\Product\Gallery\Upload::execute()
	 * @param Sb $sb
	 * @return \Magento\Framework\Controller\Result\Raw
	 */
	function aroundExecute(Sb $sb) {
		try {
			$uploader = $sb->_objectManager->create(
				\Magento\MediaStorage\Model\File\Uploader::class,
				['fileId' => 'image']
			);
			// 2019-10-03 I have added the `pdf` item to replicate a custom modification in Magento 2.2.8.
			$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'pdf']);
			// 2019-10-03
			// I have commented out the 2 lines below to replicate a custom modification in Magento 2.2.8.
			/** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
			//$imageAdapter = $sb->_objectManager->get(\Magento\Framework\Image\AdapterFactory::class)->create();
			//$uploader->addValidateCallback('catalog_product_image', $imageAdapter, 'validateUploadFile');
			$uploader->setAllowRenameFiles(true);
			$uploader->setFilesDispersion(true);
			/** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
			$mediaDirectory = $sb->_objectManager->get(\Magento\Framework\Filesystem::class)
				->getDirectoryRead(DirectoryList::MEDIA);
			$config = $sb->_objectManager->get(\Magento\Catalog\Model\Product\Media\Config::class);
			$result = $uploader->save($mediaDirectory->getAbsolutePath($config->getBaseTmpMediaPath()));

			$sb->_eventManager->dispatch(
				'catalog_product_gallery_upload_image_after',
				['result' => $result, 'action' => $sb]
			);

			unset($result['tmp_name']);
			unset($result['path']);

			$result['url'] = $sb->_objectManager->get(\Magento\Catalog\Model\Product\Media\Config::class)
				->getTmpMediaUrl($result['file']);
			$result['file'] = $result['file'] . '.tmp';
		} catch (\Exception $e) {
			$result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
		}

		/** @var \Magento\Framework\Controller\Result\Raw $response */
		$response = $sb->resultRawFactory->create();
		$response->setHeader('Content-type', 'text/plain');
		$response->setContents(json_encode($result));
		return $response;
	}
}