<?php

namespace App\Interfaces;

interface Profile
{
    public function getDisplayName(): string;
    public function getTag(): string;
}
