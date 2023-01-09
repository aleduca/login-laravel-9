<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div>
    @if (auth()->check())
    Welcome {{ auth()->user()->firstName }} | <a href="{{ route('login.destroy') }}">logout</a>
    @else
      <a href="{{ route('login.index') }}">Login</a>
    @endif

    @yield('content')
  </div>
</body>
</html>