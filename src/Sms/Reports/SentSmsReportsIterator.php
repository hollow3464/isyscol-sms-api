<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\Sms\Reports;

use Iterator;
use JsonSerializable;

use Hollow3464\SmsApiHelper\Status;
use Hollow3464\SmsApiHelper\Error;
use Hollow3464\SmsApiHelper\Sms\Price;
use Exception;

/** @implements Iterator<int, SentSmsReport> */
final class SentSmsReportsIterator implements Iterator, JsonSerializable
{
    private int $current_index = 0;
    private array $details = [];

    public static function fromArray(array $data): static
    {
        return (new static())->setDetails(array_map(
            function ($d) {
                $error = null;

                if (isset($d['error'])) {
                    $error = new Error(
                        (int) $d['error']['groupId'],
                        $d['error']['groupName'],
                        (int) $d['error']['id'],
                        $d['error']['name'],
                        $d['error']['description'],
                        $d['error']['action'] ?? ''
                    );
                }

                return new SentSmsReport(
                    $d['bulkId'],
                    $d['messageId'],
                    $d['to'],
                    $d['from'],
                    $d['sentAt'],
                    $d['doneAt'],
                    $d['smsCount'],
                    $d['mmcMnc'],
                    $d['callbackData'],
                    new Price($d['price']['pricePerMessage'], $d['price']['currency']),
                    new Status(
                        (int) $d['status']['groupId'],
                        $d['status']['groupName'],
                        (int) $d['status']['id'],
                        $d['status']['name'],
                        $d['status']['description'],
                        $d['status']['action'] ?? ''
                    ),
                    $error
                );
            },
            $data
        ));
    }

    /**
     * @throws Exception
     */
    public function current(): SentSmsReport
    {
        if (!count($this->details)) {
            throw new Exception("There are no items", 1);
        }

        return $this->details[$this->current_index];
    }

    public function key()
    {
        return $this->current_index;
    }

    public function next(): void
    {
        $this->current_index =  $this->current_index + 1;
    }

    public function rewind(): void
    {
        $this->current_index = 0;
    }

    public function valid(): bool
    {
        return $this->current_index >= 0;
    }

    public function setDetails(array $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return json_decode(json_encode($this->details), true);
    }
}
