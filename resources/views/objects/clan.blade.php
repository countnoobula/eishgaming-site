<a href="{{ action('ClanController@getView', compact('clan')) }}">
    <div class="egn-clan">
        <div class="egn-avatar">
            <img src="{{ url('/images/peak-100x100.png') }}" alt="clan_avatar">
        </div>
        <div class="egn-wrapper">
            <div class="egn-title">{{ $clan->name }}</div>
            <div class="egn-name">{{ $clan->generateDisplayName($profile) }}</div>
            <div class="egn-role">{{ ucfirst($clan->pivot->role) }}</div>
        </div>
    </div>
</a>
