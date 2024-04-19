<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper;

final class Error
{
    public function __construct(
        public readonly int $groupId,
        public readonly string $groupName,
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly bool $permanent,
    ) {}
}
