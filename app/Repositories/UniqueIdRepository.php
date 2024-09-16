<?php

namespace App\Repositories;

use App\Contracts\Repositories\UniqueIdRepositoryInterface;
use App\Dtos\UniqueIdDto;
use App\Models\UniqueId;

class UniqueIdRepository implements UniqueIdRepositoryInterface
{
    public function __construct(private UniqueId $uniqueId)
    {}

    public function create(UniqueIdDto $uniqueIdDto): UniqueId
    {
        return $this->uniqueId->create([
            'value' => $uniqueIdDto->getValue()
        ]);
    }

    public function findByValue($value): ?UniqueId
    {
        return $this->uniqueId->where('value', $value)->first();
    }


}
