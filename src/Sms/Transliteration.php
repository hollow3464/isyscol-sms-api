<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\Sms;

enum Transliteration: string
{
    case TURKISH = "TURKISH";
    case GREEK = "GREEK";
    case CYRILLIC = "CYRILLIC";
    case CENTRAL_EUROPEAN = "CENTRAL_EUROPEAN";
    case NON_UNICODE = "NON_UNICODE";
}
