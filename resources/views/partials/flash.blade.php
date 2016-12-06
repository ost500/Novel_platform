@if(Session::has('flash_message'))
    {{-- important, success, warning, danger and info --}}
    {{-- <div class="alert  alert-{{ Session('flash_message_level') }}">
         {{Session('flash_message')}}
     </div>--}}
    {{--<div id="flash_message">--}}
        {{--<input type="hidden" id="flash_msg" value="{{Session('flash_message')}}">--}}
    {{--</div>--}}
    <script>
        $(function() {

//            var flash_msg = document.querySelector('#flash_msg').getAttribute('value');

            $.niftyNoty({
                type: 'purple',
                icon: 'fa fa-check',
                message: '{{Session('flash_message')}}',
                container: 'page',
                timer: 4000
            });
        });

    </script>

@endif