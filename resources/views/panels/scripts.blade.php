<script src="{{ asset( mix('js/manifest.js') ) }}"></script>
<script src="{{ asset( mix('js/vendor.js') ) }}"></script>
<script src="{{ asset( mix('js/app.js') ) }}"></script>

@stack('page-scripts')

{!! Anhskohbo\NoCaptcha\Facades\NoCaptcha::renderJs() !!}

@if(Session::has('flash_success_message'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ Session::get('flash_success_message') }}",
            icon: "success",
            showCancelButton: !1,
            confirmButtonText: 'Agree'
        })
    </script>
@endif
@if(Session::has('flash_error_message'))
    <script>
        Swal.fire({
            title: 'Something wrong!',
            text: "{{ Session::get('flash_error_message') }}",
            icon: "error",
            showCancelButton: !1,
            confirmButtonText: 'Agree'
        })
    </script>
@endif
