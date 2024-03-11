<?php
//get parameters
$roomname = $_GET['roomname'];

//connecting to the database
include 'db_connect.php';

//Execyte sql to check wherher room exists
$sql = "SELECT * FROM `srooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn,$sql);
if($result)
{
//check if room exists
if(mysqli_num_rows($result) ==0)
{
    $message = "This room does not exist. Try creating a new one";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
}
}
else
{
echo "Error : ". mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Bootstrap core CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
  background-color: #4d704d;
}

.container {
  border: 2px solid #dedede;
  background-color: #bfccbf;
  border-radius: 10px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #000000;
  background-color: #003300;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #000000;
}

.time-left {
  float: left;
  color: #000000;
}

.anyClass {
    height:350px;
    overflow-y: scroll;
}
</style>
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal" style="color:#0a3d0d";><b><u>Let's_chat.com</u></b></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#"><u>Home</u></a>
        <a class="p-2 text-dark" href="#"><u>About</u></a>
        <a class="p-2 text-dark" href="#"><u>Contact us</u></a>
        
      </nav>
    
    </div>

<h2>Chat Messages - <?php echo $roomname; ?></h2>

<div class="container"  style="background-color:#738f73";>
    <div class="anyClass">
  
</div>
</div>


<input type="text" class = "form-control" name="usermsg" id="usermsg" placeholder="Add message"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg" style="background-color:#70a38c";>Send</button>
 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
//set for new message in every 1 sec
setInterval(runFunction, 1000);
function runFunction()
{
  $.post("htmsg.php", {room:'<?php echo $roomname ?>'},
  function(data, status)
  {
    document.getElementsByClassName('anyClass')[0]. innerHTML = data;
  }
  )
}

// Get the input field
//using enter key for submit
var input = document.getElementById("usermsg");
input.addEventListener("keypress", function(event) {
 
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});

//If user submits the form
$("#submitmsg").click(function(){
  var clientmsg = $("#usermsg").val();
  $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
function(data, status){
    document.getElementsByClassName('anyClass')[0].innerHTML = data;});
    $("#usermsg").val("");
    return false;
});
</script>

</body>
</html>