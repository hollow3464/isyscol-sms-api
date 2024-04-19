<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\ResponseCodes\StatusCodes;

enum StatusCodeGroup: int
{
    case PENDING = 1;
    case UNDELIVERABLE = 2;
    case DELIVERED = 3;
    case EXPIRED = 4;
    case REJECTED = 5;
}
