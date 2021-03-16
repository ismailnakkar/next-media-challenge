<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <title>Tech Challenge</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Tech Challenge</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item {{ !Route::is('products.navigate') ?: 'active'  }} mr-5">
              <a class="nav-link" href="{{ route('products.navigate') }}">Navigate</a>
            </li>
            <li class="nav-item {{ !Route::is('products.create') ?: 'active'  }}">
                <a class="nav-link" href="{{ route('products.create') }}">Create</a>
            </li>
          </ul>
        </div>
    </nav>
    <div id="app">
        {{ $slot }}
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
