<?php

declare(strict_types=1);

namespace BBSLab\NovaFileManager\Rules;

use BBSLab\NovaFileManager\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Rule;

class MissingInFilesystem implements Rule
{
    public function __construct(
        public BaseRequest $request,
    ) {}

    public function passes($attribute, $value): bool
    {
        return $this->request
            ->manager()
            ->filesystem()
            ->missing($value);
    }

    public function message(): string
    {
        return __('validation.exists');
    }
}
