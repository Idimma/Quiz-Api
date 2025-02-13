<div class="form-group mb-1 {{ $errors->has($name) ? 'has-error error' : '' }} {!! $wrapper ?? '' !!}">
    <label for="{{$name ?? ''}}" class="form-label">{!! $label ?? '' !!}</label>
    <select name="{{$name ?? ''}}" id="{{$name ?? ''}}" class="form-select select2 {{$class ?? ''}}"{!! $props ?? ''!!}>
        @foreach(($select_data ?? []) as $s)
            <option @if("$s" === "".old($name, $value ?? '')) selected @endif value="{{$s}}">{{$s}}</option>
        @endforeach
    </select>
    @include('partial.error-message')
</div>
