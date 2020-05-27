<!DOCTYPE html>
<html lang="en">

<?php
$prefs = file_get_contents('storage/settings.json');
$prefs = json_decode($prefs, true);
$prefs = $prefs['timezone'];
date_default_timezone_set($prefs);
?>

<head>
    <title>Tasks</title>

    <link rel="icon" type="image/svg" href="assets/logo-dark.svg">
    <meta name="theme-color" content="#000000" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- PT Sans (full family) --> <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- Material Icons (Sharp Theme) --> <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
 
    <!-- jQuery UI Default Theme --> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <!-- jQuery UI 'Base' Theme --> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/theme.min.css">

    <!-- Stylesheet --> <link href="/static/style.css" rel="stylesheet">

    <!-- jQuery --> <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- jQuery UI --> <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Tooltips --> <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Tooltip Improvements --> <script src="https://unpkg.com/tippy.js@6"></script>
    <!-- Tooltip Animation --> <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/shift-away.css">
    <!-- Tooltip Theme --> <link rel="stylesheet" href="/static/tooltip.css">
    
    <!-- Datepickr --> <script src="https://rawcdn.githack.com/RapidtSoftware/DatePickr/f4e1da62bff1df9bdb849622efca59efb0152a69/dist/js/datepickr.min.js"></script>
    <!-- Datepickr Theme --> <link rel="stylesheet" href="https://rawcdn.githack.com/RapidtSoftware/DatePickr/f4e1da62bff1df9bdb849622efca59efb0152a69/dist/css/datepickr.min.css">

    <!-- JavaScript --> <script src="/static/javascript.js"></script>
</head>

<body>

    <header id="header">
        <div class="header-inner">
            <div class="header-left">
                <a href="/">
                    <img class="logo" src="/assets/logo-dark.svg">
                </a>
                <i class="material-icons-sharp logo menu">menu</i>
            </div>
            <div class="header-center">
                <form>
                    <input type="text" name="search" class="search" placeholder="Search...">
                </form>
            </div>
            <div class="header-right">
                <img class="avatar" data-tooltip-content="#account-menu" src="/assets/avatar.jpeg">
                <div id="account-menu">
                    <ul>
                        <li><a href="/preferences.php"><i class="material-icons-sharp">settings</i>Preferences</a></li>
                        <li><a href=""><i class="material-icons-sharp">bar_chart</i>Statistics</a></li>
                        <li><a href=""><i class="material-icons-sharp">exit_to_app</i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>