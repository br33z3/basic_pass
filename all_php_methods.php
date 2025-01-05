<?php
$command = "ls -l";

// 1. exec()
echo "1. exec()\n";
$output = [];
$return_var = 0;
exec($command, $output, $return_var);
echo "Output:\n";
print_r($output);
echo "Return value: $return_var\n\n";

// 2. shell_exec()
echo "2. shell_exec()\n";
$output = shell_exec($command);
echo "Output:\n";
echo $output . "\n\n";

// 3. system()
echo "3. system()\n";
$return_value = system($command);
echo "\nReturn value: $return_value\n\n";

// 4. passthru()
echo "4. passthru()\n";
passthru($command);
echo "\n\n";

// 5. popen()
echo "5. popen()\n";
$handle = popen($command, "r");
if ($handle) {
    while (!feof($handle)) {
        echo fgets($handle);
    }
    pclose($handle);
}
echo "\n\n";

// 6. proc_open()
echo "6. proc_open()\n";
$descriptorspec = [
    0 => ["pipe", "r"],  // stdin
    1 => ["pipe", "w"],  // stdout
    2 => ["pipe", "w"],  // stderr
];

$process = proc_open($command, $descriptorspec, $pipes);
if (is_resource($process)) {
    echo "Output:\n";
    while ($line = fgets($pipes[1])) {
        echo $line;
    }
    fclose($pipes[1]);
    proc_close($process);
}
echo "\n";

?>
