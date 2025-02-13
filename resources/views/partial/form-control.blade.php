<div class="form-group {{ $errors->has($name) ? 'has-error error' : '' }} {!! $wrapper ?? '' !!}">
    <label for="{{$name ?? ''}}" class="form-label">{!! $label ?? '' !!}</label>
    @isset($group)
        <div class="input-group ">
            @if(!isset($groupEnd))
                <span class="input-group-text" id="{{$name??''}}GroupPrepend">{!! $group ??'' !!}</span>
            @endif
            <input class="form-control  {{$class ?? ''}}" name="{{$name ?? ''}}"
                   aria-describedby="{{$name??''}}GroupPrepend" id="{{$name ?? ''}}"
                   type="{{$type ?? 'text'}}"
                   value="{{old($name, $value ?? '')}}"
                   placeholder="{{$placeholder ?? ''}}" {!! $props ?? '' !!}>
            @isset($groupEnd)
                <span class="input-group-text"
                      id="{{$name??''}}GroupPrepend">{!! $group ??'' !!}</span>@endisset
            @include('partial.error-message')
        </div>
    @else
        <input class="form-control {{$class ?? ''}}" name="{{$name ?? ''}}" id="{{$name ?? ''}}"
               type="{{$type ?? ''}}"
               value="{{old($name, $value ?? '')}}"
               placeholder="{{$placeholder ?? ''}}" {!! $props ?? '' !!}>
        @include('partial.error-message')
    @endisset
</div>

