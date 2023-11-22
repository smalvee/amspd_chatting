<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ===============================================-->
<!--    Document Title-->
<!-- ===============================================-->
<title>{{ config('app.name') }} | {{ __('Dashboard') }}</title>

<!-- ===============================================-->
<!--    Favicons-->
<!-- ===============================================-->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
<link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
<meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
<meta name="theme-color" content="#ffffff">
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/vendors/simplebar/simplebar.min.js') }}"></script>

<!-- ===============================================-->
<!--    Stylesheets-->
<!-- ===============================================-->
<link rel="preconnect" href="https://fonts.gstatic.com/">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
<link href="{{ asset('assets/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
<link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
<link href="{{ asset('assets/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
<link href="{{ asset('assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">

<!-- custom css start  -->
<style>
    #preview {
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      gap: 10px; /* Adjust the gap between images */
    }

    .file-preview {
      display: flex;
      align-items: center;
      margin-bottom: 5px;
    }

    .file-icon {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }

    .preview-image {
      max-width: 200px; /* Adjust the width of each image */
      max-height: 200px; /* Adjust the height of each image */
      margin-right: 5px; /* Add margin between images */
    }
  </style>

<style>
        #statusBar {
            max-width: 100%;
            height: 20px;
            background-color: #90e18b  ;
            margin-top: 2px;
        }
    </style>


   <style>
        #progressbar {
            width: 300px;
            height: 20px;
            border: 1px solid #ccc;
            position: relative;
            cursor: pointer;
        }

        #progress {
            height: 100%;
            background-color: #4CAF50;
        }

        #progressValue {
            margin-top: 10px;
        }
    </style>



  <!-- custom css end  -->
<script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
    }
</script>
{{-- Alert CDN --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<style>
    /* Styling the file input container */
    .file-input-container {
        position: relative;
        width: 200px;
        /* Adjust this size as needed */
        height: 100px;
        /* Adjust this size as needed */
        border: 2px dashed #aaa;
        border-radius: 5px;
        background-color: #f9f9f9;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        overflow: hidden;
    }

    /* Styling the input element */
    .file-input-container input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Styling for when dragging files over the container */
    .file-input-container.drag-over {
        border-color: #007bff;
        background-color: #eaf2ff;
    }

    /* Styling for the text inside the container */
    .file-input-text {
        text-align: center;
        color: #777;
    }

    /* Optional: Hover effect */
    .file-input-container:hover {
        background-color: #f0f0f0;
    }
</style>



@livewireStyles