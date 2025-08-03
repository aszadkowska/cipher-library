<?php

namespace Cipher;

interface CipherInterface
{
    public function encrypt(string $plain): string;
    public function decrypt(string $cipher): string;
}