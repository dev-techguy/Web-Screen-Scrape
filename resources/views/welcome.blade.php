<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="container">
    <div class="row m-5">
        <div class="col-md-5">
            <h3 class="text-center text-primary">{{ \App\Http\Controllers\PageController::stateTimer() }} User</h3>
            <p>Follow the instructions below to see how to screen scrape a website. For this eaxample we are going to
                scrape all the <b class="text-danger">h2</b> with links that is the anchor tag <i><b
                        class="text-danger">a</b></i></p>
            <ul>
                <li>Enter the website url i.e <a href="#">http://domain.com or https://domain.co</a></li>
                <li>Click the submit button.</li>
                <li>Wait for the results to come.</li>
            </ul>
            <hr>
            <form action="{{ route('crawl') }}" method="get" class="m-5">
                <div class="form-group">
                    <label for="url"><strong>Enter a website url</strong></label>
                    <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                           required autofocus placeholder="https or http url">
                    @error('url')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-primary btn-lg float-right"><b>SUBMIT</b></button>
                </div>
            </form>
            <br>
            <br>
            <hr>
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-6">
            <h4 class="text-center text-primary"><strong>The Website Results Will Be Shown Here</strong></h4>
            @if(!empty($crawler))
                <h5 class="text-center">
                    <hr>
                    Results For <i><b>{{ $url }}</b></i>
                    <hr>
                </h5>
            @endif
            <p class="m-5">
            @if(!empty($crawler))
                @php($crawler->filter('h2 > a')->each(function ($node) {
								 print  $node->text() . "\n";
							 }))
            @else
                <center>
                    <img src="{{ asset('img/warning.png') }}" alt=""
                         style="width: 200px;!important;height: 200px;!important;">
                </center>
                @endif
                </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4">
            <div class="card-footer">
                <p class="text-center">&copy; CopyRight {{ date('Y') }} {{ config('app.name') }}</p>
            </div>
        </div>
        <div class="col-md-4">&nbsp;</div>
    </div>
</div>
</body>
</html>
