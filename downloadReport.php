<?php

$file = "Not ready yet.txt";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, "I'm not ready yet! please talk to Ron to fix this");
fclose($txt);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);
 