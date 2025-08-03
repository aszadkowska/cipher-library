<?php
declare(strict_types=1);

namespace Cipher;

final class CaesarCipher implements CipherInterface
{
    private const ABC = 'abcdefghijklmnopqrstuvwxyz';
    private const ABC_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private int $shift;

    /** @var array<int,array{from:string,to:string}> */
    private static array $table = [];

    public function __construct(int $shift)
    {
        $this->shift = ($shift % 26 + 26) % 26;
    }

    public function encrypt(string $plain): string
    {
        return $this->translate($plain, $this->shift);
    }

    public function decrypt(string $cipher): string
    {
        return $this->translate($cipher, 26 - $this->shift);
    }

    private function translate(string $text, int $shift): string
    {
        if (!isset(self::$table[$shift])) {
            $rotLower = substr(self::ABC, $shift) . substr(self::ABC, 0, $shift);
            $rotUpper = substr(self::ABC_UPPER, $shift) . substr(self::ABC_UPPER, 0, $shift);

            self::$table[$shift] = [
                'from' => self::ABC . self::ABC_UPPER,
                'to'   => $rotLower . $rotUpper,
            ];
        }

        return strtr($text, self::$table[$shift]['from'], self::$table[$shift]['to']);
    }
}
