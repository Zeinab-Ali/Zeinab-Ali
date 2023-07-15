<?php

use App\Database\Models\User;

ob_start();
session_start();

require_once "vendor/autoload.php";

if (isset($_COOKIE['remember_me'])) {
    $user = new User;
    $user->setEmail($_COOKIE['remember_me']);
    $authenticatedUser = $user->getUserByEmail()->get_result()->fetch_object();
    $_SESSION['user'] = $authenticatedUser;
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <?= $links ?? "" ?>
    <style>
        
        .rating-stars {
            display: block;
            width: 50vmin;
            padding: 1.75vmin 10vmin 2vmin 3vmin;
            background: linear-gradient(90deg, #ffffff90 40vmin, #fff0 40vmin 100%);
            border-radius: 5vmin;
            position: relative;
        }

        .rating-counter {
            font-size: 5.5vmin;
            font-family: Arial, Helvetica, serif;
            color: #9aacc6;
            width: 10vmin;
            text-align: center;
            background: #0006;
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            border-radius: 0 5vmin 5vmin 0;
            line-height: 10vmin;
        }

        .rating-counter:before {
            content: "0";
            transition: all 0.25s ease 0s;
        }



        input[type="radio"] {
            display: none;
        }

        .lab {
            width: 5vmin;
            height: 5vmin;
            background: #000b;
            display: inline-flex;
            cursor: pointer;
            margin: 0.5vmin 0.65vmin;
            transition: all 1s ease 0s;
            clip-path: polygon(50% 0%, 66% 32%, 100% 38%, 78% 64%, 83% 100%, 50% 83%, 17% 100%, 22% 64%, 0 38%, 34% 32%);
        }

        .lab[for=rs0] {
            display: none;
        }

        .lab:before {
            width: 90%;
            height: 90%;
            content: "";
            background: orange;
            z-index: -1;
            display: block;
            margin-left: 5%;
            margin-top: 5%;
            clip-path: polygon(50% 0%, 66% 32%, 100% 38%, 78% 64%, 83% 100%, 50% 83%, 17% 100%, 22% 64%, 0 38%, 34% 32%);
            background: linear-gradient(90deg, yellow, orange 30% 50%, #184580 50%, 70%, #173a75 100%);
            background-size: 205% 100%;
            background-position: 0 0;
        }

        .lab:hover:before {
            transition: all 0.25s ease 0s;
        }

        input[type="radio"]:checked+label~label:before {
            background-position: 100% 0;
            transition: all 0.25s ease 0s;
        }

        input[type="radio"]:checked+label~label:hover:before {
            background-position: 0% 0
        }





        #rs1:checked~.rating-counter:before {
            content: "1";
        }

        #rs2:checked~.rating-counter:before {
            content: "2";
        }

        #rs3:checked~.rating-counter:before {
            content: "3";
        }

        #rs4:checked~.rating-counter:before {
            content: "4";
        }

        #rs5:checked~.rating-counter:before {
            content: "5";
        }

        .lab+input[type="radio"]:checked~.rating-counter:before {
            color: #ffab00 !important;
            transition: all 0.25s ease 0s;
        }





        .lab:hover~.rating-counter:before {
            color: #9aacc6 !important;
            transition: all 0.5s ease 0s;
            animation: pulse 1s ease 0s infinite;
        }

        @keyframes pulse {
            50% {
                font-size: 6.25vmin;
            }
        }

        .lab[for=rs1]:hover~.rating-counter:before {
            content: "1" !important;
        }

        .lab[for=rs2]:hover~.rating-counter:before {
            content: "2" !important;
        }

        .lab[for=rs3]:hover~.rating-counter:before {
            content: "3" !important;
        }

        .lab[for=rs4]:hover~.rating-counter:before {
            content: "4" !important;
        }

        .lab[for=rs5]:hover~.rating-counter:before {
            content: "5" !important;
        }


        input[type="radio"]:checked:hover~.rating-counter:before {
            animation: none !important;
            color: #ffab00 !important;
        }






    </style>
</head>

<body>