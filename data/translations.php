<?php
// ======================
// ============ LANGUAGE

define("LANGUAGE_AVAILABLE", ["english", "french"]);

// English
$english = [
    "homeError" => "An error has occured, the page you're looking for doesn't exist<br />or the redirection link is incorrect",
    "homeHello" => "Shorty is a free, personal and self-hosted<br />link reduction application.",
    "footer" => "Available on " . LINK_GITHUB . " - v" . APP_VERSION . " © 2021",

    "backHome" => "Back to home",
    "backAdmin" => "Back to admin panel",

    "headerHome" => "App home",
    "headerAdmin" => "Admin panel",
    "headerAdd" => "Add a redirection",
    "headerPassword" => "Change password",
    "headerSettings" => "Settings",
    "headerLogout" => "Logout",

    "listActions" => "Actions",
    "listEmpty" => "There are no redirections. Add one above !",
    'keyword' => "Keyword",
    "redirection" => "Redirection link",
    "add" => "Add",
    "added" => "Redirection added !",
    "deleted" => "Redirection deleted !",
    "modify" => "Modify",
    "modified" => "Redirection modified !",
    "keywordCheck" => "Keyword is not valid.",
    "urlCheck" => "URL is not valid.",

    "login" => "Login",
    "password" => "Password",
    "passwordConfirm" => "Password confirm",
    "passwordIncorrect" => "Password is not correct.",
    "passwordDifferent" => "The password and the confirmation are not identicals.",
    "passwordChanged" => "Password has been correctly modified.",
    "connectionOff" => "You've had too many failed connection attempts. Access is blocked for a few moments.",
    "update" => "Update",
    "language" => "App language",
    "yes" => "Yes",
    "no" => "No",
    "settingsChanged" => "Parameters updated.",
    "hideAdmin" => "Hide admin pannel",
    "maxConnection" => "Connection tries",
];

// French
$french = [
    "footer" => "Disponible sur " . LINK_GITHUB . " - v" . APP_VERSION . " © 2021",
    "homeError" => "Il est probable que le lien donné n'est pas correct<br />ou qu'une erreur s'est produite.",
    "homeHello" => "Shorty est une application gratuite, personnelle<br />et auto-hébergée de réduction de lien.",
    "error404" => "Il semblerait que la page que vous cherchez n'existe pas.",

    "backHome" => "Retour à l'accueil",
    "backAdmin" => "Retour au panneau d'admin.",

    "headerHome" => "Accueil de l'app.",
    "headerAdmin" => "Panneau d'admin.",
    "headerAdd" => "Ajouter une redirection",
    "headerPassword" => "Changer de mot de passe",
    "headerSettings" => "Paramètres",
    "headerLogout" => "Se déconnecter",

    "listActions" => "Actions",
    "listEmpty" => "Il n'y a pas de redirections. Ajoutez-en une au dessus !",
    'keyword' => "Mot-clé",
    "redirection" => "Lien de redirection",
    "add" => "Ajouter",
    "added" => "Redirection ajoutée !",
    "deleted" => "Redirection supprimée !",
    "modify" => "Modifier",
    "modified" => "Redirection modifiée !",
    "keywordCheck" => "Le mot-clé n'est pas valide.",
    "urlCheck" => "Le lien n'est pas valide.",

    "login" => "Connexion",
    "password" => "Mot de passe",
    "passwordIncorrect" => "Le mot de passe est incorrect.",
    "passwordDifferent" => "Le mot de passe et la confirmation ne sont pas identiques.",
    "passwordConfirm" => "Confirmation du mot de passe",
    "passwordChanged" => "Le mot de passe a été correctement modifié.",
    "connectionOff" => "Vous avez trop eu de tentatives de connexions ratées. L'accès est bloqué pour quelques instants.",
    "update" => "Mettre à jour",
    "language" => "Langue de l'app.",
    "yes" => "Oui",
    "no" => "Non",
    "settingsChanged" => "Mise à  jour des paramètres effectuée.",
    "hideAdmin" => "Cacher le panneau d'admin.",
    "maxConnection" => "Tentatives de connexion",
];