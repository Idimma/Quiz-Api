<div class="form-group mb-1 {{ $errors->has($name) ? 'has-error error' : '' }} {!! $wrapper ?? '' !!}">
    <div class="row align-items-center">
        <div class="col-md-3 {{$step1 ?? ''}}">
            <label for="{{$name ?? ''}}" class="form-label font-weight-bold font-medium-1">{{$label ?? ''}}</label>
        </div>
        <div class="col-md-9 {{$step2 ?? ''}}">
            <input class="form-control {{$class ?? ''}}" name="{{$name ?? ''}}" type="{{$type ?? 'text'}}"
                   value="{{old($name, $value ?? '')}}"
                   placeholder="{{$placeholder ?? ''}}" {!! $props ?? '' !!}>
            @include('partial.error-message')
        </div>
    </div>
</div>

