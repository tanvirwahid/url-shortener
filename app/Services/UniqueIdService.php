<?php

namespace App\Services;

use App\Contracts\Repositories\UniqueIdRepositoryInterface;
use App\Dtos\UniqueIdDto;

class UniqueIdService
{
    const MAX_VALUE_TO_GENERATE = 2 ** 62;

    public function __construct(
        private UniqueIdDto $uniqueIdDto,
        private UniqueIdRepositoryInterface $uniqueIdRepository
    ) {}

    public function create(): int
    {
        return $this->uniqueIdRepository
            ->create(
                $this->uniqueIdDto->setValue($this->getUniqueId())
            )->value;
    }

    private function getUniqueId(): int
    {
        $generatedValue = $this->generateUniqueId();

        while (1) {
            $savedDataWithGeneratedValue = $this->uniqueIdRepository->findByValue($generatedValue);
            if ($savedDataWithGeneratedValue == null) {
                break;
            }
            $generatedValue = $this->generateUniqueId();
        }

        return $generatedValue;
    }

    private function generateUniqueId(): int
    {
        return rand(1, self::MAX_VALUE_TO_GENERATE);
    }
}
