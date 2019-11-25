<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }

        .carousel-inner img {
            width: 50%; /* Set width to 100% */''
            margin: auto;
            min-height:100px;
        }

        /* Hide the carousel text when the screen is less than 600 pixels wide */
        @media (max-width: 200px) {
            .carousel-caption {
                display: none;
            }
        }
    </style>
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

        </div>
    </div>
</nav>

<div class="col-sm-2">
    </div>
<div class="col-sm-8 ">
    <div class="container-fluid well">
        <form class="form-vertical" action="{{action('Blog@post_action',$blog_id)}}" method="POST">
            <textarea rows="4" class="form-control" id="post" name="post" style="resize: vertical;" required>{{$post}}</textarea>
            <br>
            <button style="float: bottom" type="submit" class="btn btn-success">Go</button>
            <a role="button" class="btn btn-danger" href="{{action('Blog@index')}}">Cancel</a>
      
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
</div>

</body>
</html>