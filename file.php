<?php 
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);

fclose($myfile);

$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
while(! feof($myfile)) {
    $line = fgets($myfile);
    echo $line. "<br>";
  }

fclose($myfile);
rename("newfile.txt","oldfile.txt");
echo copy("oldfile.txt","copyfile.txt");
echo unlink("oldfile.txt");


?>