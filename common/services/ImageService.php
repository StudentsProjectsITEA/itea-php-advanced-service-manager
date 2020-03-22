<?php

declare(strict_types=1);

namespace common\services;

use backend\models\forms\CreateImageForm;
use common\repositories\ImageRepository;
use common\models\Image;
use Ramsey\Uuid\Uuid;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class ImageService
 *
 * @package common\services
 */
class ImageService
{
    /** @var ImageRepository $imageRepository */
    private ImageRepository $imageRepository;

    /** @var string $id */
    private string $id;

    /**
     * ImageService constructor.
     *
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @param string $id
     *
     * @return Image
     */
    public function getImageById($id): Image
    {
        return $this->imageRepository->findImage($id);
    }

    /**
     * @param string $service_id
     *
     * @return ActiveRecord[]
     */
    public function getImageByServiceId(string $service_id)
    {
        return $this->imageRepository->findServiceImages($service_id);
    }

    /**
     * @return ActiveQuery
     */
    public function getImages(): ActiveQuery
    {
        return $this->imageRepository->getImages();
    }

    /**
     *
     * Method for create new image
     *
     * @param CreateImageForm $createImage
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function createImage(CreateImageForm $createImage)
    {
        $image = new Image();
        $createImage->id = Uuid::uuid4()->toString();
        $image->load($createImage->getAttributes(), '');
        if ($this->imageRepository->save($image)) {
            return true;
        }

        $createImage->addErrors($image->getErrors());
        \Yii::error('', __METHOD__);

        return false;
    }
}
