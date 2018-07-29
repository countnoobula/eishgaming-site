<?php

namespace App\Interfaces;

use Carbon\Carbon;
use Traversable;
use App\Models\User;

interface Clan extends Banner
{
    public function getEstablishedDate();
    public function getMembers();
    public function getMemberDisplayName(User $u);
}
