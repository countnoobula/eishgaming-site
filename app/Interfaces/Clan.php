<?php

namespace App\Interfaces;

use Carbon\Carbon;
use Traversable;
use App\Models\User;

interface Clan extends Banner
{
    public function getEstablishedDate(): Carbon;
    public function getMembers(): Traversable;
    public function getMemberDisplayName(User $u): string;
}
