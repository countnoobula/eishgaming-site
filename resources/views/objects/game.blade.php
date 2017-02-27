                            <div class="egn-game">
                                <div class="egn-icon">
                                    <div class="egn-helper"></div>
                                    <img src="{{ url('/images/'.strtolower($game->game).'.png') }}" alt="{{ $game->game }}">
                                </div>
                                <div class="egn-wrapper">
                                    <div class="egn-stat">{{ k($game->rounds_played) }} games / {{ k($game->minutes_played > 0?($game->minutes_played / 60):0) }} hrs</div>
                                </div>
                            </div>
