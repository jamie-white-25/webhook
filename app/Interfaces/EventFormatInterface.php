<?php

namespace App\Interface;

interface EventFormatInterface
{
    public function format(array $data): array;
}
