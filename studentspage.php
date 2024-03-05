<?php
    $con=mysqli_connect("localhost","root","","verification") ;

     
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $student_name=$_POST['student_name'];
        $student_usn=$_POST['susn'];
        $student_query=$_POST['squery'];
        $sent_to=$_POST['tomentor'];
        $q_id=0;
        
          if(!empty($student_name) && !empty($student_usn) && !empty($student_query) && !empty($sent_to)){
    
            $query="insert into students_query( q_id,student_usn,student_query,student_name,send_to) values('$q_id','$student_usn','$student_query',' $student_name','$sent_to')";
            mysqli_query($con,$query);
           }else{
   
               echo"<script>alert(\"Something went Wrong please check network ,or You might have not filled the form properly try again\")window.location.href=\"student-login.php\"</script>";
           }
}

?>