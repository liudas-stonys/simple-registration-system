<?php

    session_start();

    echo "Welcome to SRS - the best Simple Registration System!\n";

    while (true) {
        echo "\nWhat action would you like to take:\n";
        echo "[R]egister new user\n";
        echo "[E]dit existing user\n";
        echo "[D]elete user\n";
        echo "[I]mport CSV\n";
        echo "E[X]it app\n\n";

        echo "Enter corresponding letter from the brackets: ";
        $action = strtolower(trim(readline()));

        switch ($action) {
            case "r":
                include("register_user.php");
                break;
            case "e":
                include("edit_user.php");
                break;
            case "d":
                include("delete_user.php");
                break;
            case "i":
                include("import_csv.php");
                break;
            case "x":
                session_destroy();
                echo "\nThank you for using the best Simple Registration System! Have a nice day! :)\n";
                exit();
            default:
                echo "\nWrong menu entry. Please, try again.\n";
                break;
        }
    }