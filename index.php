<?php
// =========================
// ============ INITIALISATION

// Load config
session_start();
spl_autoload_register("loadClass");
require("data/config.php");

// Installation check
if (!file_exists(PATH_DB)) {
    header("Location: install.php");
}

// Database connection and load language
DbConnect::init();
defineLanguage();

// =====================
// ============ ROUTING

$ROUTES = [
    // Public
    "home" => ["public", "home"],
    "error" => ["public", "error"],

    // Admin
    "auth" => ["admin", "auth"],
    "logout" => ["admin", "logout"],
    "list" => ["admin", "list"],
    "add" => ["admin", "add"],
    "modify" => ["admin", "modify"],
    "delete" => ["admin", "delete"],
    "password" => ["admin", "password"],
    "settings" => ["admin", "settings"]
];

// First case : redirection
if (isset($_GET["a"]) && $_GET["a"] === "r") {
    $nbErrors = 0;
    $redirectionList = RedirectionManager::getList();
    $nbRedirections = count($redirectionList);

    foreach ($redirectionList as $redirection) {
        // Either it's correct and the redirection is going on
        if (isset($_GET["b"]) && $_GET["b"] == $redirection->getKey()) {
            header("Location: " . $redirection->getUrl());
        }

        // Either the error count increases
        else {
            $nbErrors++;
        }
    };

    // No correlations : display error page
    if ($nbErrors === $nbRedirections) {
        header("Location: ". HOME_URL . "error");
    }
}

// Second case : display page
elseif (isset($_GET["a"]) && $_GET["a"] !== "r") {
    // Check if the page existed in the routing
    @$check = in_array($ROUTES[$_GET["a"]], $ROUTES);
    ($check) ? loadPage($ROUTES[$_GET["a"]]) : loadPage($ROUTES["error"]);
}

// Final case : no page loaded
else {
    loadPage($ROUTES["home"]);
}

// =======================
// ============ FUNCTIONS

/**
 * Redirect the user to the login page if not logged
 *
 * @return void
 */

function checkAuth() {
    if (DIRECTORY === "admin") {
        if (PAGENAME === "auth" && isset($_SESSION["auth"])) {
            header("Location: home");
        }

        if (PAGENAME !== "auth" && !isset($_SESSION["auth"])) {
            header("Location: auth");
        }
    }
}

/**
 * Define the language of the application
 *
 * @return void
 */

function defineLanguage() {
    // Load languages file
    require("data/translations.php");
    $lang = SettingManager::findByKey("language")->getValue();

    // Define the used language
    if ($lang === "french") {
        $arr = $french;
    }
    else {
        $arr = $english;
    }

    define("LANGUAGE", $arr);
}

/**
 * Load class when it's needed / called
 *
 * @param string $class name of the class
 * @return void
 */

function loadClass($class) {
    if (file_exists(PATH_CONTROLLER . $class . ".Class.php")) {
        require PATH_CONTROLLER . $class . ".Class.php";
    }

    if (file_exists(PATH_MODEL . $class . ".Class.php")) {
        require PATH_MODEL . $class . ".Class.php";
    }
}

/**
 * Load a page, calling the header, the content and the footer
 *
 * @param array $content [directory, name of the file]
 * @return void
 */

function loadPage($page) {
    // Define some constants and check auth
    define("DIRECTORY", $page[0]);
    define("PAGENAME", $page[1]);
    checkAuth();

    // Display page loaded
    require PATH_VIEW . 'inc/header.php';
    require PATH_VIEW . DIRECTORY . '/' . PAGENAME . '.php';
    require PATH_VIEW . 'inc/footer.php';
}
