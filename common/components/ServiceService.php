<?php

declare(strict_types=1);

namespace common\components;

use backend\models\forms\CreateImageForm;
use common\models\Service;
use common\services\ImageService;
use frontend\models\forms\CreateServiceForm;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\helpers\ArrayHelper;
use common\models\ServiceStatusId;
use common\repositories\ServiceRepository;
use yii\web\UploadedFile;

/**
 * Class ServiceService
 * @package common\components
 */
class ServiceService
{
    /**
     * @var ServiceRepository
     */
    private ServiceRepository $serviceRepository;
    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * ServiceService constructor.
     *
     * @param ServiceRepository $serviceRepository
     * @param CategoryService $categoryService
     */
    public function __construct(ServiceRepository $serviceRepository, CategoryService $categoryService)
    {
        $this->serviceRepository = $serviceRepository;
        $this->categoryService   = $categoryService;
    }


    /**
     * Get service model by service id
     *
     * @param string $id
     *
     * @return Service
     */
    public function getServiceById(string $id): ?Service
    {
        return $this->serviceRepository->findService($id);
    }

    /**
     * Get service status label by status id
     *
     * @param int $statusId
     *
     * @return string
     */
    public function getStatusLabel(int $statusId): string
    {
        return ServiceStatusId::STATUS_IDS_MAP[$statusId];
    }

    /**
     * Method for update service
     *
     * @param Service $service
     *
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function updateService(Service $service)
    {
        $service->status_id = 9;
        $image = UploadedFile::getInstance($service, 'imageFile');
        if (!empty($image)) {
            $service->main_image_name = $this->saveImage($image);
        }

        if ($this->serviceRepository->save($service)) {
            return true;
        }

        $service->addErrors($service->getErrors());
        \Yii::error('', __METHOD__);

        return false;
    }

    /**
     * Get categories array for dropdown input in filter
     *
     * @return array
     */
    public function getCategoriesFilterList(): array
    {
        return ['all' => 'All'] + ArrayHelper::map($this->categoryService->getCategoriesList(), 'id', 'title');
    }

    /**
     * Get categories array for dropdown input in service form
     *
     * @return array
     */
    public function getCategoriesList(): array
    {
        return ArrayHelper::map($this->categoryService->getCategoriesList(), 'id', 'title');
    }

    /**
     * Get statuses array for dropdown input in filter
     *
     * @return array
     */
    public function statusesDropdownList(): array
    {
        return [777 => 'All'] + $this->getStatusesIds();
    }

    /**
     * Get service statuses map
     *
     * @return array
     */
    public function getStatusesIds(): array
    {
        return ServiceStatusId::STATUS_IDS_MAP;
    }

    /**
     * Get services by category id
     *
     * @param $categoryId
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getServicesByCategoryId($categoryId) {
        return $this->serviceRepository->getServicesByCategoryId($categoryId);
    }

    /**
     *
     * Method for create new service
     *
     * @param CreateServiceForm $createService
     *
     * @return bool
     * @throws \Exception
     */
    public function createService(CreateServiceForm $createService)
    {
        $service = new Service();
        $image = UploadedFile::getInstance($createService, 'imageFile');
        $createService->id = Uuid::uuid4()->toString();
        $createService->user_id = Yii::$app->user->id;
        $service->load($createService->getAttributes(), '');
        $service->status_id = 9;

        if (!empty($image)) {
            $service->main_image_name = $this->saveImage($image);
        }

        if ($this->serviceRepository->save($service)) {
            return true;
        }

        $createService->addErrors($service->getErrors());
        \Yii::error('', __METHOD__);

        return false;
    }

    /**
     * Return only active status
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getActiveServices() : array
    {
        return $this->serviceRepository->getActiveServices();
    }

    /**
     * @return string
     */
    public function countActiveServices() : int
    {
        return $this->serviceRepository->countActiveServices();
    }

    /**
     * @param $pageOffset
     * @param $pageLimit
     * @return array
     */
    public function getActiveServicesForPagination($pageOffset, $pageLimit) : array
    {
        return $this->serviceRepository->getActiveServicesForPagination($pageOffset, $pageLimit);
    }

    /**
     * Changing service status to delete
     *
     * @param Service $service
     */
    public function deleteService(Service $service) {
        $service->status_id = 0;
        $this->serviceRepository->save($service);
    }

    /**
     * @param UploadedFile $image
     *
     * @return string
     */
    public function saveImage(UploadedFile $image): string
    {
        $filename = $this->generateImageName($image);
        $path = Yii::getAlias('@frontend') . '/web/uploads/services/';
        $image->saveAs($path . $filename);

        return $filename;
    }

    /**
     * @param UploadedFile $image
     *
     * @return string
     */
    private function generateImageName(UploadedFile $image): string
    {
        do {
            $name = substr(md5(microtime() . rand(0, 1000)), 0, 20);
            $file = strtolower($name . '.' . $image->extension);
        } while (file_exists($file));

        return $file;
    }
}
