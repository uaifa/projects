
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@stack('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}" />
    
    @include('admin.partials.styles')
    <style type="text/css">
        .flipswitch {
  position: relative;
  background: white;
  width: 120px;
  height: 40px;
  -webkit-appearance: initial;
  border-radius: 3px;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  outline: none;
  font-size: 14px;
  font-family: Trebuchet, Arial, sans-serif;
  font-weight: bold;
  cursor: pointer;
  border: 1px solid #ddd;
}

.flipswitch:after {
  position: absolute;
  top: 5%;
  display: block;
  line-height: 32px;
  width: 45%;
  height: 90%;
  background: #fff;
  box-sizing: border-box;
  text-align: center;
  transition: all 0.3s ease-in 0s;
  color: black;
  border: #888 1px solid;
  border-radius: 3px;
}

.flipswitch:after {
  left: 2%;
  content: "OFF";
}

.flipswitch:checked:after {
  left: 53%;
  content: "ON";
}

    </style>
    @notifyCss
    @stack('css')
