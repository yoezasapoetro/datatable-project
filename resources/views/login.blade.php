<!DOCTYPE html>
<html
  <head>

    <title>Sign In Project</title>

    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <style>
        body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
        }

        .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
        margin-bottom: 10px;
        }
        .form-signin .checkbox {
        font-weight: normal;
        }
        .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
                box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="{{ url('/login') }}" method="POST">
        {{ csrf_field() }}

        <h2 class="form-signin-heading">Sign in</h2>

        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>