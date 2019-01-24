<?php

    include("server.php");
    $run = true;

    while ($run) {
        echo "\n************ USER DELETION ************\n";
        echo "Which user you want to delete?\n";

        // Get user list from DB
        $all_users = "SELECT * FROM user";
        $result = mysqli_query($db, $all_users);
        $users_list = array();

        // Print user list
        while ($user = mysqli_fetch_array($result)) {
            echo "ID:", $user["id"], " ", $user["first_name"], " ", $user["last_name"], "\n";
            array_push($users_list, $user["id"]);
        }

        // Ask for user ID to delete
        echo "\nEnter ID of user to delete: ";
        while (true) {
            $delete_user_id = readline();
            if (strtolower(trim($delete_user_id)) === "x") {
                $run = false;
                break;
            }
            if (!in_array($delete_user_id, $users_list, true)) {
                echo "Error! Wrong user ID. Please try again or enter [X] to abort: ";
            } else {
                break;
            }
        }
        if (!$run) { break; }

        // Delete user from DB
        echo "Are you sure you want to delete? This action is irreversible. [Y] or [N]? ";
        if (strtolower(trim(readline())) == "y") {
            $delete_user = "DELETE FROM user WHERE id='$delete_user_id'";
            mysqli_query($db, $delete_user);
            echo "\n*** User with ID:{$delete_user_id} is successfully deleted! ***\n";
            break;
        } else {
            break;
        }
    }
