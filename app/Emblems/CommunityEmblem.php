<?php

namespace App\Emblems;
use Carbon\Carbon;

/**
 *
 * @author rory
 */
interface CommunityEmblem
{
    public function getLevel(): int;
    public function getLabel(): string;
    public function awarded(): Carbon;
}
