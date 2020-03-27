<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\Service;

/**
 * Class ServiceRepository
 * @package common\repositories
 */
class ServiceRepository
{
    /**
     * Return service by id
     *
     * @param string $id
     *
     * @return Service
     */
    public function findService(string $id): ?Service
    {
        return Service::findOne($id);
    }

    /**
     * Return all services
     *
     * @return array| \yii\db\ActiveRecord[]
     */
    public function getServices()
    {
        return Service::find()->all();
    }

    /**
     * @return int|string
     */
    public function countServices()
    {
        return Service::find()->count();
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function searchServiceByTitle($search)
    {
        return Service::find()->andWhere(['ilike', 'title', $search])->andWhere(['status_id' => [10]]);
    }

    /**
     * Save service
     *
     * @param Service $service
     *
     * @return bool
     */

    public function save(Service $service)
    {
        if (!$service->save()) {
            \Yii::error(
                'Error has been occurred while saving service model. Errors = ' . json_encode(
                    $service->getErrors()
                ) . '. Attributes = ' . json_encode($service->getAttributes()),
                __METHOD__
            );

            return false;
        }

        return true;
    }

    /**
     * Return services by category id
     *
     * @param $categoryId
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getServicesByCategoryId($categoryId) : array
    {
        return Service::find()->where(['category_id' => $categoryId])->all();
    }

    /**
     * @param $categoryId
     * @return string
     */
    public function countServicesByCategoryId($categoryId) : int
    {
        return Service::find()->where(['category_id' => $categoryId])->count();
    }

    /**
     * @param $categoryId
     * @param $pageOffset
     * @param $pageLimit
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getServicesForPaginationByCatId($categoryId, $pageOffset, $pageLimit)
    {
        return Service::find()->where(['category_id' => $categoryId, 'status_id' => [10]])->offset($pageOffset)->limit($pageLimit)->all();
    }
    /**
     * Return all services with status active
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getActiveServices() : array
    {
        return Service::find()->where(['status_id' => [10]])->all();
    }

    /**
     * @return string
     */
    public function countActiveServices() : int
    {
        return Service::find()->where(['status_id' => [10]])->count();
    }

    /**
     * @param $pageOffset
     * @param $pageLimit
     * @return array
     */
    public function getActiveServicesForPagination($pageOffset, $pageLimit) : array
    {
        return Service::find()->where(['status_id' => [10]])->offset($pageOffset)->limit($pageLimit)->all();
    }
}
