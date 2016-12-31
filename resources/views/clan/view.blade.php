@extends('layouts.banner')

@section('title')
{{ $profile->getDisplayName() }}
@stop

@section('inner_content')
<div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-lg-1-2 pure-u-1-1 egn-block egn-block__pad">
            <h3>Members</h3>
            
            <div class="egn-members">
                <ul class="egn-list">
                @foreach ($profile->getMembers() as $member)
                    <li>
                        <div class="egn-title">{{ $profile->getMemberDisplayName($member) }}</div>
                        <div class="egn-role">{{ ucfirst($member->pivot->role) }}</div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
        
        <div class="pure-u-lg-1-2 pure-u-1-1 egn-block egn-block__pad">
            <h3>Clan</h3>
            
            <div>
                <table class="egn-table">
                    <tbody>
                        <tr>
                            <td>Established</td>
                            <td>{{ $profile->getEstablishedDate()->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
