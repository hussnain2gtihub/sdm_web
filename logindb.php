<?php
    $con=mysqli_connect("localhost","root","","verification") ;
   
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $username =$_POST['user'];
        $password=$_POST["password"];
        $selected=$_POST["user-type"];
       if($selected==1){
        if(!empty($username) && !empty($password)){
            $query="select * from mentor_login where user = '$username' limit 1";
            $result=mysqli_query($con,$query);
           
            if($result && mysqli_num_rows($result)>0){
              $userdata=mysqli_fetch_assoc($result);

              if($userdata['pass']==$password){
                header("location:mentor-login.php");
                die;
              }
            }
        }  /* echo"<script> alert(\"invalide input for mentor-dashboard\")</script>";*/
            
        
       }
    
      else{

        if($selected==2){
            if(!empty($username) && !empty($password)){
                $query="select * from student_login where user = '$username' limit 1";
                $result=mysqli_query($con,$query);
               
                if($result && mysqli_num_rows($result)>0){
                  $userdata=mysqli_fetch_assoc($result);
    
                  if($userdata['pass']==$password){
                    header("location:student-login.php");
                    die;
                  }
                }
            }
        }/* echo"<script> alert(\"invalide input for student-dashboard\")</script>";*/
    }
 }

    $query1="select mentor_name from mentor_info where mentor_id ='$username limit 1";
    $mentorname=mysqli_query($con,$query1);
    
    $query2="select mentor_email from mentor_info where mentor_id ='$username limit 1";
    $mentoremail=mysqli_query($con,$query2);

?>  