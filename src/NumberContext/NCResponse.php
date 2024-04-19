<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\NumberContext;

final class NCResponse
{
    public function __construct(
        public string $bulkId,
        public NCReponseDetailsIterator $results,
    ) {}
}
