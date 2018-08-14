<?php

	// Returns a connection object using parameters to login
	function SQL_Begin($host, $user, $password, $dBaseName)
	{
		return mysqli_connect($host, $user, $password, $dBaseName);
	}
    // Closes the current SQL connection
	function SQL_End($connection)
	{
		mysqli_close($connection);
	}

    // Returns an array of references to the values
    function refValues($arr)
    { 
        $refs = array();
        foreach ($arr as $key => $value) {
            $refs[$key] = &$arr[$key]; 
        }
        return $refs; 
    }

    // Sends an SQL command whose parameters were safely binded
    function SafeQL($con, $string, $params){
	    $safe_query = $con->prepare($string);
        echo $con->error;
        //for($row = 0; $row < count($params);$row++){
        call_user_func_array(array($safe_query, 'bind_param'), refValues($params));
        //}
        $safe_query->execute();
        $safe_query->close();
    }
?>