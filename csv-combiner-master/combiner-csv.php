<?php

#open/create combined.csv
$f = fopen($argv[4], 'a');

$clothing= substr($argv[2],2);
#read clothing.csv (third argument)
$file1 = fopen($clothing, 'r');
$header1=true;
#while csv still has lines, we insert them into our output csv f
while (($line = fgetcsv($file1)) !== FALSE) {
    #if this is the first line, make header
    if ($header1) {
        fputcsv($f, array($line[0],$line[1],"filename"));
        $header1=false;
    }
    #otherwise, insert line information and file name.
    #substring to remove the folder name prefix
    else fputcsv($f, array($line[0],$line[1],substr($clothing,9)));
}
#close clothing.csv
fclose($file1);

$accessories= substr($argv[1],2);
#read accessories.csv, similar approach as above (second argument)
$file2 = fopen($accessories, 'r');
$header2=true;
while (($line = fgetcsv($file2)) !== FALSE) {
    #insert accessories information and file name
    #if this is the first line, skip
    if ($header2){
        $header2=false;
    }
    #substring to remove the folder name prefix
    else fputcsv($f, array($line[0],$line[1],substr($accessories,9)));
}

#close accessories.csv
fclose($file2);

#close the output file
fclose($f);

?>