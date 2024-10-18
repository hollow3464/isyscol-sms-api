<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper;

final class Status
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $groupId = null,
        public readonly ?string $groupName = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $action = null,
    ) {}
}
