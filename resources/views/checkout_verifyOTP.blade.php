<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Interface</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('/css/server/styles.css') }}" rel="stylesheet">

        </style>
    </head>
    <body>

    <div class="row">
        <div class="col s12 m6 offset-m3">
          <div class="card darken-1">
            <!-- <div class="card-content">
              <h5><img src="/logo2.jpg" alt="hash logo" height="50" width="120"></h5>
              <p style="font-weight: bold">Pay with HAsh</p>
            </div> -->
            <div class="card-action">
            <form id="checkoutform_verifyOTP" method="POST" action="/checkoutform_verifyOTP">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">mail</i>
                  <input type="text" id="otp" class="validate">
                  <label class="otplabel" for="otp"hash>Enter OTP</label>
                             </div>
              </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Confirm</button>
                @if($error=="old")
                <label>wrong pin, try again</label>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="{{ asset('/js/server/hash.js') }}" type="text/javascript"></script>
</html>
