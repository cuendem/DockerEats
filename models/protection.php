<?php
if (!isset($_SESSION['username'])) {
    header('Location:/account/signin');
}