@isset($no_space)
    <div class="d-flex border-bottom align-items-center" style="padding: 3px 0;   {!! $style ?? '' !!}">
        <span class="font-weight-bold text-dark" style="font-size: 12px; flex:1;">{{$key}}: &nbsp;</span>
        <span class="text-gray" style="font-size: 12px; flex: 1;">{!!$value??''!!}</span>
    </div>
@else
    <div class="row border-bottom pb-1 mt-1 ">
        <div class="col-xl-5  ">
            <span class="font-weight-bold text-dark fs-14" style="font-size: 14px">{{$key??''}}:</span>
        </div>
        <div class="col-xl-7 ">
            <span class="text-dark fs-12 " style="font-size: 12px">{!!$value??''!!}</span>
        </div>
    </div>
@endisset
