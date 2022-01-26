<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorty</title>

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/fontawesome/all.min.css">
    <script src="assets/js/main.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="assets/favicon/favicon.ico">
</head>

<body>
    <div id="app">
        <div id="topBar">
            <header>
                <div id="logo"></div>
                <a href="home" id="title">Shorty</a>
            </header>

            <div id="settings">
                <?php
                // Check if the admin link must be hidden
                $hideAdmin = SettingManager::findByKey("hideAdmin")->getValue();

                // Public links 
                if (DIRECTORY === "public" && PAGENAME === "home" && $hideAdmin === "0")
                    echo '<a href="list"><i class="fas fa-user-cog"></i> ' . LANGUAGE["headerAdmin"] . '</a>';

                // Admin links
                 if (DIRECTORY === "admin") {
                    // On every page, except the login page
                    if (PAGENAME !== "auth")
                        // Display either back button or add redirection in the bottom right corner
                        echo (PAGENAME === "list") ? '<a class="button floatButton" href="add"><i class="fas fa-plus"></i></a>' : '<a class="button floatButton" href="list"><i class="fas fa-arrow-left"></i></a>';

                    // If connected, display all header links
                    if (isset($_SESSION["auth"])) {
                        echo '<a href="settings"><i class="fas fa-toolbox"></i> ' . LANGUAGE["headerSettings"] . '</a>';
                        echo '<a href="password"><i class="fas fa-key"></i> ' . LANGUAGE["headerPassword"] . '</a>';
                        echo '<a href="logout"><i class="fas fa-sign-out-alt"></i> ' . LANGUAGE["headerLogout"] . '</a>';
                    }
                }
                ?>
            </div>
        </div>