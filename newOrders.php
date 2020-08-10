<?php
include("config.php");
	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/custom.css' rel='stylesheet' type='text/css'>
<script src="js/jquery.js"></script>
<script src="js/custom.js"></script>
  <title>New Orders</title>
  
</head>
<body>

  

<form method="post" >
<div class="sign-out"><a href="login.php">Sign Out</a></div>
<table border ="5" class="table-create-box">
	<tr>
	<th><a href="customerOrder.php"><h1>Food Menu </h1></a></th>
	<th><a href="javascript:;"><h1>New Orders </h1></a></th>
	</tr>
</table>
<div class="big-box">

<h1>New Customer Order</h1>

<?php 
		$sql="SELECT DISTINCT(OD.uid) as uid, u.name,OD.order_no as oid ";
		$sql= $sql. " FROM order_details OD";
		$sql= $sql. " INNER JOIN users as u";
		$sql= $sql. " ON OD.uid = u.uid";
		$sql= $sql. " WHERE OD.status = 1"; 
		$result=mysqli_query($bd,$sql);
		//$row=mysqli_fetch_assoc($result);
		$count=mysqli_num_rows($result);		
		//print $count; ?>
		<?php if (!isset($_SESSION)){ session_start(); }?>
<div > <?php if (isset($_SESSION['login_name'])){
    ?><hr><marquee>Welcome <b><?php echo $_SESSION['login_name'];?></b>, <?php echo $count ?> New orders found</marquee>
<div id="error" class ="error-login"> <?php if(isset($message)){ echo $message; } ?></div>
<?php }
		// If user already registered
		if($count >= 1){?>	
				
			<table align="center" border ="5" class="table-create-inner-box">
				<tr class="tr-food-header">				
					<th class="td-new-order">Order No</th>
					<th>Name</th>
				</tr>
			
			<?php $i = 1;			
			while($row=mysqli_fetch_assoc($result)){
				$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/';
				?>
				<tr>
				
					<td class="td-new-order"><?php echo $row['oid']; ?></td>
					<td>
					<?php  $site_url = $site_url .'rms/viewOrder.php?uid='.$row['uid'].'&oid='.$row['oid']; ?>
					<a href = <?php echo $site_url; ?>><?php echo $row['name'] ?></a></td>	
                    <?php $site_url = $site_url .'rms/viewOrder.php? uid='.$row['time'].'&time='.$row['time']; ?>
					<!--<input type="hidden" id = "userId" name = "userId">	 -->				
				</tr>
			<?php $i++;
			}?>
			
			</table>
		<?php }
?>
    </div></div></form></body></html>    
