@extends('layouts.banner', ['title' => $profile->getDisplayName(),])

@section('inner_content')
            <div class="wrapper">
                <div class="pure-g">
                    <div class="pure-u-lg-1-2 pure-u-1-1 egn-block egn-block__pad">
                        <h3>Members</h3>
                        <div class="egn-members">
@foreach ($profile->getMembers() as $member)
                            @include ('objects.member', [$member, $profile])
@endforeach
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
