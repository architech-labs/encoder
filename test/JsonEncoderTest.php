<?php

declare(strict_types=1);

use Architech\Encoder\JsonEncoder;
use JsonSerializable;
use PHPUnit\Framework\TestCase;

class JsonEncoderTest extends TestCase
{
    private JsonEncoder $json;

    public function setUp(): void
    {
        $this->json = new JsonEncoder;
    }

    public function testDecode(): void
    {
        $data = [
            'key' => 'val',
        ];

        /** @var string */
        $json = json_encode($data);

        self::assertSame($data, $this->json->decode($json));
    }

    public function testDecodeFalse(): void
    {
        /** @var string */
        $json = json_encode(false);
        self::assertFalse($this->json->decode($json));
    }

    public function testDecodeNull(): void
    {
        /** @var string */
        $json = json_encode(null);
        self::assertNull($this->json->decode($json));
    }

    public function testDecodeTrue(): void
    {
        /** @var string */
        $json = json_encode(true);
        self::assertTrue($this->json->decode($json));
    }

    public function testEncodeArray(): void
    {
        $data = ['a', 'b', 'c'];

        $expected = json_encode($data);
        self::assertSame($expected, $this->json->encode($data));
    }

    public function testEncodeAssocArray(): void
    {
        $data = [
            'key' => 'val',
        ];

        $expected = json_encode($data);
        self::assertSame($expected, $this->json->encode($data));
    }

    public function testEncodeJsonSerializable(): void
    {
        $data = [
            'key' => 'val',
        ];

        $serializable = self::createMock(JsonSerializable::class);
        $serializable->method('jsonSerialize')->willReturn($data);

        $expected = json_encode($data);
        self::assertSame($expected, $this->json->encode($serializable));
    }
}
