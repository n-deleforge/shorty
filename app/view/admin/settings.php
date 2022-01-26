<?php
    $currentLanguage = SettingManager::findByKey("language");
    $currentHideAdmin = SettingManager::findByKey("hideAdmin");
    $currentMaxConnection = SettingManager::findByKey("maxConnection");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Hide admin
        $newHideAdmin = (int) $_POST['hideAdmin'];
        if ($newHideAdmin === 0 || $newHideAdmin === 1) {
            $currentHideAdmin->setValue($newHideAdmin);
            SettingManager::update($currentHideAdmin);
        }

        // Max connection
        $newMaxConnection = (int) $_POST['maxConnection'];
        if ($newMaxConnection >= 1 && $newMaxConnection <= 10) {
            $currentMaxConnection->setValue($newMaxConnection);
            SettingManager::update($currentMaxConnection);
        }

        // Language
        $newLanguage = htmlspecialchars($_POST['language']);
        if ($currentLanguage->getValue() !== $newLanguage) header("refresh: 3");
        $currentLanguage->setValue($newLanguage);
        SettingManager::update($currentLanguage);

        echo '<p id="info">' . LANGUAGE["settingsChanged"] . '</p>';
    }
?>

<form class="containerCentered" method="POST">
    <div class="formLine">
        <div class="formCase">
            <label for="hideAdmin"><?php echo LANGUAGE["hideAdmin"]; ?></label>
            <select id="hideAdmin" name="hideAdmin" required>
                <option value="0" <?php if ((int) $currentHideAdmin->getValue() === 0) echo "selected" ?>><?php echo LANGUAGE["no"]; ?></option>
                <option value="1" <?php if ((int) $currentHideAdmin->getValue() === 1) echo "selected" ?>><?php echo LANGUAGE["yes"]; ?></option>
            </select>
        </div>
    </div>

    <div class="formLine">
        <div class="formCase">
            <label for="maxConnection"><?php echo LANGUAGE["maxConnection"]; ?></label>
            <input type="number" min="1" max="10" id="maxConnection" name="maxConnection" value="<?php echo (int) $currentMaxConnection->getValue(); ?>" required>
        </div>
    </div>

    <div class="formLine">
        <div class="formCase">
            <label for="language"><?php echo LANGUAGE["language"]; ?></label>
            <select id="language" name="language" required>
                <?php
                    foreach(LANGUAGE_AVAILABLE as $lang)
                        echo ($currentLanguage->getValue() == $lang) ? '<option value="' . $lang .'" selected>' . ucFirst($lang) . '</option>' : '<option value="' . $lang .'">' . ucFirst($lang) . '</option>';
                ?>
            </select>
        </div>
    </div>

    <input class="button" value="<?php echo LANGUAGE["update"]; ?>" type="submit">
</form>