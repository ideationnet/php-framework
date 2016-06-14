<?php
ob_start();
include 'public/index.php';
$output = ob_get_clean();
echo strpos($output, "Hello World!"), PHP_EOL;
