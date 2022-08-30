<?php

declare(strict_types=1);

namespace Leverage\Encoder;

class JsonEncoder
{
    use JsonTrait {
        decode as public;
        encode as public;
    }
}
