<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\Sms\Logs;

use Iterator;
use JsonSerializable;
use Hollow3464\SmsApiHelper\Status;
use Hollow3464\SmsApiHelper\Error;
use Hollow3464\SmsApiHelper\Sms\Price;
use Exception;

/** @implements Iterator<int, SentSmsLog> */
final class SentSmsLogsIterator implements Iterator, JsonSerializable
{
    private int $current_index = 0;
    private array $details = [];

    public function __serialize(): array
    {
        return $this->jsonSerialize();
    }

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
                        $d['error']['action'] ?? '',
                    );
                }

                return new SentSmsLog(
                    $d['bulkId'],
                    $d['messageId'],
                    $d['to'],
                    $d['from'],
                    $d['text'],
                    $d['sentAt'],
                    $d['doneAt'],
                    $d['smsCount'],
                    $d['mmcmnc'],
                    $d['callbackData'],
                    new Price($d['price']['pricePerMessage'], $d['price']['currency']),
                    new Status(
                        (int) $d['status']['groupId'],
                        $d['status']['groupName'],
                        (int) $d['status']['id'],
                        $d['status']['name'],
                        $d['status']['description'],
                        $d['status']['action'] ?? '',
                    ),
                    $error,
                );
            },
            $data,
        ));
    }

    /**
     * @throws Exception
     */
    public function current(): SentSmsLog
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

    public function setDetails(array $data): static
    {
        $this->details = $data;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return json_decode(json_encode($this->details), true);
    }
}
