<?php

declare(strict_types=1);

namespace common\services;

use backend\models\forms\CreateAvatarForm;
use common\repositories\AvatarRepository;
use common\models\Avatar;
use frontend\models\User;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Class AvatarService
 *
 * @package common\services
 */
class AvatarService
{
    /** @var AvatarRepository $avatarRepository */
    private AvatarRepository $avatarRepository;

    /** @var string $id */
    private string $id;

    /** @var UploadedFile $file */
    private UploadedFile $file;

    private int $timestamp;

    /**
     * ImageService constructor.
     *
     * @param AvatarRepository $avatarRepository
     */
    public function __construct(AvatarRepository $avatarRepository)
    {
        $this->avatarRepository = $avatarRepository;
    }

    /**
     * @param string $id
     *
     * @return Avatar
     *
     * @throws InvalidConfigException
     */
    public function getAvatarById($id): Avatar
    {
        $avatar = $this->avatarRepository->findAvatar($id);
        $avatar->name = $this->getAvatarUrl($avatar);
        return $avatar;
    }

    /**
     * @param string $user_id
     *
     * @return ActiveRecord
     */
    public function getAvatarByUserId(string $user_id)
    {
        return $this->avatarRepository->findUserAvatar($user_id);
    }

    /**
     * @return ActiveQuery
     */
    public function getAvatars(): ActiveQuery
    {
        return $this->avatarRepository->getAvatars();
    }

    /**
     *
     * Method for create new avatar
     *
     * @param CreateAvatarForm $createAvatar
     *
     * @return bool
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function createAvatar(CreateAvatarForm $createAvatar)
    {
        if (!$createAvatar->validate()) {
            return false;
        }

        $this->timestamp = time();
        $this->file = $createAvatar->imageFile;
        $name = md5($this->file->baseName . $this->timestamp);

        $avatar = new Avatar();
        $createAvatar->id = Uuid::uuid4()->toString();
        $avatar->user_id = Yii::$app->user->getIdentity()->getID();
        //$avatar->user_id = '52e219bd-7103-4550-adf0-ef8002cb5def';
        $old_avatar = $this->getAvatarByUserId((string)$avatar->user_id);
        $avatar->name = $name . '.' . $this->file->extension;
        $avatar->created_time = $this->timestamp;

        $avatar->load($createAvatar->getAttributes(), '');

        if ($this->upload($name) && $this->avatarRepository->save($avatar)) {
            if ($old_avatar) {
                $old_avatar->delete();
            }
            return true;
        }

        $createAvatar->addErrors($avatar->getErrors());
        \Yii::error('', __METHOD__);

        return false;
    }

    /**
     * @param Avatar $avatar
     *
     * @return string
     *
     * @throws InvalidConfigException
     */
    public function getAvatarUrl(Avatar $avatar)
    {
        $date = Yii::$app->formatter->asDate($avatar->created_time, 'php:Y/m/d');
        return '/uploads/' . $date . '/' . $avatar->name;
    }

    /**
     * @return bool
     *
     * @throws Exception
     */
    public function upload($name)
    {
        $path = $this->getAvatarPath($this->timestamp);
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
    public function getAvatarPath($timestamp)
    {
        $date = Yii::$app->formatter->asDate($timestamp, 'php:Y/m/d');
        return Yii::getAlias('@frontend') . '/web/uploads/' . $date . '/';
    }

    /**
     * @param $id
     *
     * @return bool
     *
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteAvatarByUserId($id): bool
    {
        $model = $this->getAvatarByUserId($id);
        if (!empty($model)) {
            $model->delete();

            return true;
        }

        return false;
    }
}
