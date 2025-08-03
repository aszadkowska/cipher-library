<?php
declare(strict_types=1);

use Cipher\BaconCipher;
use PHPUnit\Framework\TestCase;

final class BaconCipherTest extends TestCase
{
    public function testEncryptDecrypt(): void
    {
        $cipher = new BaconCipher();
        $expected = 'AAAAA AAAAB AAABA';

        $this->assertSame($expected, $cipher->encrypt('ABC'));
        $this->assertSame('ABC', $cipher->decrypt($expected));
    }

    public function testIgnoresUnsupportedCharacters(): void
    {
        $cipher = new BaconCipher();
        $this->assertSame('ABAAA', $cipher->encrypt('I9'));
    }

    public function testDecryptThrowsOnInvalidToken(): void
    {
        $cipher = new BaconCipher();
        $this->expectException(InvalidArgumentException::class);
        $cipher->decrypt('XXXXX');
    }
}
