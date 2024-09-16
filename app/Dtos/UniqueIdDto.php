<?php

namespace App\Dtos;

class UniqueIdDto
{
    private $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param  mixed  $value
     */
    public function setValue($value): UniqueIdDto
    {
        $this->value = $value;

        return $this;
    }
}
