<?php
    /* 
     * session_start();
     * Starting a new session before clearing it
     * assures you all $_SESSION vars are cleared 
     * correctly, but it's not strictly necessary.
     */
    // Start the session
    session_start();
    session_destroy();
    session_unset();
    header('Location: index.php'); 
    /* Or whatever document you want to show afterwards */
?>