<?php
session_start();
session_destroy();
header('Location: ../View/HTML/HomePage.php');
