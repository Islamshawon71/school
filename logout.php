<?php
  session_start();
  unset($_SESSION['enpass'.$_SESSION['enfn']]);
  unset($_SESSION['enuser'.$_SESSION['enfn']]);
  unset($_SESSION['enfn']);
  header("Location:index.php?logout=1");
?>