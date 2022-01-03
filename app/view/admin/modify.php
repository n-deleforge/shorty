<?php
// Get the object
$get = (int)$_GET["b"];
$object = RedirectionManager::findById($get);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = 0;
    $listMessages = [];

    // Keyword checks
    $key = htmlspecialchars($_POST['key']);
    if (!preg_match("/^[a-z]{1,20}$/", $key) || empty($key) || $key === null) {
        $errors++;
        array_push($listMessages, LANGUAGE["keywordCheck"]);
    }

    // URL checks
    $url = trim(htmlspecialchars($_POST["url"]));
    $url = filter_var($url, FILTER_VALIDATE_URL);
    if ($url === false || empty($url) || $url === null) {
        $errors++;
        array_push($listMessages, LANGUAGE["urlCheck"]);
    }

    // If there are no errors
    if ($errors === 0) {
        $redirection = new Redirection($_POST);
        RedirectionManager::update($redirection);
        echo '<p id="info">' . LANGUAGE["modified"] . '</p>';
    }

    // If there are errors
    else {
        echo '<p id="info">';
        foreach ($listMessages as $message) echo $message . "<br >";
        echo '</p>';
    }
}
?>

<form class="containerCentered" method="POST">
<input name="id" type="hidden" value="<?php echo $object->getId(); ?>">

    <div class="formLine">
        <div class="formCase">
            <label for="key"><?php echo LANGUAGE["keyword"]; ?></label>
            <input id="key" name="key" type="text" 
                pattern="^[a-z]{1,20}$" minlenght="1" maxlength="20" class="needRegex" 
                value="<?php echo $object->getKey(); ?>" placeholder="duck" required>
        </div>
    </div>

    <div class="formLine">
        <div class="formCase">
            <label for="url"><?php echo LANGUAGE["redirection"]; ?></label>
            <input id="url" name="url" type="url" 
                pattern="^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?" class="needRegex" 
                value="<?php echo $object->getUrl(); ?>" placeholder="https://duckduckgo.com/" required>
        </div>
    </div>

    <input class="button" value="<?php echo LANGUAGE["modify"]; ?>" type="submit">
</form>