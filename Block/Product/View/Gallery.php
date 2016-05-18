<?php
/**
 * Created by Skynix.
 * User: Wolf
 * Date: 18.05.2016
 * Time: 10:20
 */

namespace Skynix\ProductDefaultImage\Block\Product\View;

class Gallery extends \Magento\Catalog\Block\Product\View\Gallery
{
    /**
     * Retrieve product images in JSON format
     *
     * @return string
     */
    public function getGalleryImagesJson()
    {
        $imagesItems = [];
        foreach ($this->getGalleryImages() as $image) {
            $imagesItems[] = [
                'thumb' => $image->getData('small_image_url'),
                'img' => $image->getData('medium_image_url'),
                'full' => $image->getData('large_image_url'),
                'caption' => $image->getLabel(),
                'position' => $image->getPosition(),
                'isMain' => $this->isMainImage($image),
            ];
        }
        if (empty($imagesItems)) {
            $imagesItems[] = [
                'thumb' => $this->_imageHelper->init($this->getProduct(), 'product_thumbnail_image')->getUrl(),
                'img' => $this->_imageHelper->init($this->getProduct(), 'product_base_image')->getUrl(),
                'full' => $this->_imageHelper->init($this->getProduct(), 'product_page_image_large')->getUrl(),
                'caption' => '',
                'position' => '0',
                'isMain' => true,
            ];
        }
        return json_encode($imagesItems);
    }
}