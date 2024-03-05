<?php
    $con=mysqli_connect("localhost","root","","verification") ;

     
    if($_SERVER['REQUEST_METHOD']=='POST'){
       $student_usn = $_POST['respond_to'];
       $mentorreply = $_POST['mentorreply'];
       $mentorname=$_POST['mentorname'];
       $sq_id=$_POST['q_id'];
       $question=$_POST['query'];
       
          if(!empty($mentorreply) && !empty($student_usn) && !empty($mentorname)){
         
            $query="insert into mentor_respond(sendto ,mentor_reply,mentor_name,questions) values('$student_usn','$mentorreply','$mentorname','$question')";
            mysqli_query($con,$query);
            $query2="delete from students_query where q_id ='$sq_id' ";
            mysqli_query($con,$query2);

           }else{
   
               echo"<script>alert(\"Please try later there a some Problem in the database\")</script>";
           }
}

?>




