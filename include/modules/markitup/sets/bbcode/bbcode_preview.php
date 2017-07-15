<?php
require ("include/modules/nbbc/nbbc.php");
$bbcode = new BBCode;
print $bbcode->Parse($_POST["text"]);

?>