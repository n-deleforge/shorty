<?php
$redirectionList = RedirectionManager::getList();
$nbRedirections = count($redirectionList);

if (isset($_SESSION["info"])) {
    echo '<p id="info">' . $_SESSION["info"] . '</p>';
    unset($_SESSION["info"]);
}

// If there are no redirections yet
if (!$redirectionList) {
    echo '<div class="containerCentered">';
    echo '<p id="message">' . LANGUAGE["listEmpty"] . '</p>';
    echo '</div>';
} 

// List all redirections
else {
?>

    <div class="table">
        <div class="line">
            <div class="case tableTitle center"><?php echo LANGUAGE["keyword"]; ?></div>
            <div class="case tableTitle center"><?php echo LANGUAGE["redirection"]; ?></div>
            <div class="case tableTitle center"><?php echo LANGUAGE["listActions"]; ?></div>
        </div>

        <?php
        foreach ($redirectionList as $redirection) {
            $link = HOME_URL . 'r/' . $redirection->getKey();

            echo '<div class="line">';
            echo '<div class="case center">' . $redirection->getKey() . '</div>';
            echo '<div class="case center">' . $redirection->getUrl() . '</div>';
            echo '<div class="case center"><a class="clipboard" data="' . $link . '"><i class="fas fa-clone"></i></a> <a href="modify-' . $redirection->getId() . '"><i class="fas fa-edit"></i></a> <a href="delete-' . $redirection->getId() . '"><i class="fas fa-trash-alt"></i></a></div>';
            echo '</div>';
        }
        ?>

    </div>
    <div class="void"></div>

<?php
}
?>