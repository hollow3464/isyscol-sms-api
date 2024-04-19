<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\Sms\Messages;

use JsonSerializable;
use Exception;

final class AdvancedSmsMessage implements JsonSerializable
{
    public function __construct(
        public readonly array $to,
        public readonly ?string $text = null,
        public readonly ?string $from = null,
        public readonly ?string $bulkId = null,
        public readonly ?string $messageId = null,
        public readonly bool $flash = false,
        public readonly Transliteration $transliteration = Transliteration::CENTRAL_EUROPEAN,
    ) {
        if (!count($this->to)) {
            throw new Exception("There must be at least one receipt");
        }
    }

    public function jsonSerialize(): array
    {
        $data = [
            'to' => $this->to,
            'flash' => $this->flash,
            'transliteration' => $this->transliteration->value
        ];

        if ($this->text) {
            $data['text'] = $this->text;
        }

        if ($this->from) {
            $data['from'] = $this->from;
        }

        if ($this->bulkId) {
            $data['bulkId'] = $this->bulkId;
        }

        if ($this->messageId) {
            $data['messageId'] = $this->messageId;
        }

        return $data;
    }
}
