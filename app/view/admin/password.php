<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPass = htmlspecialchars($_POST["password"]);
    $confirmation = htmlspecialchars($_POST["confirm"]);

    // Correct
    if ($newPass === $confirmation) {
        $oldPass = SettingManager::findByKey("password");
        $oldPass->setValue(password_hash($newPass, PASSWORD_DEFAULT));
        SettingManager::update($oldPass);

        echo '<p id="info">' . LANGUAGE["passwordChanged"] . '</p>';
    }

    // Error
    else {
        echo '<p id="info">' . LANGUAGE["passwordDifferent"] . '</p>';
    }
}
?>

<form class="containerCentered" method="POST">

    <div class="formLine">
        <div class="formCase">
            <label for="password"><?php echo LANGUAGE["password"]; ?></label>
            <input id="password" name="password" type="password" required>
        </div>
    </div>

    <div class="formLine">
        <div class="formCase">
            <label for="confirm"><?php echo LANGUAGE["passwordConfirm"]; ?></label>
            <input id="confirm" name="confirm" type="password" required>
        </div>
    </div>

    <input class="button" value="<?php echo LANGUAGE["update"]; ?>" type="submit">
</form>