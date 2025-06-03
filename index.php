<?php

 $id="";

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

if(isset($_GET['edit']))
  {
    $con=mysqli_connect("localhost","root","","registration");
    $id=$_GET['edit'];
    $qs="select * from form where id='$id'";
    $data=mysqli_query($con,$qs);
    $userData= mysqli_fetch_row($data);

  
   
  }
  if (isset($_POST['update'])) {
    
    $name = $_POST['nam'];
    $contact = $_POST['cnt'];
    $email = $_POST['email'];

    $update_query = "update form set name='$name', phone='$contact', email='$email' where id='$id'";
    $data=mysqli_query($con,$update_query);
   /* echo '<pre>';
    print_r(mysqli_query($con,  $update_query))
    ;
    die();*/
    header('Location: index.php');    
}
  
  if(isset($_GET['delete']))
  {
    $id=$_GET['delete'];   
    $con=mysqli_connect("localhost","root","","registration");
    $delete_query="delete from form where id='$id'";
    $data=mysqli_query($con,$delete_query);
    header('location:index.php');
  }
 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Bootstrap CSS -->
    <link href="../public/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Bootsrap Form</title>
   
    <script>

      function view_table() {
          var table = document.getElementById("viewtable");
          var button = document.getElementById("btn");

          if (table.classList.contains("d-none")) {
              table.classList.remove("d-none");
              button.innerText = "hide";
          } else {
              table.classList.add("d-none");
              button.innerText = "show";
          }
      }
    </script>
   
  </head>
 <!-- <button type="button" onclick="view_table()" id="btn" class="btn btn-primary">View Table</button>  -->
  <body class="d-flex align-items-center justify-content-center flex-column">
      <button type="button" onclick="view_table()" id="btn" class="btn btn-primary">show</button>
    <div class="w-25 p-3">    
      <form  method="post" >
          <div class="mb-3">
            <span>
               <input type="hidden" class="form-control is-valid" id="contact" value="<?php
              if(isset($userData)){
                echo $userData[0];
              }
               ?>"  name="cnt" >
              
            </span>
            <label for="validationServer01" class="form-label" >Name</label>
            <input type="text" class="form-control is-valid" id="validationServer01" value="<?php if(isset($userData)){
              echo $userData[1];
            }?>" name="nam" required>              
          </div>
          <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control is-valid" maxlength="10" id="contact" value="<?php if(isset($userData)){echo $userData[2];} ?>"  name="cnt" >              
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php if(isset($userData)){echo $userData[3];}?>" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>        
          </div>
          
          <button type="submit" name="save" class="btn btn-primary">Submit</button>
          <button type="submit" name="update" class="btn btn-info">Update</button>
          
      </form>
    </div>
    <div  > 
      <?php 

         $con=mysqli_connect("localhost","root","","registration");
         $query="select * from form";
         $data=mysqli_query($con,$query);
      ?>
      
        <table class="table table-success table-striped d-none" id="viewtable">

          <caption>List of users</caption>
          <thead>
            <tr>
              <th scope="col" rowspan="2" class="text-primary">Sr No.</th>
              <th scope="col" rowspan="2" class="text-primary">Name</th>
              <th scope="col" rowspan="2" class="text-primary">Contact</th>
              <th scope="col" rowspan="2" class="text-primary">Email</th>
              <th scope="col" colspan="2" class="text-primary">Action</th>             
            </tr>
           

          </thead>
          <tbody>
         <?php
          while($row=mysqli_fetch_array($data))
          {
         ?>
            
            <tr>
              <th scope="row"><?php echo $row['id']; ?></th>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['phone']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a></td>
              <td><a href="index.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are You Sure !!')"  class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
          <?php }?>
          </tbody>
        </table>
    </div>
      

  </body>
</html>