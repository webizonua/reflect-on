<?php

namespace App\Support;

class FileName
{
    public static function sanitize(string $name): string
    {
        // clean extension
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        // clean base name
        $base = strtolower(pathinfo($name, PATHINFO_FILENAME));

        // convert umlauts + accented chars
        $base = iconv('UTF-8', 'ASCII//TRANSLIT', $base);

        // remove anything not allowed
        $base = preg_replace('/[^a-z0-9]+/i', '-', $base);

        // remove duplicate dashes
        $base = preg_replace('/-+/', '-', $base);

        // trim dashes
        $base = trim($base, '-');

        // short unique suffix
        $suffix = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 5);

        return "{$base}-{$suffix}.{$ext}";
    }
}
