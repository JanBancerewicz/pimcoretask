<?php

namespace Pimcore\Model\DataObject\SelectOptions;

enum EventStatus: string implements \Pimcore\Model\DataObject\SelectOptionsInterface
{
    use \Pimcore\Model\DataObject\SelectOptions\Traits\EnumGetValuesTrait;
    use \Pimcore\Model\DataObject\SelectOptions\Traits\EnumTryFromNullableTrait;

    case Scheduled = 'Scheduled';
    case On_Hold = 'On-Hold';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::Scheduled => 'Scheduled',
            self::On_Hold => 'On-Hold',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }
}
