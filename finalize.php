<?php

$old_path = getcwd();
chdir('/home/alexandre.mbm/pwc');
$output = shell_exec('./run.sh');
chdir($old_path);
echo "<pre>\n";
print_r(utf8_decode($output));
echo "</pre>";

?>
