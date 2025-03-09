<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/bootstrap.css', 'resources/js/bootstrap.js'])
    <style>
      body{
        height: 100vh;
        width:100%;
        display:flex;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
<body>

        <form class="border shadow p-5 rounded" method="POST">
          @csrf
          <h1 class="text-center">Login</h1>
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control " id="email" name="email" aria-describedby="emailHelp">
            {{-- @error('title')
                <div class="alert alert-danger"> {{ $message }} </div>
            @enderror --}}
            {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
            <label class="form-check-label" for="exampleCheck1">Remember</label>
          </div>
         <div class="mb-3 text-center" >
          <button type="submit" class="btn btn-primary">Login</button>
         </div>
         <div class="mb-3">
          <a href="/admin/register">Register?</a>
         </div>
         <div class="mb-3">
          <p><i>Admin account: admin@example.com</i></p>
          <p><i>Password: admin123</i></p>
         </div>
        </form>
  </body>
</html>