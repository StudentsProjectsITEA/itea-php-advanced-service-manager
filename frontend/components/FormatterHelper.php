<?php

declare(strict_types=1);

namespace frontend\components;

use yii\i18n\Formatter;

/**
 * Class FormatterHelper
 * @package frontend\components
 */
class FormatterHelper extends Formatter
{
    /**
     * @param $value
     * @return string|string[]|null
     */
    public function asPhone($value)
    {
        return preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{2})(\d{2})$/", "+$1($2)$3-$4-$5", $value);
    }
}
