<?php
declare(strict_types=1);

use Cipher\AtBashCipher;
use PHPUnit\Framework\TestCase;

final class AtBashCipherTest extends TestCase
{
    public function testEncryptDecrypt(): void
    {
        $cipher = new AtBashCipher();
        $plain = 'Abc xyz';

        $encrypted = $cipher->encrypt($plain);
        $this->assertSame('Zyx cba', $encrypted);

        $this->assertSame($plain, $cipher->decrypt($encrypted));
    }

    public function testNonAlphabeticCharactersRemain(): void
    {
        $cipher = new AtBashCipher();
        $this->assertSame('123 !', $cipher->encrypt('123 !'));
    }

    /** @dataProvider samples */
    public function testEncryptDecryptEdgeCases(string $plain): void
    {
        $cipher = new AtBashCipher();
        self::assertSame($plain, $cipher->decrypt($cipher->encrypt($plain)));
    }

    public static function samples(): array
    {
        return [
            'all' => ['abcdefghijklmnopqrstuvwxyz'],
            'empty' => [''],
            'spaces' => ['   '],
        ];
    }
}
