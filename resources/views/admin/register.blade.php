<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/bootstrap.js', 'resources/css/bootstrap.css', 'resources/css/admin.css'])
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


        <form class="border shadow p-5 rounded" method="POST" >
          @csrf
          <h1 class="text-center">Register</h1>
          
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
         <div class="mb-3 text-center" >
          <button type="submit" class="btn btn-primary">Register</button>
         </div>
         <div class="mb-3">
          <a href="/admin/login">Login?</a>
         </div>
        </form>
        
  </body>
</html>