<!DOCTYPE html>

<html>

<head>
    
    <title>Lar  avel 5.5 image upload example</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>

<body>

<div class="container">
  <form action="{{ asset('admin/tags/store') }}" method="post">
    {{ csrf_field() }}

    <label>Select Your Image</label><br/>
    <input type="text" name="name">
    <input type="submit" value="submit">
    </div>
  </form>

</div>

</body>




</html>
