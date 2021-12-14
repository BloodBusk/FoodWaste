<?php

// logs out user by destroying current session, redirects to index page
session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();