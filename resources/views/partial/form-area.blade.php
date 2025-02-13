<div class="form-group {{ $errors->has($name) ? 'error' : '' }} {!! $wrapper ?? '' !!}">
    <label for="{{$name ?? ''}}" class="control-label">{{$label ?? ''}}</label>
    <textarea class="form-control" name="{{$name ?? ''}}"  id="{{$name ?? ''}}" type="{{$type ?? 'text'}}"
              placeholder="{{$placeholder ?? ''}}" {!! $props ?? '' !!}>{{old($name, $value ?? '')}}</textarea>
    @include('partial.error-message')
</div>

