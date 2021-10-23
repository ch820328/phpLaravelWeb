<?php

namespace App\Contracts\Entities;

interface BaseEntity
{
    /**
     * @return array
     */
    public function toArray();
}
