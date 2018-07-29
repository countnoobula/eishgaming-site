<?php

namespace App\Interfaces;

use Carbon\Carbon;
use Traversable;

interface Profile extends Banner
{
    public function getEmail();
    public function getBirthday();
    public function getName();
    public function getPhoneNumber();
    public function getStatusLabel();
    public function getClans();
    public function getGames();
}
