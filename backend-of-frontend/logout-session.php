<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Redirect to index
header("Location: ../");
exit();
?>