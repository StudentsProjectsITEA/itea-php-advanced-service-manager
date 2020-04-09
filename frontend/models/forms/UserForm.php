<?php

declare(strict_types=1);

namespace frontend\models\forms;

use frontend\models\User;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;


/**
 * Class UserForm
 *
 * @package frontend\models\forms
 */
class UserForm extends Model
{
    /** @var int $mobile */
    public $mobile;

    /** @var string|null $avatar_name */
    public $avatar_name;

    /** @var UploadedFile $eventImage */
    public $eventImage;

    /** @var User|null $model */
    private $model;

    /**
     * UserForm constructor.
     *
     * @param User|null $model
     * @param array $config
     */
    public function __construct(User $model = null, $config = [])
    {
        if ($model) {
            $this->mobile = $model->mobile;
            $this->model = $model;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['mobile', 'trim'],
            ['mobile', 'required'],
            ['mobile', 'string', 'min' => 10],
            [
                'mobile',
                'unique',
                'targetClass' => User::class,
                'message' => 'This mobile number has already been taken.'
            ],
            [['avatar_name'], 'string', 'max' => 255],
            [
                ['eventImage'],
                'file',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,
                'skipOnEmpty' => true,
                'maxSize' => 512000,
                'tooBig' => 'Limit is 500KB',
            ],
        ];
    }

    /**
     * @param UploadedFile $image
     *
     * @return string
     */
    public function uploadImage(UploadedFile $image): string
    {
        return $this->saveImage($image);
    }

    /**
     * @param UploadedFile $image
     *
     * @return string
     */
    public function saveImage(UploadedFile $image): string
    {
        $filename = $this->generateImageName($image);
        $path = Yii::getAlias('@frontend') . '/web/uploads/avatars/';
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

