<?php

    include("server.php");
    $run = true;

    while ($run) {
        echo "\n************ USER EDITING ************\n";
        echo "Which user you want to edit?\n";

        // Get user list from DB
        $all_users = "SELECT * FROM user";
        $result = mysqli_query($db, $all_users);
        $users_list = array();

        // Print user list
        while ($user = mysqli_fetch_array($result)) {
            echo "ID:", $user["id"], " ", $user["first_name"], " ", $user["last_name"], "\n";
            array_push($users_list, $user["id"]);
        }

        // Ask for user ID to edit
        echo "\nEnter ID of user to edit: ";
        while ($run) {
            $edit_user_id = readline();
            if (strtolower(trim($edit_user_id)) === "x") {
                $run = false;
                break;
            }
            if (!in_array($edit_user_id, $users_list, true)) {
                echo "Error! Wrong user ID. Please try again or enter [X] to abort: ";
            } else {
                break;
            }
        }
        if (!$run) { break; }

        // Edit user in DB
        echo "Are you sure you want to edit user? This action is irreversible. [Y] or [N]? ";
        if (strtolower(trim(readline())) == "y") {
            include("get_user_info.php");
            $query = "UPDATE user SET first_nam='$first_name', last_name='$last_name', email='$email', phone_number_1='$phone_number_1', phone_number_2='$phone_number_2', comment='$comment' WHERE id='$edit_user_id'";
            if (mysqli_query($db, $query)) {
                echo "\n*** User {$edit_user_id} is successfully edited! ***\n";
            } else {
                echo "\nError editing user: ", mysqli_error($db), "\n";
            }
            $run = false;
            break;
        } else {
            break;
        }
    }

