<!DOCTYPE html>
<html lang="en">
<head>
  <title>Message Logout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="3; url={{action('Blog@index')}}" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
 <br>

<div class="container">
  <div class="card">
  <div class="card bg-success text-white  text-center">
    <div class="card-body">{{$Message}}</div>
  </div>
  </div>
</div>
</body>
</html>
