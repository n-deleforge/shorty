<?php
// Get the object
$redirection = (int)$_GET["b"];
$object = RedirectionManager::findById($redirection);

// Delete it and redirect to the list
RedirectionManager::delete($object);
$_SESSION["info"] = LANGUAGE["deleted"];
header('Location: list');
