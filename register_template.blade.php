
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">

            <a class="navbar-brand" href="#">City Forum</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{$href1}}">{{$MENU_1}}</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{$href2}}">{{$MENU_2}}</a></li>
                <li><a href="{{$href3}}">{{$MENU_3}}</a></li>
            </ul>
        </div>
    </div>
</nav>
<form method="POST" action="{{action('Blog@register_action')}}">
    <div class="container text-center">
        <div class="row content">
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li><p style="text-align: center">{{$error}}</p></li>
                @endforeach
              </ul>
            </div>
            @endif
            </div>
            <div class="col-sm-2 sidenav">
            </div>
            <div class="col-sm-8 text-center">
                <h1>Register</h1>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="user" type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}" >
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password"   >
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password-confirmed" type="password" class="form-control" name="passwordconfirmed" placeholder="Password-Confirmation" >
                </div>
                <br>
                <hr>
                <button style="float: bottom" type="submit" class="btn btn-success">Submit</button>
                <button style="float: bottom" type="reset" class="btn btn-danger">Reset</button>
            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>

    </div>
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</body>
</html>
