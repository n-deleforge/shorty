<?php
// Load config
require("data/config.php");

// Settings
$password = "admin"; // it can be modified later in the application
$language = "english"; // available : english or french | it can be modified later in the application
$database = "sqlite3"; // available : sqlite3 only
$server = "apache"; // available : apache only

// ====================
// ==== GENERATING DATA

$errors = 0;
$errorsMessage = [];
$defaultURL = str_replace("install.php", '', "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$pathDBFile = str_replace("data/", "", PATH_DB);

// ==================
// ==== CONFIG UPDATE

if (!defined("HOME_URL")) {
    // Opening file and content
    $configFile = fopen("data/config.php", "a+");
    $homeLink = "\n" . 'define("HOME_URL", "' . $defaultURL . '");';

    // Generating file
    $success = fwrite($configFile, $homeLink);
    if (!$success) {
        $errors++;
        array_push($errorsMessage, "Error during generating config file");
    }
}

// ==============
// ==== DATABASE

// Connection to the database
if (!file_exists(PATH_DB)) {
    new SQLite3(PATH_DB);
}

require(PATH_MODEL . "DbConnect.Class.php");
DbConnect::init();
$db = DbConnect::getDb();

// Database generation
try {
    $query = "CREATE TABLE IF NOT EXISTS 'setting' (
    'id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
    'key' VARCHAR (30) NOT NULL, 
    'value' TEXT NOT NULL
    );
                        
    CREATE TABLE IF NOT EXISTS 'redirection' (
        'id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
        'key' VARCHAR (30) NOT NULL, 
        'url' TEXT NOT NULL
    );
                                
    INSERT INTO setting ('key', 'value') VALUES ('language', '" . $language . "');
    INSERT INTO setting ('key', 'value') VALUES ('password', '" . password_hash($password, PASSWORD_DEFAULT) . "');
    INSERT INTO setting ('key', 'value') VALUES ('hideAdmin', 0);
    INSERT INTO setting ('key', 'value') VALUES ('maxConnection', 5);";
    $db->exec($query);
} catch (Exception $err) {
    $errors++;
    array_push($errorsMessage, "Error during generating database file");
}

// ==============
// ==== HTACCESS 

// Opening file and content
$htaccessFile = fopen(".htaccess", "w");
$htaccess = "# Prevent people to visit forbidden folders
Options +FollowSymlinks -Multiviews -Indexes
                        
# Error managing
ErrorDocument 404 {$defaultURL}error
                        
# Rewriting URL
RewriteEngine on
RewriteRule ^([^./]+)/([^./]+)$ index.php?a=$1&b=$2 [L]
RewriteRule ^([^./]+)-([^./]+)$ index.php?a=$1&b=$2 [L]
RewriteRule ^([^./]+)$ index.php?a=$1 [L]
                        
# Protect the database
<Files '{$pathDBFile}'>
    Order Allow,Deny
    Deny from all
</Files>";

// Generating file
$success = fwrite($htaccessFile, $htaccess);
if (!$success) {
    $errors++;
    array_push($errorsMessage, "Error during generating htacess file");
}

// ==========
// ==== DONE

// If no errors : deleting the install file and redirect to home
if ($errors == 0) {
    unlink("install.php");
    header("Location: home");
}

// If errors : display error messages
else {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shorty</title>
    </head>

    <body>

        <?php
        foreach ($errorsMessage as $message)
            echo "- " . $message . "<br />";
        ?>

    </body>
    </html>

<?php
}
?>