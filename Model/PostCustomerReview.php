<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Utils\Image;

class PostCustomerReview extends BaseEntity
{

    const POST_TYPE = 'customerReview';
    const POST_TYPE_NAME = 'Recenze';
    const POST_PRESENTER = 'PostCustomerReview';

    const POST_IS_SORTABLE = true;

    public static function isSortable()
    {
        return self::POST_IS_SORTABLE ?: false;
    }

    /**
     * @return array
     */
    public function getPostData()
    {
        return [
            'customer_name' => [
                'identifier' => 'customer_name',
                'postData' => new PostDataString,
                'formField' => true,
                'formLabel' => __('Jména klienta'),
                'formRequired' => true,
                'formRequiredText' => __('Vyplňte prosím jméno.'),
                'gridColumn' => true,
            ],
            'customer_job' => [
                'identifier' => 'customer_job',
                'postData' => new PostDataString,
                'formField' => true,
                'formLabel' => __('Pracovní pozice'),
                'formText' => __('Název společnosti - název pracovní pozice.'),
                'formRequired' => false,
                'formRequiredText' => __('Vyplňte prosím pracovní pozici.'),
                'gridColumn' => true,
            ],
            'text_1' => [
                'identifier' => 'text_1',
                'postData' => new PostDataText,
                'formField' => true,
                'formLabel' => __('Text recenze'),
                'formRequired' => true,
                'formRequiredText' => '',
                'gridColumn' => false,
            ],
            'image_1' => [
                'identifier' => 'image_1',
                'postData' => new PostDataImage,
                'postDataAttributes' => [
                    'imageTypes' => [
                        'original' => [
                            'name' => 'original',
                            'path' => 'upload/customer-review/original/',
                            'width' => 1900,
                            'height' => null,
                            'flags' => Image::SHRINK_ONLY,
                            'quality' => 90,
                            'type' => Image::JPEG,
                            'extension' => 'jpeg', // TODO get from type
                        ],
                        'full' => [
                            'name' => 'full',
                            'path' => 'upload/customer-review/full/',
                            'width' => 120,
                            'height' => 120,
                            'flags' => Image::EXACT,
                            'quality' => 90,
                            'type' => Image::JPEG,
                            'extension' => 'jpeg', // TODO get from type
                        ],
                        'adminThumb' => [
                            'name' => 'adminThumb',
                            'path' => 'upload/customer-review/adminThumb/',
                            'width' => 120,
                            'height' => 120,
                            'flags' => Image::SHRINK_ONLY,
                            'quality' => 90,
                            'type' => Image::JPEG,
                            'extension' => 'jpeg', // TODO get from type
                        ],
                    ],
                ],
                'formField' => true,
                'formLabel' => __('Obrázek'),
                'formRequired' => false,
                'formRequiredText' => '',
                'gridColumn' => true,
            ],
        ];
    }
}
