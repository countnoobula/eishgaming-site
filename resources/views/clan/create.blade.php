
@extends('layouts.default', ['title' => 'New Clan',])

@section('content')
            <div class="wrapper">
                <div class="pure-g">
                    <div class="pure-u-md-1-2 pure-u-sm-1 egn-block egn-block__pad">
                        <h1>New Clan</h1>
                        <form class="egn-form pure-form-aligned" method="POST" action="{{ action('ClanController@postCreate') }}">
                            @include ('messages')<fieldset>
                                <div class="pure-control-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" name="name" required="required" value="{{ old('name') }}">
                                </div>
                                <div class="pure-control-group">
                                    <label for="tag">Tag</label>
                                    <input id="tag" type="text" name="tag" value="{{ old('tag') }}">
                                </div>
                                <div class="pure-control-group">
                                    <label for="established">Established (YYYY-MM-DD)</label>
                                    <input id="established" type="date" name="established" required="required" value="{{ old('established', date('Y-m-d')) }}">
                                </div>
                                <div class="pure-control-group">
                                    <label for="established">Tag Position</label>
                                </div>
                                <div style="color: #FFF; margin-left: 9em;">
                                    <label for="tag_position_prepend" class="pure-radio">
                                        <input id="tag_position_prepend" type="radio" name="tag_position" value="PREPEND"{!! old('tag_position', 'PREPEND') == 'PREPEND'?' checked="checked"':'' !!}>
                                        Prepend
                                    </label>
                                    <label for="tag_position_append" class="pure-radio">
                                        <input id="tag_position_append" type="radio" name="tag_position" value="APPEND"{!! old('tag_position') == 'APPEND'?' checked="checked"':'' !!}>
                                        Append
                                    </label>
                                </div>
                                <div class="pure-control-group" style="margin: 2em;">
                                    <p>
                                        <a class="pure-button" href="{{ action('ProfileController@index') }}">Back to profile</a>
                                        <button type="submit" class="pure-button pure-button-primary">Create Clan</button>
                                    </p>
                                </div>
                            </fieldset>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
@stop