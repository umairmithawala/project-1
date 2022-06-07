<?php
   session_start();
   require_once '../../../database/db-con.php';
   ?>
<?php
   if(isset($_SESSION['admin_session_var'])){
       $user_id = $_SESSION['admin_session_var'];
   }else {
       header('location:../../../auth/login.php');
   }
   
       $user_query = "SELECT * FROM `users` WHERE `id` = $user_id";
       $run_fetch = mysqli_query($con, $user_query);
       $user_data = mysqli_fetch_assoc($run_fetch);

       if($user_data['email_verification'] == 0){
        echo "<script>window.location='../utility/email-not-verified.php';</script>";
      }
   ?>
<?php

if (!empty($_GET['id'])) {
    $get_id = $_GET['id'];

// $sql = "DELETE FROM enquiry WHERE id=$getid";
$sql = "UPDATE `dashboard_news` SET `is_deleted` = 1 WHERE `id` = $get_id";

if ($con->query($sql) === TRUE) {
 
  ?>
<script>
    var a_delete = 1;
</script>
  <?php
  
} else {
  // echo "Error deleting record: " . $con->error;
  ?>
  <script>
      window.history.back();
  </script>
  <?php
  header('location:../dashboard-news.php');
}

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete News</title> 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <script>
    if(a_delete == 1){
swal({
  title: "Deleted",
  text: "Dashboard news deleted successfully",
  icon: "warning",
  button: "Done",
});
setTimeout(function(){ 
    window.history.back();
    window.location = "../dashboard-news.php"; }, 2000);
}
else{
    window.history.back();
  window.location = "../dashboard-news.php"; 
}



  </script>
</body>
</html>
