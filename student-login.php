<?php
  include("studentspage.php"); 
  include("logindb.php");
 include("passwordreset.php");
  $username = $_GET['param'];
  if($username=='' || $username==null){
    echo"<script> alert(\"Login Section Timed out Login again to asscess\");window.location.href=\"login.php\"</script>";
  }
  $query1="select * from student_login where user ='$username'";
  $student_table=mysqli_query($con,$query1);
  $student_info = mysqli_fetch_assoc( $student_table) ;


  $query2="select * from mentor_respond  where sendto = '$username' ";
  $mentortable =mysqli_query($con,$query2);
  $mentorreply = array();
  if($mentortable && mysqli_num_rows($mentortable) > 0){
    while ($rows1 = mysqli_fetch_assoc($mentortable)) {
        $mentorreply[] = $rows1;
       
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background: linear-gradient(75deg,#10add46c ,#35dae022);
            
        }

        header {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        h1 {
            font-size: 36px;
        }

        .container {
            max-width: 800px;
            margin: 10px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(75deg,#10add46c ,#35dae022);
            animation: slide-up 0.5s ease-out forwards;
            opacity: 0%;
            z-index: 0;
        }

        .student-info {
            text-align: center;
            overflow: hidden;
             white-space: nowrap;
        }
        .student-info p {
           transform: translateX(-100%);
           animation: slideInLeft 1s forwards;
          }

          @keyframes slideInLeft {
             from {
                  transform: translatex(-50%);
              }
             to {
             transform: translatex(0);
              }
            }
        .student-actions {
            text-align: center;
        }

        .btn {
            display: inline-block;
            font-size: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.5s ease, box-shadow 0.5s ease;
        }
        .btn-send{
            position: absolute;
            top: 330px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 15px;
            margin: 10px;
            cursor: pointer;
            font-size: 20px;
            width: 250px;
            margin-left: 540px;
            transition: background-color 0.5s ease, box-shadow 0.5s ease;
        }

        .btn-send:hover{
            color: black;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); 
            background: linear-gradient(to bottom right, #33ccff 40%, #ba91e4 100%);
        }
        .btn:hover {
            color: black;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); 
            background: linear-gradient(to bottom right, #33ccff 40%, #ba91e4 100%);
        }

        .img{
            top:15px;
            position: absolute;
            left:85px;  
            border-radius:10%;  
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
        }

        .centered-div {
          height:375px;
          width: 900px;
          display: none;
          position: absolute;
          top: 78%;
          left: 50%;
          transform: translate(-50%, -50%);
          background-color: #fff;
          background: linear-gradient(to bottom right, #33ccff 0%, #ba91e48e 100%);
          padding: 20px;
          border-radius: 5px;
          box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
        
        }
       

        select#mentor-select, input#student-name {
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .usn-textarea {
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .profile{
            width: 200px;
            height: 200px;
            position: absolute;
            top: 120px;
            right:160px;
            
        }
        .rtable{
            position: absolute;
            top:auto;
            left:200px;
            font-size:23px;
            text-align: center;
            font-family: 'Roboto', sans-serif;
        }
        .responsedisplay{
            display: none;
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
        .confirm{
            position: absolute;
            top:300px;
            right:50px;
            width:400px;
            height: 120px;
            background: linear-gradient(to bottom right, #33ccff 0%, #ba91e48e 100%);
            padding: 20px;
            border-bottom-right-radius: 50px;
            border-top-left-radius: 50px;
            box-shadow: 10px 10px 15px rgba(0, 0, 255, 0.3);
            display: none;
            animation: slideInLeft 1s forwards;
            z-index: 1;
            opacity: 0%;
        }
      
        @keyframes slideInLeft {
             from {
                  transform: translatex(-10%);
                  opacity: 0%;
              }
             to {
             transform: translatex(0);
             opacity: 100%;
              }
            }
        .btn-yes{
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 15px;
            margin: 10px;
            cursor: pointer;
            font-size: 20px;
            width: 50px;
            transition: background-color 0.5s ease, box-shadow 0.5s ease;
            margin-left: 100px;
            text-align: center;
        }
        .btn-cancle{
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 15px;
            margin: 10px;
            cursor: pointer;
            font-size: 20px;
            width: 50px;
            transition: background-color 0.5s ease, box-shadow 0.5s ease;
            text-align: center;
        }
        .pass{
            position: absolute;
            top:300px;
            left:50px;
            width:400px;
            height: 140px;
            background: linear-gradient(to bottom right, #33ccff 0%, #ba91e48e 100%);
            padding: 20px;
            border-bottom-right-radius: 50px;
            border-top-left-radius: 50px;
            box-shadow: 10px 10px 15px rgba(0, 0, 255, 0.3);
            display: none;
            animation: slideInLeft 1s forwards;
            z-index: 1;
            opacity: 0%;
        }
    </style>
</head>
<body>
    <header>
        <image src="download.png" height="150" width="153" class="img"> </image>
        <h1>Welcome , <span style="margin-left: 2px;"><?php echo $student_info['student_name']; ?></span></h1>
        <p style="font-size: 20px;">Your Student Dashboard</p>
        <br>
    </header>

    <div class="container">
        <div class="student-info">
            <h2> Student Information</h2>
            <p style="font-size: 18px;">Name:<?php echo $student_info['student_name']; ?></span></p>
            <p  style="font-size: 18px;">Student ID:<?php echo $student_info['user']; ?></span></p>
            <p  style="font-size: 18px;">Major: Computer Science</p>
        </div>

        <div class="student-actions">
            <h2>Actions</h2>
           <!-- <a class="btn" onclick="pass();">Set Password</a>-->
            <a id="showButton" class="btn">Ask Queries</a>
            <a id="responsebtn" class="btn">Check For Response</a>
            <a class="btn" onclick="logout();">Logout</a>
        </div>
    </div>




    <div class="confirm" id="log">
          <h2>confirm you want to log out?</h2>
          <a href="login.php" class=btn-yes > yes</a>
          <a class=btn-cancle onclick="logout();">cancle</a>
    </div>



<!--<div class="pass" id="password">
        <form method="post">
            <span style="display: none;" name="user-pass-usn"><?php echo $username; ?></span>  
          <h2>enter you new password:</h2>
          <input type="text" name="password" style="font-size: 20px;width:95%; background:transparent;"></br>
          <input type="submit" class=btn-yes onclick="alert('Password Reset successful');pass();" style="width: 100px;" value="Reset"></input>
          <a class=btn-cancle onclick="pass();">cancel</a>

          </form>
    </div>-->





    <div id="newDiv" class="centered-div">
        <h1 style="justify-content: center; display: flex;">Ask a Question to Your Mentor</h1>
        <form method="POST" style="font-size: 20px;">
            <table>
                <tr>
                    <th >Select a Mentor:</th>
                    <td>
                        <select id="mentor-select" name="tomentor"  style="background: transparent; font-size: 19px;" required >
                            <option value="none">choose mentor</option>
                            <option value="CSEME001">Dr.Shrihari Joshi (HOD)</option>
                            <option value="CSEME002">Dr.U.P kulkarni</option>
                            <option value="CSEME003">Dr.Jayadevi karur</option>
                            <option value="CSEME004">Prof.Prathapkumar M K</option>
                            <option value="CSEME005">Prof.Rani Shetty</option>
                            <option value="CSEME006">Dr.Raghavendra G S</option>
                            <option value="CSEME007">Prof.Indira Umarji</option>

                          
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Your Name:</th>
                    <td><input type="text" id="student-name"  style=" background:transparent;font-size: 19px;" name="student_name" value="<?php echo $student_info['student_name']; ?>" readonly required ></td>
                </tr>
                <tr>
                    <th>Your USN:</th>
                    <td><input id="usn" name="susn"  style="background: transparent;font-size: 19px;" class="usn-textarea" value="<?php echo $student_info['user']; ?>" readonly required ></input></td>
                </tr>
                <tr>
                    <th>Write Your Query Here:</th>
                    <td><textarea id="additional-info"  style="background: transparent;font-size: 19px;" name="squery" class="usn-textarea" required></textarea></td>
                </tr>
                <tr>
                    <th>select your gender</th>
                    <td>
                        <input type="radio" name="gender" value="male" required> Male
                        <input type="radio" name="gender" value="female" required> Female<br>
                    </td>
                </tr>
                <tr>
                    <th>
                        <input type="checkbox" id="check"  value="1" required>Confrim USN  </input>
                    </th>
                </tr>
            </table>
            <button type="submit" id="btn" class="btn-send" onclick="done();">Send</button>
        </form>
        <img id="mentor-photo" src="https://cdn.techjuice.pk/wp-content/uploads/2015/02/wallpaper-for-facebook-profile-photo-1130x712.jpg" class="profile" style="border-radius: 15px ; box-shadow:5px 5px 15px rgba(0, 0, 0, 0.5);">
    
    </div>
    <div id="response" class="responsedisplay" >
        <table border="1" class="rtable">
            <tr style="color:white;  
                 background: linear-gradient(to left, #33ccff 0%, #ba91e4be 100%);"> 

                <td width="500px" height="70px">Mentor Name</td> 
                <td width="500px" height="70px">Your Query</td> 
                <td width="700px">Response from mentor</td> 

            </tr> 
            <?php 
              
              foreach ($mentorreply as $row1) {
                ?>
                    <tr>
                     
                        <td ><?php echo $row1['mentor_name']; ?></td>
                        <td><?php echo $row1['questions']; ?></td>
                        <td ><?php echo $row1['mentor_reply']; ?></td>
                    </tr>
                <?php
                }
            
            ?>
              <?php if (empty($mentorreply)) { ?>
            <tr> 
                <td> 
                    No Response
                </td> 
                <td> 
                    Please come back later
                </td>  
                <td>
                 Your Mentor has not yet replied to your Query
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>
<script>


        var mentorSelect = document.getElementById("mentor-select");
        var mentorPhoto = document.getElementById("mentor-photo");

        mentorSelect.addEventListener("change", function () {
            var selectedMentor = mentorSelect.value;
            if (selectedMentor === "CSEME004") {
                mentorPhoto.src = "staff/prathapkumar-mk.jpg";
            } else if (selectedMentor === "CSEME001") {
                mentorPhoto.src = "staff/shrihari-joshi.jpg";
            } else if (selectedMentor ==="CSEME002") {
                mentorPhoto.src = "staff/up-kulkarni.jpg";
            } else if (selectedMentor === "CSEME003") {
                mentorPhoto.src = "staff/jayadevi-karur.jpg";
            } else if (selectedMentor === "CSEME005") {
                mentorPhoto.src = "staff/rani-shetty.jpg";
            }else if (selectedMentor === "CSEME006") {
                mentorPhoto.src = "staff/raghavendra-gs.jpg";
            } else if (selectedMentor === "CSEME007") {
                mentorPhoto.src = "staff/indira-umarji.jpg";
            }  else {
                mentorPhoto.src = "https://cdn.techjuice.pk/wp-content/uploads/2015/02/wallpaper-for-facebook-profile-photo-1130x712.jpg"; 
            }
        });
   
        /*function pass(){
            event.preventDefault();
             var pass=document.getElementById('password');
             if(pass.style.display=="block"){
                  pass.style.display="none";
             }else{
                  pass.style.display="block";
              }
        }*/
    function logout(){

        var logout=document.getElementById('log');
        if(logout.style.display=="block"){
            logout.style.display="none";
        }else{
            logout.style.display="block";
        }
    }
    showButton.addEventListener("click", function() {
        response.style.display="none"
      
        if (newDiv.style.display === "none") {
            newDiv.style.display = "block"; 

        } 
         else 
         newDiv.style.display="none"

         
    });

     
     responsebtn.addEventListener("click", function() {
            newDiv.style.display="none"
        if (response.style.display === "none") {
            response.style.display = "block"; 


        } 
         else 
         response.style.display="none"
    });



    function done() {
    var mentorSelect=document.getElementById("mentor-select").value;
    var additionalInfo = document.getElementById("additional-info").value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var check = document.getElementById("check").checked;
    var usnPattern = /^2SD\d{2}CS\d{3}$/;

    if (!gender || !check || !additionalInfo || !mentorSelect) {
        alert("Please fill in all fields before sending your query.");
        event.preventDefault();
    } 
    else if(mentorSelect==="none"){
        alert("select a mentor frist");
        event.preventDefault();
    } 
    else {
        alert("Your Query Has Been Sent");
    }
}

       

 
/*  <option value="prof.Ravindra Dastikop">Prof.Ravindra Dastikop</option>
                            <option value="prof.Nita G Kulkarni">Prof.Nita G Kulkarni</option>
                            <option value="prof.Vidyagowri Kulkarni">Dr.Vidyagowri Kulkarni</option>

                            <option value="prof.Shivanagowda G M">Dr.Shivanagowda G M</option>
                            <option value="prof.Ranganath Yadwad">Prof.Ranganath Yadwad</option>
                            <option value="prof.Anand Vaidya">Prof.Anand Vaidya</option>

                            <option value="prof.Archana Nadibewoor">Dr.Archana Nadibewoor</option>
                            <option value="prof.Shreedhar Yadwad">Prof.Shreedhar Yadwad</option>
                            <option value="Prof.Govind Negalur">Prof.Govind Negalur</option>
                            
                            <option value="prof.Smitesh Patravali">Prof.Smitesh Patravali</option>
                            <option value="prof.Sandhya S V">Prof.Sandhya S V</option>
                           

                            <option value="prof.Basavaraj Vaddatti">Prof.Basavaraj Vaddatti</option>
                            <option value="prof.Rani Shetty">Prof.Rani Shetty</option>
                            <option value="prof.Rashmi Patil">Prof.Rashmi Patil</option>

                            <option value="prof.Yashodha Sambrani">Prof.Yashodha Sambrani</option>
                            <option value="prof.Anand Pashupatimath">Prof.Anand Pashupatimath</option>
                            <option value="prof.Sharada H N">Prof.Sharada H N</option>*/


</script>
</html>


