<?php

//delete everything from the session
session_start();
session_unset();
session_destroy();

Header("Location: ../login.php?logout=success");
