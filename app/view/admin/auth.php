<?php
// Number of tries
$maxConnection = SettingManager::findByKey("maxConnection")->getValue();
if (!isset($_SESSION["connection"])) {
    $_SESSION["connection"] = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $hashedPassword = SettingManager::findByKey("password")->getValue();

    // Correct password
    if (password_verify($password, $hashedPassword)) {
        $_SESSION["auth"] = true;
        header("Location: list");
    }

    // Error passwword
    else {
        $_SESSION["connection"]++;
        echo '<p id="info">' . LANGUAGE["passwordIncorrect"] . '</p>';
    }
}

// Form is only accessible if the max of trying is not reached
if ($_SESSION["connection"] < $maxConnection) {
?>

    <form class="containerCentered" method="POST">

        <div class="formLine">
            <div class="formCase">
                <label for="password"><?php echo LANGUAGE["password"]; ?></label>
                <input id="password" name="password" type="password" required>
            </div>
        </div>

        <input class="button" value="<?php echo LANGUAGE["login"]; ?>" type="submit">
    </form>

<?php
} 

// Too much unsuccessful tries : no form
else {
    echo '<div class="containerCentered">';
    echo '<p id="message">' . LANGUAGE["connectionOff"] . '</p>';
    echo '</div>';
}
?>

<script>
    deleteInfo();
</script>