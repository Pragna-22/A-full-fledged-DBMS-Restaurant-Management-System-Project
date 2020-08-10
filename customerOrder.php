<?php
include("config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$dishCount=addslashes($_POST['dishCount']);
		$getOrderNo = "select order_no from last_order";
				$OrderNo = mysqli_query($bd, $getOrderNo);
				$OrderNo = mysqli_fetch_assoc($OrderNo);
				$OrderNo = $OrderNo['order_no']; 
		for($i=1; $i<=$dishCount; $i++){
			//$isChecked = addslashes($_POST["food_".$i]);
			
			if(isset($_POST["food_".$i])){
				$fid =  $_POST["fid_".$i];
				$price = $_POST["price_".$i];
				$quantity = $_POST["quantity_".$i];
				$price = $price * $quantity;
				$OrderDate = date('Y-m-d');
				$status = 1; // Status to set  confirm order
				if (!isset($_SESSION)){
					session_start();					 
				}
				
				$uid = $_SESSION['login_user'];
				
				$sql ="INSERT INTO order_details(uid,fid,price,Order_date,status,quantity,order_no) VALUES ($uid,$fid,$price,'$OrderDate',$status,$quantity,$OrderNo)";
				 //echo $sql; exit;
				if (mysqli_query($bd, $sql)) {
					
					$sql="SELECT available FROM food_item WHERE fid= $fid";
					$result=mysqli_query($bd,$sql);
					$row=mysqli_fetch_array($result);
					$available=$row['available'];
					$available = $available - $quantity;
					$sql ="UPDATE food_item SET available= $available WHERE fid= $fid";
					if (mysqli_query($bd, $sql)) {
						
						$message = "Order Placed Successfully";
						
					}
				}
			} 
		}
		$OrderNo++;
		$sql ="UPDATE last_order SET order_no= $OrderNo";
		$finalQuery = mysqli_query($bd, $sql);							
						
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/custom.css' rel='stylesheet' type='text/css'>
<script src="js/jquery.js"></script>
<script src="js/custom.js"></script>
  <title>New Order</title>
  
</head>
<body>

  

<form method="post" action="customerOrder.php">
<div class="sign-out"><a href="login.php">Sign Out</a></div>
<?php if (!isset($_SESSION)){ session_start(); }?>
<table border ="5" class="table-create-box">
	<tr>
	<th><a href="javascript:;"><h1>Food Menu </h1></a></th>
	<?php if (isset($_SESSION['login_role']) && $_SESSION['login_role'] == 2){ ?>
	<th><a href="newOrders.php"><h1>New Orders </h1></a></th> 
	<?php } ?>
	</tr>
</table>
<div class="big-box">

<h1>Food Menu</h1>
<hr><marquee><?php if (!isset($_SESSION)){ session_start(); }?>
<div > <?php if (isset($_SESSION['login_name'])){
?>Welcome <b><?php echo $_SESSION['login_name'];?></b>, Choose your item and enter quantity</marquee><hr>
<div id="error" class ="error-login"> <?php if(isset($message)){ echo $message; } ?></div>
<?php }
		$sql="SELECT FT.ftid,FC.fcid,FI.fid as fid,FT.ftype_name as type, FC.fcat_name as cuisine,"; $sql= $sql. " FI.food_item_name as dish,"; 
		$sql= $sql. " FI.food_price as price,FI.available ";
		$sql= $sql. " FROM food_type as FT ";   
		$sql= $sql. " INNER JOIN food_category as FC ";  
		$sql= $sql. " ON FT.ftid = FC.ftid ";
		$sql= $sql. " INNER JOIN food_item as FI ";
		$sql= $sql. " ON FC.fcid = FI.fcid where FI.available >0 ";
		
		$result=mysqli_query($bd,$sql);
		//$row=mysqli_fetch_assoc($result);
		$count=mysqli_num_rows($result);		
		//print $count; ?>
		<input type="hidden" id = "dishCount" name ="dishCount" value = <?php echo $count; ?>> <?php 
		// If user already registered
		if($count >= 1){?>	
				
			<table align="center" border ="5" class="table-create-inner-box">
				<tr class="tr-food-header">
					<th>Type</th>
					<th>Cuisine</th>
					<th>Dish</th>
					<th>Price</th>
					<th>Confirm</th>
					<th>Quantity</th>
				</tr>
			
			<?php $count = 1;
			while($row=mysqli_fetch_assoc($result)){
				?>
				<tr>
					<td><?php echo $row['type'] ?></td>
					<td><?php echo $row['cuisine'] ?></td>
					<td><?php echo  $row['dish'] ?></td>
					<td><input type="text" readonly="readonly" id = <?php echo "price_".$count; ?> name = <?php echo "price_".$count; ?> class="quantity" value = <?php echo  $row['price'] ?>></td>
					<td><input type="checkbox" id = <?php echo "food_".$count; ?> name = <?php echo "food_".$count; ?> class = "click-me">
					<input type="hidden" id = <?php echo "fid_".$count; ?> name = <?php echo "fid_".$count; ?> value = <?php echo $row['fid']; ?> class = "click-me"></td>
					<td><div id= <?php echo "qdiv_".$count; ?> name = <?php echo "qdiv_".$count; ?> class="quantity-div"><input type="text" id = <?php echo "quantity_".$count; ?> name = <?php echo "quantity_".$count; ?> class="quantity"></div></td>
					
				</tr>
			<?php	$count++;
			}?>
			
			</table>
		<?php }
?>
<h2 class ="text-center"  style="margin-top: 5px; padding-top: 0;">Create<strong>Stored Procedure</strong> in phpMyAdmin</h2>
    

<table align="center">
	<tr>
		<td>
			<input type ="submit" id="save" name ="save" class="btn" value="Place Order">
		</td>
		<td>
			<a href="#" ><div id="btn2">Cancel</div></a>
		</td>
	</tr>
</table>
</div> 
  
</form>

  
</body>
</html>
