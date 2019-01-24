<?php

    while (true) {
        echo "First name: ";
        $first_name = readline();
        if (!preg_match("/^[\p{L}]+$/u", $first_name)) {
            echo "Error! Please enter a valid human name (only letters allowed).\n";
        } else {
            break;
        }
    }
    while (true) {
        echo "Last name: ";
        $last_name = readline();
        if (!preg_match("/^[\p{L}]+$/u", $last_name)) {
            echo "Error! Please enter a valid human surname (only letters allowed).\n";
        } else {
            break;
        }
    }
    while (true) {
        echo "Email: ";
        $email = readline();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Error! Please enter a valid email.\n";
        } else {
            break;
        }
    }
    while (true) {
        echo "Phone number 1: ";
        $phone_number_1 = readline();
        if (!preg_match("/^(\+370|00370|8)[\- ]?\d{3}[\- ]?\d{2}[\- ]?\d{3}$/", $phone_number_1)) {
            echo "Error! Please enter a valid lithuanian phone number.\n";
        } else {
            break;
        }
    }
    while (true) {
        echo "Phone number 2: ";
        $phone_number_2 = readline();
        if (!preg_match("/^(\+370|00370|8)[\- ]?\d{3}[\- ]?\d{2}[\- ]?\d{3}$/", $phone_number_2)) {
            echo "Error! Please enter a valid lithuanian phone number.\n";
        } else {
            break;
        }
    }
    while (true) {
        echo "Your comment: ";
        $comment = readline();
        if (empty(trim($comment))) {
            echo "Error! Please enter some comment.\n";
        } else {
            break;
        }
    }