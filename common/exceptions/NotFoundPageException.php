<?php

declare(strict_types=1);

namespace common\exceptions;

use DomainException;

class NotFoundPageException extends DomainException
{
    protected $message = 'Категория не найдена.';
}
