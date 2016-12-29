<?php

namespace App\Interfaces;

use Carbon\Carbon;

interface Profile
{
    public function getDisplayName(): string;
    public function getTag(): string;
    public function getEmail(): string;
    public function getBirthday(): Carbon;
    public function getName(): string;
    public function getPhoneNumber(): string;
    public function getStatusLabel(): string;
}
