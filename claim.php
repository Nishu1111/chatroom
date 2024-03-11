
<?php
//getting the value of post parameters
$room = $_POST['room'];
//checking for string size
if(strlen($room)>20 or strlen($room)<2)
{
    $message = "please choose a name between 2 to 20 characters";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
}
//checking whether room name is alphanumeric
else if(!ctype_alnum($room))
{
    $message = "please choose an alphanumeric room name";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
}

else
{
    //connecting to the database
    include 'db_connect.php';
}
//check if room already exists
$sql = "SELECT * FROM `srooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if($result)
{
    if (mysqli_num_rows($result) > 0)
     {
        $message = "please choose a different room name. This room is already claimed";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
    }
    else{
        $sql = "INSERT INTO `srooms` ( `roomname`, `sDate`) VALUES ( '$room', current_timestamp());";
     if (mysqli_query($conn, $sql))
        {
            $message = "Your room is ready and you can chat now!";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $room. '";';
            echo '</script>';
      }
    }
}
echo "Error: ". mysqli_error($conn);
?>