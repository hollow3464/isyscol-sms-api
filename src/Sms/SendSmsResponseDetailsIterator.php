<?php

namespace Hollow3464\SmsApiHelper\Sms;

use Iterator;
use JsonSerializable;

use Hollow3464\SmsApiHelper\Status;

/** @implements Iterator<int, SendSmsResponseDetail> */
final class SendSmsResponseDetailsIterator implements Iterator, JsonSerializable
{
    private int $current_index = 0;
    private array $details = [];

    /**
     * @throws \Exception
     */
    public function current(): SendSmsResponseDetail
    {
        if (!count($this->details)) {
            throw new \Exception("There are no items", 1);
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

    public function __serialize(): array
    {
        return $this->jsonSerialize();
    }

    public function __unserialize(array $data): void
    {
        $this->details = array_map(
            fn ($d) => new SendSmsResponseDetail(
                $d['to'],
                new Status(
                    (int) $d['status']['groupId'],
                    $d['status']['groupName'],
                    (int) $d['status']['id'],
                    $d['status']['name'],
                    $d['status']['description'],
                    $d['status']['action'] ?? ''
                ),
                (int) $d['smsCount'],
                $d['messageId']
            ),
            $data
        );
    }

    public function jsonSerialize(): array
    {
        return json_decode(json_encode($this->details), true);
    }
}
