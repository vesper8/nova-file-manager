<?php

declare(strict_types=1);

namespace Oneduo\NovaFileManager\Events;

use Illuminate\Foundation\Events\Dispatchable;

class FileUnzipped
{
    use Dispatchable;

    public function __construct(public string $disk, public string $path)
    {
    }
}
