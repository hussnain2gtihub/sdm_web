<?php
  include("logindb.php");
  $error='';
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
      $username =$_POST['user'];
      $password=$_POST["password"];
      $selected=$_POST["user-type"];
     if($selected==1){
      if(!empty($username) && !empty($password)){
          $query="select * from mentor_login where user_id = '$username' limit 1";
          $result=mysqli_query($con,$query);
         
          if($result && mysqli_num_rows($result)>0){
            $userdata=mysqli_fetch_assoc($result);

            if($userdata['pass']==$password){
              header("Location: mentor-login.php?param=$username");
              die;
            }
          }
      }  $error="invalide input for mentor-dashboard";
          
      
     }
  
    else{

      if($selected==2){
          if(!empty($username) && !empty($password)){
              $query="select * from student_login where user = '$username' limit 1";
              $result=mysqli_query($con,$query);
             
              if($result && mysqli_num_rows($result)>0){
                $userdata=mysqli_fetch_assoc($result);
  
                if($userdata['pass']==$password){
                  header("Location: student-login.php?param=$username");
                  die;
                }
              }
          }
      }  $error="invalide input for student-dashboard";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    /*background:linear-gradient( 45deg,#10add490 ,#35dae03a);*/
    background-image: url('pipng.png');
    background-size:cover;
    background-position: center; 
}

.login-container {
    position: absolute;
    width:500px;
    left: 1350px;
    top: 350px;
    padding: 20px;
    border-radius: 5px;
    color: aliceblue;
    text-align: center;
    background: border-box;
    animation: slide-up 3s ease-out forwards;
    opacity: 0%;
}
@keyframes slide-up {
        from {
        transform: translateY(10%);
        opacity: 0%;
        }
        to {
        transform: translateY(0);
        opacity: 100%;
        }
        } 

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    text-align: left;
}

label {
    display: block;
    margin-bottom: 8px;
}

input[type="text"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.5s ease, box-shadow 0.5s ease;

}

button:hover {
    background-color: #14b0e0fe;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); 
}
.header {
    
    color: #fff;
    margin-left: 270px;
    margin-top: 290px;
    font-size: 45px;
    animation: slideInLeft 3s forwards;
            opacity: 0%;
}
h1 {
    font-size: 36px;
}
.container {
    max-width: 1100px;
    margin-left: 70px;
    padding: 5px;
    color:whitesmoke;
    border-radius: 5px;
    background-color: whitesmoke;
    box-shadow: 0 0 20px 5px rgba(52, 152, 219, 0.01);
    background: transparent;
    height: max-content;
    
}
.img{
    top:260px;
    position: absolute;
    left:85px;  
    border-radius:10%;  
    box-shadow: 10px 10px 15px rgba(255, 255, 255, 0.3);
    animation: slideInLeft 0.1s forwards;
            opacity: 0%;

}@keyframes slideInLeft {
             from {
                  transform: translatey(-10%);
                  opacity: 0%;
              }
             to {
             transform: translatey(0);
             opacity: 100%;
              }
            }
h2{
    font-size: 30px;
    color: aliceblue;
}

p{
    font-size: 20px;
}
#user{
    width: 95%;
}
#password{
    width: 95%;

}
.dep{
    color: #fff;
    margin-left: 170px;
    margin-top: 100px;
    font-size: 45px;
    opacity: 0%;
    animation: slideIn 5s forwards;
}
@keyframes slideIn {
             from {
                  transform: translatex(-5%);
                  opacity: 0%;
              }
             to {
             transform: translatex(0);
             opacity: 100%;
              }
            }
    </style>
    
</head>
<body>
        <div>
            <image src="download.png" height="150" width="153" class="img"> </image>
            <h1 class="header">Shri Dharmasthala Manjunatheshwara <br> <span style="font-size: 40px;">College of Engineering and Technology Dharwad</span></h1>
            <P class="dep">Department Of Computer Science Engineering</P>
            <br> 
        </div>
        <div class="container">
            <h2>About Us</h2>
            <p class="para">This web application is designed to facilitate communication and collaboration between mentors and their students.<br>Whether you are a mentor looking to provide guidance or a student seeking support, this platform is here to help you <br>connect and achieve your goals.</p>
    
            <h2>Get Started</h2>
            <p>Login into to Dashboard either as  a mentor or a student</p>
        </div>
    <div class="login-container">
        <h1>Login</h1>
        <form  method="post">
            <label for="User">Username:</label>
            <input type="text" id="user" name="user" style="background: transparent;color:#fff" required >
            <label for="password"  >Password:</label>
            <input type="password" id="password" name="password" style="background: transparent;color:#fff" required>

            <label for="user-type">Select User Type:</label>
            <select id="user-type" name="user-type"  style="background: transparent; color:#fff;" required>
                <option value="1">Mentor</option>
                <option value="2">Student</option>
            </select>
           
            <button type="submit" id="loginbtn">Login</button>
            <span id="resu" style="margin-left: 15px;font-size: 16px; background:transparent; color:#fff"><?php echo $error; ?></span> 
        </form>
        <br>
       
       
    </div>
    <p>.</p>
</body>
<script>

       
/*function logto() {
    var username = document.getElementById("user").value;
    var password = document.getElementById("password").value;
    var select = document.getElementById("user-type");
    var selectedValue = select.value;

    
    if (selectedValue === '1') { 
        if (username === 'admin' && password === 'admin') {
            window.location.href = 'mentor-login.html';
            event.preventDefault();
        } else {
            document.getElementById("resu").innerText = "Invalid username or password for Mentor.";
            event.preventDefault();
        }
    } else if (selectedValue === '2') { 
        if (username === 'sdmcet' && password === 'a') { 
            window.location.href = 'student-login.html';
            event.preventDefault();
        } else {
            document.getElementById("resu").innerText = "Invalid username or password for Student.";
            event.preventDefault();
        }
    }
}*/

</script>
</html>
