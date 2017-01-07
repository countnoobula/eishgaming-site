
@foreach($errors->get('success') AS $success)
    <div class="alert alert--success">
        <div class="alert__title">Success</div>
        <p class="alert__message">
            {!! $success !!}
        </p>
    </div>
@endforeach

@foreach($errors->get('error') AS $error)
    <div class="alert alert--error">
        <p class="alert__message">
            {!! $error !!}
        </p>
    </div>
@endforeach

@foreach($errors->get('warning') AS $warning)
    <div class="alert alert--warning">
        <p>
            {!! $warning !!}
        </p>
    </div>
@endforeach
