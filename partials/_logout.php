<?php
session_start();

echo "Logging you out ! PLease wait .";

session_destroy();
header("Location: /forumapp");

?>