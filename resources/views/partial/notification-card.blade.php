@isset($message)
    <div class="toast fade show mx-auto p-2 mt-2 mb-2 bg-{{$type}}"
         role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-{{$type}} border-0">
            <i class="fa fa-bell text-white me-2"></i>
            <span class="me-auto font-weight-bold text-capitalize text-white">
                <strong>{{$type == 'danger' ? 'Error' :($type ?? 'Alert')}}</strong></span>
            <small class="text-white">{{now()->diffForHumans()}}</small>
            <button
                    onclick="closeToast(this)"
                    class="shadow-none btn-transparent btn m-0 p-0 close ml-3" aria-label="Close">
                <i class="fa fa-times text-md text-white  cursor-pointer"> </i>
            </button>

        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body text-white">
            {{$message}}
        </div>
    </div>
@endisset
