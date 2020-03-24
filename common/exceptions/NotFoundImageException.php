<?php

declare(strict_types=1);

namespace common\exceptions;

use DomainException;

/**
 * Class NotFoundImageException
 *
 * @package common\exceptions
 */
class NotFoundImageException extends DomainException
{
    protected $message = 'Изображение не найдено.';
}
