<div id="notifier" class="position-fixed  d-print-none  z-index-2 " style="right: 0; bottom: 0;">
    @include('partial.notification-card', ['type' => 'success', 'message' => session('success')])
    @include('partial.notification-card', ['type' => 'info', 'message' => session('info')])
    @include('partial.notification-card', ['type' => 'danger', 'message' => session('error')])
    @include('partial.notification-card', ['type' => 'warning', 'message' => session('warning')])
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @include('partial.notification-card', ['type' => 'danger', 'message' => $error])
        @endforeach
    @endif
</div>
