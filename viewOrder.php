<?php
include("config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		 $uid=addslashes($_POST['uid']);
		 $oid=addslashes($_POST['oid']);
		 $totalBill =addslashes($_POST["totalBill"]);
		$sql ="UPDATE order_details SET status= 2 WHERE uid= $uid and order_no = $oid";
		//echo $sql; exit;
					if (mysqli_query($bd, $sql)) {
						$message = "Approved, Chef will start preparing food, Bill to be paidis INR ". $totalBill;
						echo "<script type='text/javascript'>alert('$message');window.location = 'http://localhost/rms/newOrders.php';</script>";
						
						//header("location: newOrders.php");
						
						
					}
		
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/custom.css' rel='stylesheet' type='text/css'>
<script src="js/jquery.js"></script>
<script src="js/custom.js"></script>
  <title>View Orders</title>
  
</head>
<body> 

	<form method="post" action="viewOrder.php">

	<!--<table border ="5" class="table-create-box">
		<tr>
		<th><a href="javascript:;"><h1>Food Menu </h1></a></th>
		<th><a href="myOrder.php"><h1>My Orders </h1></a></th>
		</tr>
	</table> -->
	<div class="big-box">
	
	<?php
	if(isset($_GET["uid"])){
			$uid =$_GET["uid"];
			$oid =$_GET["oid"];
			
			$sql=" SELECT OD.uid, FI.food_item_name as item,OD.price as total ,OD.quantity as quantity ,FI.food_price as price , OD.Order_date";
			$sql= $sql. " FROM order_details as OD";
			$sql= $sql. " INNER JOIN food_item as FI"; 
			$sql= $sql. " ON OD.fid = FI.fid";
			$sql= $sql. " where OD.status = 1 and order_no = $oid and OD.uid = $uid	ORDER by OD.uid";
				//echo $sql; exit;
			$result=mysqli_query($bd,$sql);
			//$row=mysqli_fetch_assoc($result);
			$count=mysqli_num_rows($result);		
	 
			// If user already registered
			if($count >= 1){?>	
				<input type="hidden" id = "uid" name = "uid" value = <?php echo $uid; ?> >
				<input type="hidden" id = "oid" name = "oid" value = <?php echo $oid; ?> >
				<br><br>
				<table align="center" border ="5" class="table-create-inner-box">
					<tr class="tr-food-header">
						<th>Item</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total Price</th>
                        <th>Order Date</th>
                        
					</tr>
				
				<?php $count = 1; $totalBill = 0;
				while($row=mysqli_fetch_assoc($result)){
					?>
					<tr>
						<td><?php echo $row['item'] ?></td>
						<td><?php echo $row['price'] ?></td>
						<td><?php echo  $row['quantity'] ?></td>
						
						<td><?php $totalBill = $totalBill + $row['total']; echo  $row['total'] ?></td>
            
					</tr>
				<?php	$count++;
				}?>
				
				</table>
				<input type="hidden" id = "totalBill" name = "totalBill" value = <?php echo $totalBill; ?> >
			<?php }
	}?>

<table align="center">
	<tr>
		<td>
			<input type ="submit" id="save" name ="save" class="btn" value="Approve">
		</td>
		<td>
			<a href="newOrders.php" ><div id="btn2">Back</div></a>
		</td>
	</tr>
</table>
	</div> 
	  
	</form>  
</body>
</html>
