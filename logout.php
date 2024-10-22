<?php
session_start();
session_destroy();
header('Location: dashboard.php?message=logout_success');
exit();
