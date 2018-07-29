<?php

namespace App\Providers;

use App\Http\Controllers\Thirdparty\SteamActivities;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{   
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\Steam\SteamExtendSocialite@handle',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen('auth.login', function ($user, $remember) {
            if ($user instanceof User && !is_null($user->steam_community_id)) {
                $activties = $user->gameActivities()
                    ->whereIn('game', [ 'DOTA', 'CSGO'])
                    ->where('updated_at', '>=', Carbon::now()->subWeek())
                    ->count();
                if (!$activties) {
                    SteamActivities::updateUserGames($user);
                }
            }
        });
    }
}
