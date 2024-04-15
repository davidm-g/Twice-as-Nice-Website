<?php

  session_start();                                         // starts the session
  session_destroy();
  header('Location: index.php');         // redirect to the page we came from
?>