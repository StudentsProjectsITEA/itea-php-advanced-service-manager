<?php

declare(strict_types=1);

namespace frontend\models;

use yii\base\Model;

/**
 * Class SearchForm
 * @package frontend\models
 */
class SearchForm extends Model
{
    /**
     * @var string
     */
    public $search;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['search'], 'required'],
            [['search'], 'string', 'max' => 255],
        ];
    }
}
