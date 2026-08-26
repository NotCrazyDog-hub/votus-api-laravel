<?php

namespace App\Services\Concerns;

trait NormalizesProfessionNames
{
    protected function normalizeProfessionName(string $name): string
    {
        $name = preg_replace('/\(a\)/i', '', $name);
        $name = trim($name);
        $name = iconv('UTF-8', 'ASCII//TRANSLIT', $name) ?: $name;

        return mb_strtolower($name);
    }
}