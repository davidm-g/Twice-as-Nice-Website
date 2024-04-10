<?php

  session_start();                                         // starts the session
  session_destroy();
  header('Location: ' . $_SERVER['HTTP_REFERER']);         // redirect to the page we came from
?>