<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\Avatar;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class AvatarRepository
 *
 * @package common\repositories
 */
class AvatarRepository
{
    /**
     * Return avatar by id
     *
     * @param string $id
     *
     * @return Avatar
     */
    public function findAvatar(string $id): Avatar
    {
        return Avatar::findOne($id);
    }

    /**
     * Return all avatars
     *
     * @return ActiveQuery
     */
    public function getAvatars()
    {
        return Avatar::find();
    }

    /**
     * @param string $user_id
     *
     * @return ActiveRecord
     */
    public function findUserAvatar(string $user_id)
    {
        return Avatar::find()->where(['user_id' => $user_id])->one();
    }

    /**
     * Save avatar
     *
     * @param Avatar $avatar
     *
     * @return bool
     */
    public function save(Avatar $avatar)
    {
        if ( ! $avatar->save()) {
            \Yii::error(
                'Error has been occurred while saving Avatar model. Errors = ' . json_encode( $avatar->getErrors()) . '. Attributes = ' . json_encode($avatar->getAttributes()),
                __METHOD__
            );

            return false;
        }

        return true;
    }

}