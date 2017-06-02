<?php
// begin the session
session_start();
?>
<head>
<style>
	table.active,table.active th,table.active td {
	   border: 1px solid black;
	}
	table.active{
		min-width:400px;
	}
</style>

</head>
<form action="test.php" method="post">
<p>Number: <input type="text" name="number" /></p>
<input type="submit" name="submit" value="Submit" />
</form>

<?php

if(isset($_POST['number']) && is_numeric($_POST['number']) && $_POST['number']>0 )
{
	$number = $_POST['number'];
	$currTime = date('m/d/Y h:i:s a', time());
	$arr = [];$count=0;
	$numberOfLog = isset($_SESSION['value'])?count($_SESSION['value']):0;
	$numberOfLog++;
	
	for($i=1;$i<=$number;$i++){
		if($i%15==0){
			$arr[] =  "HANOI";
			$count++;
		}elseif($i%3==0){
			$arr[] =  "HA";
		}elseif($i%5==0){
			$arr[] =  "NOI";
		}else{
			$arr[] =  $i."";
		}
	}
	
	$log[$numberOfLog]["currTime"] = $currTime;
	$log[$numberOfLog]["number"] = $number;
	$log[$numberOfLog]["count"] = $count;
	if(!isset($_SESSION['value'])){
		$_SESSION['value']= [];
	}
	array_push($_SESSION['value'],$log);
	echo join( $arr,",") ."<br><br>";
	
}
?>

Table List(tested) 
<table class="<?php echo (isset($_SESSION['value']) && count($_SESSION['value'])>0)? "active" : ""; ?> ">
	<tbody>
	<?php 
	if(isset($_SESSION['value'])){
		$value = $_SESSION['value'];
		foreach ($value as $key => $row){
			echo'<tr>';
			foreach ($value[$key] as $row2){
				echo'<td>'. ($key+1)."</td>";
				echo'<td>'. $row2["currTime"]."</td>";
				echo'<td>'. $row2['number'].'</td>';
				echo'<td>'. $row2['count'].'</td>';
			}
			echo'<tr>';
		}
	}
	?>
	</tbody>
</table>