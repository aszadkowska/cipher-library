<?php
declare(strict_types=1);

use Cipher\CaesarCipher;
use PHPUnit\Framework\TestCase;

final class CaesarCipherTest extends TestCase
{
    public function testEncryptDecrypt(): void
    {
        $cipher = new CaesarCipher(3);
        $plain  = 'Abc xyz';

        $encrypted = $cipher->encrypt($plain);
        $this->assertSame('Def abc', $encrypted);

        $decrypted = $cipher->decrypt($encrypted);
        $this->assertSame($plain, $decrypted);
    }

    public function testRotationWrapsAroundAlphabet(): void
    {
        $cipher = new CaesarCipher(25);
        $this->assertSame('Z', $cipher->encrypt('A'));
        $this->assertSame('A', $cipher->decrypt('Z'));
    }
}
