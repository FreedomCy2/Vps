<!doctype html>
<html>
<head><meta charset="utf-8"><title>Forgot Password</title></head>
<body>
  @if (session('status'))
    <div style="color:green">{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div style="color:red">
      <ul>
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
    <button type="submit">Send Reset Link</button>
  </form>
</body>
</html>
