<?php

namespace Hollow3464\SmsApiHelper\NumberContext;
use Hollow3464\SmsApiHelper\NumberContext\NCReponseDetailsIterator;

final class NCResponse {
    public function __construct(
        public string $bulkId,
        public NCReponseDetailsIterator $results, 
    ){
    }
}