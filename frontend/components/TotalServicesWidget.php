<?php

declare(strict_types=1);

namespace frontend\components;

use yii\base\Widget;
use common\repositories\ServiceRepository;

/**
 * Class TotalServicesWidget
 * @package frontend\components
 */
class TotalServicesWidget extends Widget
{
    /**
     * @var string
     */
    public string $total;
    /**
     * @var ServiceRepository
     */
    private ServiceRepository $serviceRepository;

    /**
     * TotalServicesWidget constructor.
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return int|string
     */
    public function run()
    {
        return $this->serviceRepository->countServices();
    }
}
