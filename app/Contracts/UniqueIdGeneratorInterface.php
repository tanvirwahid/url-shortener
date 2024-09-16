<?php

namespace App\Contracts;

interface UniqueIdGeneratorInterface
{
    public function createUniqueId(): int;
}
