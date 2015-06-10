<?php

$g_link = mysql_connect( 'localhost', 'root', '') or die('Could not connect to server.' );
        mysql_select_db('books4us', $g_link) or die('Could not select database.');
?>