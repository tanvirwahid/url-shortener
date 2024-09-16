<?php

namespace App\Contracts\Repositories;

use App\Dtos\UniqueIdDto;
use App\Models\UniqueId;

interface UniqueIdRepositoryInterface
{
    public function create(UniqueIdDto $uniqueIdDto): UniqueId;

    public function findByValue($value): ?UniqueId;
}
