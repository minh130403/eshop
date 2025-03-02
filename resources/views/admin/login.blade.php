<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

  @if (session('error'))
  <div class="alert alert-success">
    {{ session('error') }}
</div>
  @endif
        <form class="border shadow p-5 rounded" method="POST">
          @csrf
          <h1 class="text-center">Login</h1>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
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
        </form>
  </body>
</html>