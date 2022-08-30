<?php

declare(strict_types=1);

namespace Leverage\Encoder;

use JsonException;
use JsonSerializable;

trait JsonTrait
{
    /**
     * @throws JsonException
     */
    private function decode(
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
    private function encode(
        array | JsonSerializable $data,
    ): string {
        return json_encode(
            value: $data,
            flags: JSON_THROW_ON_ERROR
        );
    }
}
