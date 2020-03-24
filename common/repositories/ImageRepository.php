<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\Image;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class ImageRepository
{
    /**
     * Return image by id
     *
     * @param string $id
     *
     * @return Image
     */
    public function findImage(string $id): Image
    {
        return Image::findOne($id);
    }

    /**
     * @param string $service_id
     *
     * @return ActiveRecord[]
     */
    public function findServiceImages(string $service_id)
    {
        return Image::find()->where(['service_id' => $service_id])->all();
    }

    /**
     * Return all images
     *
     * @return ActiveQuery
     */
    public function getImages()
    {
        return Image::find();
    }

    /**
     * Save category
     *
     * @param Image $image
     *
     * @return bool
     */
    public function save(Image $image)
    {
        if ( ! $image->save()) {
            \Yii::error(
                'Error has been occurred while saving Message model. Errors = ' . json_encode( $image->getErrors()) . '. Attributes = ' . json_encode($image->getAttributes()),
                __METHOD__
            );

            return false;
        }

        return true;
    }

}