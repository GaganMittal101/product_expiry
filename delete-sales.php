<?php 
include('topbar.php');
if(empty($_SESSION['login_email']))
    {   
      header("Location: login.php"); 
    }
    else{
	}
      
$saleID= $_GET['sid']; 
$productID= $_GET['pid']; 
$qty_new= $_GET['qty_new']; 
$qty_old= $_GET['qty_old']; 

$sql = "DELETE FROM sales WHERE saleID =?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$saleID]);


  //update stock summary of drug

  $newQty =   $qty_old + $qty_new;
  $sql = "UPDATE tblproduct SET qty=? where productID=?";
  $stmt= $dbh->prepare($sql);
  $stmt->execute([$newQty, $productID]);



//save activity log details
$task= $fullname.' '.'Deleted Drug'.' '. 'On' . ' '.$current_date;
$sql = 'INSERT INTO activity_log(task) VALUES(:task)';
$statement = $dbh->prepare($sql);
$statement->execute([
	':task' => $task
]);

header("Location: sales-record.php"); 
 ?>