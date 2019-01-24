<?php
    
    include("server.php");

    // Parses CSV file as key/val dictionary
    $csv_arr = array_map("str_getcsv", file($file_name));
    array_walk($csv_arr, function(&$a) use ($csv_arr) {
        $a = array_combine($csv_arr[0], $a);
    });
    array_shift($csv_arr); // Remove column header

    foreach ($csv_arr as $user) {
        // Check if user is unique by first and last names
        $user_check_query = "SELECT * FROM user WHERE first_name='$user[first_name]' and last_name='$user[last_name]' LIMIT 1";

        $result = mysqli_query($db, $user_check_query);
        $user_exists = mysqli_fetch_assoc($result);

        // Add user to database
        if ($user_exists) {
            echo "\nError! User {$user['first_name']} {$user['last_name']} already exists. Please try again.\n";
        } else {
            $query = "INSERT INTO user (first_name, last_name, email, phone_number_1, phone_number_2, comment) VALUES ('$user[first_name]', '$user[last_name]', '$user[email]', '$user[phone_number_1]', '$user[phone_number_2]', '$user[comment]')";
            if (mysqli_query($db, $query)) {
                echo "\n*** New user {$user["first_name"]} {$user["last_name"]} has been registered successfully! ***\n";
            } else {
                echo "\nError registering user: ", mysqli_error($db), "\n";
            }
        }
    }