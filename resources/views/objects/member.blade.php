                            <a href="{{ action('ProfileController@user', compact('member')) }}">
                                <div class="egn-member">
                                    <div class="egn-wrapper">
                                        <div class="egn-title">{{ $profile->getMemberDisplayName($member) }}</div>
                                        <div class="egn-role">{{ ucfirst($member->pivot->role) }}</div>
                                    </div>
                                </div>
                            </a>
