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
     * @var ImageService
     */
    private ImageService $imageService;

    /**
     * ServiceService constructor.
     *
     * @param ServiceRepository $serviceRepository
     * @param CategoryService $categoryService
     * @param ImageService $imageService
     */
    public function __construct(ServiceRepository $serviceRepository, CategoryService $categoryService, ImageService $imageService)
    {
        $this->serviceRepository = $serviceRepository;
        $this->categoryService   = $categoryService;
        $this->imageService = $imageService;
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
     * @param CreateImageForm $fileForm
     *
     * @return bool
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function updateService(Service $service)
    {
        $fileForm = new CreateImageForm();
        $imageData = UploadedFile::getInstance($service, 'imageFile');
        $createdImageStatus = true;
        if (!empty($imageData)) {
            // if service has old image - delete it
            $this->imageService->deleteImageByServiceId($service->id);
            // set new image data in image form
            $fileForm->imageFile = $imageData;
            // create image
            $createdImageStatus = $this->imageService->createImage($fileForm, $service->id);
            // get new created image
            $createdImage = $this->imageService->getImageByServiceId($service->id);
            // get new image url
            $imageUrl = $this->imageService->getImageUrl($createdImage);
            // set image url in service model
            $service->main_image_name = $imageUrl;
        }

        $this->serviceRepository->save($service);
        if ($this->serviceRepository->save($service) && $createdImageStatus) {
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
        $imageData = UploadedFile::getInstance($createService, 'imageFile');
        $createService->id = Uuid::uuid4()->toString();
        $createService->user_id = Yii::$app->user->id;
        $service->load($createService->getAttributes(), '');
        $service->status_id = 9;
        $imageSaveStatus = true;
        $serviceMainImageStatus = true;
        $serviceSaveStatus = $this->serviceRepository->save($service);
        if (!empty($imageData)) {
            $image = new CreateImageForm();
            $image->imageFile = $imageData;
            $imageSaveStatus = $this->imageService->createImage($image, $createService->id);
            $createdImage = $this->imageService->getImageByServiceId($createService->id);
            $imageUrl = $this->imageService->getImageUrl($createdImage);
            $service->main_image_name = $imageUrl;
            $serviceMainImageStatus = $this->serviceRepository->save($service);
        }

        if ($serviceSaveStatus && $imageSaveStatus && $serviceMainImageStatus) {
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
}
