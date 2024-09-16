<?php

namespace App\Contracts;

use App\Dtos\ShortUrlDto;
use App\Http\Requests\ShortUrlCreationRequest;

interface ShortUrlDtoFactoryInterface
{
    public function getShortUrlDto(ShortUrlCreationRequest $request): ShortUrlDto;
}
