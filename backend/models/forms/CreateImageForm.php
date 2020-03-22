<?php

declare(strict_types=1);

namespace backend\models\forms;

use yii\base\Model;

/**
 * Class CreateImageForm
 *
 * @package backend\models\forms
 */
class CreateImageForm extends Model
{
    public $id;
    public $name;
    public $service_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id'], 'string'],
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }
}
