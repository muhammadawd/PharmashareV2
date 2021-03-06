@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.js"></script>
    {{Html::style('assets/css/iziToast.min.css')}}
    <style>
        .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
            background-color: #722ec2;
        }

        .docs-preview {
            margin-left: -1rem;
        }

        .img-preview {
            float: right;
            margin-bottom: .5rem;
            margin-left: .5rem;
            direction: ltr;
            overflow: hidden;
            margin: auto;
        }

        .img-preview > img {
            max-width: 100%;
        }

        .preview-lg {
            width: 100%;
            height: 240px;
            margin: auto;
        }

        .btn-primary.active:hover, .btn-primary:active:hover, .btn-primary:focus, .btn-primary:hover, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle, .show > .btn-primary.dropdown-toggle:focus, .show > .btn-primary.dropdown-toggle:hover {
            background-color: #463d3a;
        }
    </style>
@endsection

@section("body")

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    @include("includes.navbar")

    <div class="wrapper">
        @include("pages.offers.getFilterPointsView.templates.top_header")
        @include("pages.offers.getFilterPointsView.templates.center_content")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
    {{Html::script("https://momentjs.com/downloads/moment.js")}}
    <script>

        let start_date = '{{app('request')->get('start_date')}}';
        let end_date = '{{app('request')->get('end_date')}}';
        let date = $('#datarange').flatpickr({
            defaultDate: ['{{ app('request')->get('start_date') ? app('request')->get('start_date') : ""}}', '{{ app('request')->get('end_date') ? app('request')->get('end_date') : "" }}'],
            mode: 'range',
            dateFormat: 'Y-m-d',
            onChange: function (selectedDates, dateStr, instance) {

            }, onClose: function (selectedDates, dateStr, instance) {
                start = selectedDates[0];
                end = selectedDates[1];

                start = moment(start).format("YYYY-MM-DD");
                end = moment(end).format("YYYY-MM-DD");
                if (selectedDates[0] != undefined) {
                    start_date = start;
                }
                if (selectedDates[1] != undefined) {
                    end_date = end;
                }

            },
        });

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        function filterPage() {
            let params = '';
            let pharmacy_name = $('input[name="pharmacy_name"]').val();

            params = `?pharmacy_name=${pharmacy_name}&start_date=${start_date}&end_date=${end_date}`;
            location.href = '{{route('getFilterPointsView')}}' + params;
        }

        @if(session()->has('success'))
        globalAddNotify('{{session()->get('success')}}', 'success');
        @endif

        @if(session()->has('error'))
        globalAddNotify('{{session()->get('error')}}', 'danger');
        @endif
    </script>
@endsection