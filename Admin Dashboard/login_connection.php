<?php

$con = mysqli_connect("localhost","root","","grocgo_login");

if(mysqli_connect_error()){
    // echo "Cannot Connect";
    echo "<script>alert('Cannot Connect'); </script>";
}
else{
    // echo "Connected";
    echo "";
}


?>