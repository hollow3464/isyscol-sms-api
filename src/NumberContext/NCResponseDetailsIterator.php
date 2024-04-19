<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\NumberContext;

use Iterator;
use JsonSerializable;

use Hollow3464\SmsApiHelper\Status;
use Hollow3464\SmsApiHelper\Error;
use Exception;

/** @implements Iterator<int, NCResponseDetails> */
final class NCReponseDetailsIterator implements Iterator, JsonSerializable
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
            fn($d) => new NCResponseDetails(
                $d['to'],
                $d['mccMnc'],
                $d['imsi'],
                new Network(
                    $d['originalNetwork']['networkName'],
                    $d['originalNetwork']['networkPrefix'],
                    $d['originalNetwork']['countryName'],
                    $d['originalNetwork']['countryPrefix'],
                ),
                $d['ported'],
                new Network(
                    $d['originalNetwork']['networkName'],
                    $d['originalNetwork']['networkPrefix'],
                    $d['originalNetwork']['countryName'],
                    $d['originalNetwork']['countryPrefix'],
                ),
                $d['roaming'],
                new Network(
                    $d['originalNetwork']['networkName'],
                    $d['originalNetwork']['networkPrefix'],
                    $d['originalNetwork']['countryName'],
                    $d['originalNetwork']['countryPrefix'],
                ),
                $d['servingMSC'],
                new Status(
                    (int) $d['status']['groupId'],
                    $d['status']['groupName'],
                    (int) $d['status']['id'],
                    $d['status']['name'],
                    $d['status']['description'],
                    $d['status']['action'] ?? ''
                ),
                new Error(
                    (int) $d['status']['groupId'],
                    $d['status']['groupName'],
                    (int) $d['status']['id'],
                    $d['status']['name'],
                    $d['status']['description'],
                    $d['status']['action'] ?? ''
                )
            ),
            $data
        ));
    }

    /**
     * @throws Exception
     */
    public function current(): NCResponseDetails
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
