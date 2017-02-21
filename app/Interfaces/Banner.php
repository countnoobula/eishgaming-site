<?php

namespace App\Interfaces;

interface Banner
{
    public function getDisplayName(): string;
    public function inviteUrl(): string;
}
