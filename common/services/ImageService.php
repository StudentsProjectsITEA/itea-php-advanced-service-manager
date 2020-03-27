<?php

declare(strict_types=1);

namespace common\services;

use backend\models\forms\CreateImageForm;
use common\components\ServiceService;
use common\models\Service;
use common\repositories\ImageRepository;
use common\models\Image;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

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

    /** @var UploadedFile $file */
    private UploadedFile $file;

    private int $timestamp;

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
     *
     * @throws InvalidConfigException
     */
    public function getImageById($id): Image
    {
        $image = $this->imageRepository->findImage($id);
        $image->name = $this->getImageUrl($image);
        return $image;
    }

    /**
     * @param string $service_id
     *
     * @return Image
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
     * @param $service_id
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function createImage(CreateImageForm $createImage, $service_id)
    {
        $this->timestamp = time();

        $this->file = $createImage->imageFile;
        $name = md5($this->file->baseName . $this->timestamp);

        $image = new Image();
        $createImage->id = Uuid::uuid4()->toString();

        $image->service_id = $service_id;

        $image->name = $name . '.' . $this->file->extension;
        $image->created_time = $this->timestamp;

        $image->load($createImage->getAttributes(), '');

        if ($this->upload($name) && $this->imageRepository->save($image)) {
            return true;
        }

        $createImage->addErrors($image->getErrors());
        \Yii::error('', __METHOD__);

        return false;
    }

    /**
     * @param Image $image
     *
     * @return string
     *
     * @throws InvalidConfigException
     */
    public function getImageUrl(Image $image)
    {
        $date = Yii::$app->formatter->asDate($image->created_time, 'php:Y/m/d');
        return '/uploads/' . $date . '/' . $image->name;
    }

    /**
     * @return bool
     *
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function upload($name)
    {
        $path = $this->getImagePath($this->timestamp);
        FileHelper::createDirectory($path);

        $file = $path . $name . '.' . $this->file->extension;

        if ($this->file->saveAs($file)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $timestamp
     *
     * @return string
     *
     * @throws InvalidConfigException
     */
    public function getImagePath($timestamp)
    {
        $date = Yii::$app->formatter->asDate($timestamp, 'php:Y/m/d');
        return Yii::getAlias('@frontend') . '/web/uploads/' . $date . '/';
    }

    public function deleteImageByServiceId($id) : bool
    {
        $model = $this->getImageByServiceId($id);
        if (!empty($model)) {
            $model->delete();
            return true;
        }

        return false;
    }
}
