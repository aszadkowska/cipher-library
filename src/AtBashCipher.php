<?php
declare(strict_types=1);

namespace Cipher;

final class AtBashCipher implements CipherInterface
{
    private const LOWER = 'abcdefghijklmnopqrstuvwxyz';
    private const UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /** @var array{from:string,to:string}|null */
    private static ?array $map = null;

    private static function getMap(): array
    {
        if (self::$map === null) {
            self::$map = [
                'from' => self::LOWER . self::UPPER,
                'to' => strrev(self::LOWER) . strrev(self::UPPER),
            ];
        }
        return self::$map;
    }

    public function encrypt(string $plain): string
    {
        return $this->mirror($plain);
    }

    public function decrypt(string $cipher): string
    {
        return $this->mirror($cipher);
    }

    private function mirror(string $text): string
    {
        $map = self::getMap();
        return strtr($text, $map['from'], $map['to']);
    }
}
