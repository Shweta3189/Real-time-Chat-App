<?php
	//getting the value of post parameters
	$room = $_POST['room'];

	if(strlen($room)>20 or strlen($room)< 2)
	{
		$message = "Please choose a name between 2 to 20 characters";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/Chatroom";';
		echo '</script>';

	}
	elseif(!ctype_alnum($room)) {
	    $message = "Please choose an alphanumeric room name";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/Chatroom";';
		echo '</script>';
	}
	else{
		//connect to database
		include  'db_connect.php';
		//echo "check";s
	}
	//check if room already exists
  $sql="SELECT * FROM `rooms` WHERE roomname='$room'";
  $result = mysqli_query($conn,$sql);
  if($result){
  	if(mysqli_num_rows($result)>0){
  		$message = "Please choose a different room name. This room is already claimed.";
  		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/Chatroom";';
		echo '</script>';
  	}
  	else{
  		$sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ( '$room', current_timestamp());";
  		if(mysqli_query($conn,$sql)){
  			#code...
  			$message = "Your room is ready to be filed by Gossips. HAHAHA";
  		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/Chatroom/rooms.php?roomname='.$room.'";';
		echo '</script>';

  		}
  	}
  }
  else{
  	echo "Error: ".mysqli_error($conn);
  }
 
?>