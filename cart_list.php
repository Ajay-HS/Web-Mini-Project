<?php 
  $title="Cart/Order Summary";
  include 'cus_head.php';
  require_once('conn.php');
  
  
  //Delete item logic
  if(isset($_GET['Delete']))
  {
	  $ID = $_GET['Delete'];
	  $query = "Delete from cart where (p_name = '$ID')";
	  
	  if (mysql_query ($query , $conn ) ) {
		echo 'Successfully deleted' ; 	
	  }	
	
	  else{
		echo mysql_error ($conn) ; 	
	  }
  }	
?>  

  <ol class="breadcrumb">
    <li><a>Product</a></li>
    <li><a>cart</a></li>
  </ol>
  
  <div class="row">
      <center>
      <h1>Your CART</h1>
  <?php 
  require_once('conn.php');
  //$cid = $_POST['cid'];
  $cid = isset( $_GET['cid'] ) ? $_GET['cid'] : 12;
				echo "<div class='in'>";

				$q="select * from cart where c_name='".$cid."'";
				$rs=mysql_query($q);
				echo "<table border='1' align='center'>
					<tr>
						<th>No.</th>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Delete Option</th>
					<tr>";
					$i=0;
					$qua=0;
					$p1=0;
					$p2=0;
				while($row=mysql_fetch_array($rs))
				{
					$q1="select pname from products where pid='".$row[1]."'";
					$rs1=mysql_query($q1);
					$value = mysql_fetch_object($rs1);
					$i++;
					echo"<tr>
						<td>$i</td>
						<td>$row[1]</td>
						<td>$value->pname</td>
						<td>$row[2]</td>
						<td>$row[3]</td>
						<td>".$row[2]*$row[3]."</td>		
					";
					
					echo '<td><a href="cart_list.php?Delete='.$row ['p_name'].'" > Delete  </a></td>'.'</tr>';
						$qua+=$row[2];
						$p1+=$row[3];
						$p2=$p2+($row[2]*$row[3]);
						
				
				}
				
				echo "<tr><th colspan='3'>Total</th>
						<th>".$qua."</th>
						<th>".$p1."</th>
						<th>".$p2."</th>
					 </tr>";
				echo "</table>";
				//echo '<a href="cart_list.php?cid='.$cid.'">[ Reload ]</a>';
   ?>      
         <br />
		
		 <br />    
			<a href="user_info1.php?amt=<?php echo $p2;?>&cid=<?php echo $cid;?>" class="btn btn-success" role="button">BUY (PAY PAL)</a>  </p>
                                
			
		 <br />
		 <br />
		 <div class="in">
		 	<a href="cus_index.php?cid=<?php echo $cid;?>"><font size="+2" color="#FF3333">Purchase More</font></a>
</center>
  </div>  

<?php 
include 'footer.php'; 
?>