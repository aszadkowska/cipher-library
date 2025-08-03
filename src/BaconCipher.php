<?php
declare(strict_types=1);

namespace Cipher;

use InvalidArgumentException;

final class BaconCipher implements CipherInterface
{
    private const ENCODE = [
        'A' => 'AAAAA', 'B' => 'AAAAB', 'C' => 'AAABA', 'D' => 'AAABB', 'E' => 'AABAA',
        'F' => 'AABAB', 'G' => 'AABBA', 'H' => 'AABBB', 'I' => 'ABAAA', 'J' => 'ABAAB',
        'K' => 'ABABA', 'L' => 'ABABB', 'M' => 'ABBAA', 'N' => 'ABBAB', 'O' => 'ABBBA',
        'P' => 'ABBBB', 'Q' => 'BAAAA', 'R' => 'BAAAB', 'S' => 'BAABA', 'T' => 'BAABB',
        'U' => 'BABAA', 'V' => 'BABAB', 'W' => 'BABBA', 'X' => 'BABBB', 'Y' => 'BBAAA',
        'Z' => 'BBAAB',
    ];

    private static ?array $decode = null;

    private static function decode(): array
    {
        return self::$decode ??= array_flip(self::ENCODE);
    }

    public function encrypt(string $plain): string
    {
        $chunks = [];
        foreach (str_split(strtoupper($plain)) as $ch) {
            if (isset(self::ENCODE[$ch])) {
                $chunks[] = self::ENCODE[$ch];
            }
        }

        return implode(' ', $chunks);
    }

    public function decrypt(string $cipher): string
    {
        $out = '';
        $tokens = preg_split('/\\s+/', trim($cipher));

        foreach ($tokens as $token) {
            $token = strtoupper($token);
            $map = self::decode();
            if (!isset($map[$token])) {
                throw new InvalidArgumentException("Error: '{$token}'");
            }
            $out .= $map[$token];
        }

        return $out;
    }
}
