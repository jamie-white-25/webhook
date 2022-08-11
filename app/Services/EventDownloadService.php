<?php

namespace App\Services;

use App\Interface\EventFormatInterface;

class EventDownloadService implements EventFormatInterface
{
    public function format(array $data = []): array
    {
        return $data;
    }
}
