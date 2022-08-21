<?php

declare(strict_types=1);

namespace Architech\Encoder;

use JsonException;
use JsonSerializable;

class JsonEncoder
{
    /**
     * @throws JsonException
     */
    public function decode(
        string $json,
    ): mixed {
        return json_decode(
            json: $json,
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );
    }

    /**
     * @throws JsonException
     */
    public function encode(
        array | JsonSerializable $data,
    ): string {
        return json_encode(
            value: $data,
            flags: JSON_THROW_ON_ERROR
        );
    }
}
