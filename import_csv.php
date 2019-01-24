<?php
    
    function csv_to_array($file_path, $delimiter) {
        $data_list = array();
        if (($handle = fopen($file_path, 'r')) != false) {
            while (($row = fgets($handle, 4096)) !== false) {
                if (substr($row, 0, 5) !== "first") {
                    $data_column = explode($delimiter, $row);
                    array_push($data_list, $data_column);
                }
            }
            fclose($handle);
        }
        return $data_list;
    }

    include("server.php");

    $data = csv_to_array("./users_list.csv", ",");

    foreach ($data as $user) {
        // Check if user is unique by first and last names
        $user_check_query = "SELECT * FROM user WHERE first_name='$user[0]' or last_name='$user[1]' LIMIT 1";

        $result = mysqli_query($db, $user_check_query);
        $user_exist = mysqli_fetch_assoc($result);

        if ($user_exist) {
            echo "\nError! User {$user[0]} {$user[1]} already exists. Please try again.\n";
        } else {
            $query = "INSERT INTO user (first_name, last_name, email, phone_number_1, phone_number_2, comment) VALUES ('$user[0]', '$user[1]', '$user[2]', '$user[3]', '$user[4]', '$user[5]')";
            if (mysqli_query($db, $query)) {
                echo "\n*** New user {$user[0]} {$user[1]} has been registered successfully! ***\n";
            } else {
                echo "\nError registering user: ", mysqli_error($db), "\n";
            }
        }
    }