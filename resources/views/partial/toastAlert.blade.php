<script type="text/javascript" src="{{asset('js/scripts/extensions/ext-component-toastr.min.js')}}"></script>
<script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
<script>

    document.addEventListener("DOMContentLoaded", function () {

        const option = {
            closeButton: true, tapToDismiss: false, timeOut: 7000, showMethod: 'slideDown',
            hideMethod: 'slideUp',
        };
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr['error']('👋 {{$error}}', option);
        @endforeach
            @endif
            @if (session('status'))
            toastr['success']('👋 &nbsp; {{session('status')}}', option);
        @endif
            @if (session('alert'))
            toastr['info']('👋 {{session('alert')}}', option);
        @endif
            @if (session('info'))
            toastr['info']('👋 {{session('info')}}', option);
        @endif
            @if (session('success'))
            toastr['success']('👋 {{session('success')}}', option);
        @endif
            @if (session('warning'))
            toastr['warning']('👋 {{session('error')}}', option);
        @endif
            @if (session('error'))
            toastr['error']('👋 {{session('error')}}', option);
        @endif
    });
</script>
