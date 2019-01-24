<?php

    include("server.php");

    // Get client information
    while (true) {
        echo "\n************ NEW USER REGISTRATION ************\n";
        include("get_user_info.php");

        // Check if user is unique by first and last names
        $user_check_query = "SELECT * FROM user WHERE first_name='$first_name' or last_name='$last_name' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            echo "\nError! User {$first_name} {$last_name} already exists. Please try again.\n";
        } else {
            $query = "INSERT INTO user (first_name, last_name, email, phone_number_1, phone_number_2, comment) VALUES ('$first_name', '$last_name', '$email', '$phone_number_1', '$phone_number_2', '$comment')";
            if (mysqli_query($db, $query)) {
                echo "\n*** New user {$first_name} {$last_name} has been registered successfully! ***\n";
                break;
            } else {
                echo "\nError registering user: ", mysqli_error($db), "\n";
            }
        }
    }