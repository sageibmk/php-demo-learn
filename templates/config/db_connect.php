<?php 

  //connect to database
  $conn = mysqli_connect('localhost','sage','sage123', 'sage_pizza');

  //check connection
  if(!$conn){
     echo 'Connection error:'. mysqli_connect_error();
  }