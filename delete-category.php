<?php 
include('topbar.php');
if(empty($_SESSION['login_email']))
    {   
      header("Location: login.php"); 
    }
    else{
	}
      
$id= $_GET['id'];        
$sql = "DELETE FROM tblcategory WHERE ID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

//save activity log details
$task= $fullname.' '.'Deleted Category'.' '. 'On' . ' '.$current_date;
$sql = 'INSERT INTO activity_log(task) VALUES(:task)';
$statement = $dbh->prepare($sql);
$statement->execute([
	':task' => $task
]);

header("Location: add-category.php"); 
 ?>