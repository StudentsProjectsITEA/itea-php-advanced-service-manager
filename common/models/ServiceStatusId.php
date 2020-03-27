<?php

namespace common\models;

/**
 * This class is for service constants only
 */
class ServiceStatusId
{
    public const STATUS_NOT_ACTIVE = 9;
    public const STATUS_ACTIVE = 10;
    public const STATUS_DELETE = 0;

    public const STATUS_NOT_ACTIVE_LABEL = 'Not active';
    public const STATUS_ACTIVE_LABEL = 'Active';
    public const STATUS_DELETE_LABEL = 'Deleted';

    public const STATUS_IDS_MAP = [
        self::STATUS_NOT_ACTIVE => self::STATUS_NOT_ACTIVE_LABEL,
        self::STATUS_ACTIVE => self::STATUS_ACTIVE_LABEL,
        self::STATUS_DELETE => self::STATUS_DELETE_LABEL,
    ];
}
