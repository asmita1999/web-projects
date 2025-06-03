<?php

  if(isset($_POST['save']))
  {

    $name=$_POST['nam'];
    $contact=$_POST['cnt'];
    $email=$_POST['email'];    

    $con=mysqli_connect("localhost","root","","registration");
    $insert_query="insert into form(name,phone,email) values('$name','$contact','$email')";
    $data=mysqli_query($con,$insert_query);
    header('location:index.php');
  }

?>
