<?php

class StudentLogin
{
   

    public function StudLogin($code){
        global $db;
       
        //Start session
        session_start();
        
         
        //Array to store error message
        $error_msg_array = array();

        //Error messages
        $error_msg = FALSE;

        

        if($error_msg) {
            $_SESSION['ERROR_MSG_ARRAY'] = $error_msg_array;
            header("location: http://localhost/voting_system/index.php");
            exit();
        }

        $sql = "SELECT * FROM voters WHERE conformation_code = ? LIMIT 1";

        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $code);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            //Create session
            session_regenerate_id();
            $_SESSION['ID']      = $row['id'];
            $_SESSION['NAME']    = $row['name'];
            $_SESSION['COURSE']  = $row['course'];
            $_SESSION['YEAR']    = $row['year'];
            $_SESSION['STUD_ID'] = $row['stud_id'];
            session_write_close();

            header("location: http://localhost/voting_system/stud_page.php");

        } else {
            $error_msg_array[] = "Sorry the Code you entered is not in the database.";
            $error_msg = TRUE;

            if($error_msg) {
                $_SESSION['ERROR_MSG_ARRAY'] = $error_msg_array;
                header("location: http://localhost/voting_system/index.php");
                exit();
            }
            $stmt->free_result();
        }
        $result->free();
        return $result;
    }
}
