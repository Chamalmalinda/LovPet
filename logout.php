<?php
// Session start කරලා destroy කරනවා
session_start();
session_unset();    // All session variables clear කරනවා
session_destroy();  // Session එක completely destroy කරනවා

// Redirect to homepage
header("Location: index.php");
exit(); // Script එක stop කරනවා
?>