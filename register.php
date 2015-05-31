<?php
// include db connect class
require_once('db_connect.php');

// connecting to db
$db = new DB_CONNECT();
// array for JSON response
$response = array();


// check for required fields
if (isset($_POST['user_name'])
    && isset($_POST['profile_pic'])
    && isset($_POST['token'])
    && isset($_POST['user_id'])
) {


    $user_name = isset($_REQUEST['user_name']) ? $_REQUEST['user_name'] : '';
    $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
    $profile_pic = isset($_REQUEST['profile_pic']) ? $_REQUEST['profile_pic'] : '';
    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '';


    $usercheck = "SELECT * FROM famecam_user where user_name='$user_name'";
    $str_query = mysql_query($usercheck) or die("mysql query error " . mysql_error());

    if (mysql_num_rows($str_query) > 0) {

        //$response["success"] = 0;
        //$response["message"] = "Email already exists";

        // echoing JSON response
        //   echo json_encode($response);
        // exit;

        $sql = "UPDATE famecam_user SET token = '$token' WHERE (user_name = '$user_name')";
        $resultPass = mysql_query($sql) or die("Mysql query error " . mysql_error());
    } else {

        $sql = ("INSERT INTO famecam_user(user_name,
                                        user_id,
                                        profile_pic,
                                        token ) 
                  			                        VALUES('$user_name', 
                                          						'$user_id',
                                          						'$profile_pic',
                                          				    '$token')");

        $resultPass = mysql_query($sql) or die("Mysql query error " . mysql_error());

    }

} else {

    $response["success"] = 0;
    $response["message"] = "Fields cannot be empty";
    // echoing JSON response
    echo json_encode($response);
    exit;
}
?>
 