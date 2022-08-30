<?php

declare(strict_types=1);

use JsonSerializable;
use Leverage\Encoder\JsonTrait;
use PHPUnit\Framework\TestCase;

class JsonTraitTest extends TestCase
{
    use JsonTrait;

    public function testDecode(): void
    {
        $data = [
            'key' => 'val',
        ];

        /** @var string */
        $json = json_encode($data);

        self::assertSame($data, $this->decode($json));
    }

    public function testDecodeFalse(): void
    {
        /** @var string */
        $json = json_encode(false);
        self::assertFalse($this->decode($json));
    }

    public function testDecodeNull(): void
    {
        /** @var string */
        $json = json_encode(null);
        self::assertNull($this->decode($json));
    }

    public function testDecodeTrue(): void
    {
        /** @var string */
        $json = json_encode(true);
        self::assertTrue($this->decode($json));
    }

    public function testEncodeArray(): void
    {
        $data = ['a', 'b', 'c'];

        $expected = json_encode($data);
        self::assertSame($expected, $this->encode($data));
    }

    public function testEncodeAssocArray(): void
    {
        $data = [
            'key' => 'val',
        ];

        $expected = json_encode($data);
        self::assertSame($expected, $this->encode($data));
    }

    public function testEncodeJsonSerializable(): void
    {
        $data = [
            'key' => 'val',
        ];

        $serializable = self::createMock(JsonSerializable::class);
        $serializable->method('jsonSerialize')->willReturn($data);

        $expected = json_encode($data);
        self::assertSame($expected, $this->encode($serializable));
    }
}
