
@foreach ($errors->getBag('default')->all() as $error)
<div class="pure-form-message">{{ $error }}</div>
@endforeach
