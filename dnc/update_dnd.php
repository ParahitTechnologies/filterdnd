<?php

/*
 *  Initializing the script
 */
session_start();
error_reporting(0);
ini_set("display_errors", "On");
ini_set("memory_limit", "2048M");

/*
 *  Log file for the working.
 */
$file = fopen("responseText.txt", "a");
fwrite($file, "[" . date('d/m/Y H:i:s') . "]");
fwrite($file, "\n\nStarting the process for filering of file " . $argv[3] . ".");

$start = round(microtime(true) * 1000);

/*
 * Getting Arguments from exec command
 */
$f = $argv[1];
$id = $argv[2];
$fn = explode(".", $argv[3]);

/*
 * Connection with database required.
 */
require_once("../common/connection.php");

/*
 * Initalizing Variables.
 */
$dnd_data = array();
$non_dnd = array();
$invalid_data = array();
$tag = $fn[0];
$path = $ZIP_DIR;
$max_array_size = 20000;

/*
 * Reading the file in a 2-D array.
 */
$startTime = round(microtime(true) * 1000);
fwrite($file, "\nReading of file started. At: " . $startTime);

$csv = array_map('str_getcsv', file($f));

/*
 * Converting the 2-D Array into 1-D Array
 */
foreach ($csv as $key => $value) {
    $csv[$key] = $value[0];
}

fwrite($file, "\nReading of file completed. In: " . (round(microtime(true) * 1000) - $startTime) . " ms");

/*
 * function to change the file array in
 * 2-D Array in an specific format of
 * prefix and their corresponsding number.
 * like 
 * Array(
 *  [9710] => Array ( 9711234567, 9712345678.....)
 *  [9711] => Array ( 9711234567, 9712345678.....)
 *  .....
 *  [8440] => Array ( 8441234567, 8442345678.....)
 *  .....
 * )
 */

function format_array_3digit_wise($array) {
    global $invalid_data;
    global $max_array_size;
    $return = array();
    $arr = array();

    foreach ($array as $v) {
        if (!preg_match('/^[0-9]{10}$/', $v)) {
            array_push($invalid_data, $v);
        } else {
            $str = substr($v, 0, 3);
            $return[$str][] = $v;
        }
    }

    foreach ($return as $prefix => $v) {
        $sizeofArray = sizeof($v);
        if ($max_array_size < $sizeofArray) {
            $chunk = array_chunk($v, $max_array_size);

            $length = ceil($sizeofArray / $max_array_size);

            for ($i = 0; $i < $length; $i++) {
                $new_prefix = $prefix . '' . $i;
                $return[$new_prefix] = $chunk[$i];
            }
            unset($return[$prefix]);
        }
    }

    return $return;
}

$startTime = round(microtime(true) * 1000);
fwrite($file, "\nProcessing of file started. At: " . $startTime);

$csv = format_array_3digit_wise($csv);
/*
 * foreach ($csv as $v) {
 * fwrite($file, "\nSizeof: " . sizeof($v) . " \nValues: " . implode(",", $v));
 * }
 */
fwrite($file, "\nProcessing of file data done. At: " . (round(microtime(true) * 1000) - $startTime) . " ms");

/*
 * Getting all the invalid number in the array
 * whose length is not equal to 10 and writing
 * them in a file.
 */
$invalid_data = array_filter($invalid_data);
$myFile3 = $path . $tag . "-error.csv";
$myFileLocal3 = $tag . "-error.csv";
$fh = fopen($myFile3, 'w');
fwrite($fh, implode("\n", $invalid_data));
fclose($fh);
/*
 * file closed for invalid numbers.
 */

$pids = array();
$i = 0;
$counter = 0;

/*
 * File opened for Non Dnd numbers.
 */
$myFile1 = $path . $tag . "-non_dnd.csv";
$myFileLocal1 = $tag . "-non_dnd.csv";
$fh1 = fopen($myFile1, 'a');

/*
 * File opened for dnd numbers.
 */
$myFile2 = $path . $tag . "-dnd.csv";
$myFileLocal2 = $tag . "-dnd.csv";
$fh2 = fopen($myFile2, 'a');

foreach ($csv as $prefix => $v) {
    /*
     *     fwrite($file, "\n Prefix: " . $prefix . "\n");
     * fwrite($file, "\n Values: " . implode(",", $v) . "\n");
     */
    $pid = pcntl_fork();

    /*
     * Creating process for each and every element of the array.
     */
    if ($pid == -1) {
        die("Error: impossible to process further\n");
    } else if ($pid) {
        $pids[] = $pid;
    } else {
        $startTimeClient = round(microtime(true) * 1000);
        /*
         *         fwrite($file, "\nProcessing the data for number " . $i . ". At: " . $startTimeClient);
         */

        $DB_NAME_CLIENT = "filterdnc";
        $DB_USER_CLIENT = "root";
        $DB_PASS_CLIENT = "";
        $DB_HOST_CLIENT = "localhost";

        $mysql_link_client = mysql_connect($DB_HOST_CLIENT, $DB_USER_CLIENT, $DB_PASS_CLIENT, true) or die(header("location:505.php"));
        mysql_select_db($DB_NAME_CLIENT, $mysql_link_client) or die("DB error");

        $query_client = "SELECT f2, f4 FROM dnd.dnd WHERE f2 IN (" . implode(",", $v) . ") AND prefix = '" . substr($prefix, 0, 3) . "'";
        $result_client = mysql_query($query_client) or die(mysql_error());
        if (mysql_num_rows($result_client) > 0) {
            while ($row = mysql_fetch_assoc($result_client)) {
                if ($row['f4'] == 'A') {
                    /*
                     * Writing in the opened dnd file.
                     */
                    fwrite($fh2, $row['f2'] . "\n");
                    $key = array_search($row['f2'], $v);
                    unset($v[$key]);
                }
            }

            foreach ($v as $f) {
                /*
                 * Writing in the opened non-dnd file
                 */
                fwrite($fh1, $f . "\n");
            }
        }
        mysql_close($mysql_link_client);
        /*
         *         fwrite($file, "\nData processed for number " . $i . ". In: " . (round(microtime(true) * 1000) - $startTimeClient . " ms"));
         */
        exit(0);
    }
    $i++;
}

/*
 * closing both dnd and non dnd files.
 */
fclose($fh1);
fclose($fh2);

foreach ($pids as $pid) {
    pcntl_waitpid($pid, $status);
}

$startTime = round(microtime(true) * 1000);
fwrite($file, "\nZipping the file started. At: " . $startTime);

$zip = new ZipArchive();
$filename = $path . $tag . ".zip";

if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
    exit("cannot open <$filename>\n");
}

/*
 * Creating a zip file for the all 3 files.
 */
$zip->addFile($myFile1, $myFileLocal1);
$zip->addFile($myFile2, $myFileLocal2);
$zip->addFile($myFile3, $myFileLocal3);

echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();

/*
 * Delete the file after zip created.
 */
unlink($myFile1);
unlink($myFile2);
unlink($myFile3);
fwrite($file, "\nZipping the file ended. In: " . (round(microtime(true) * 1000) - $startTime) . " ms");

$conn = mysql_connect($DB_HOST, $DB_USER, $DB_PASS, true) or die(header("location:505.php"));
mysql_select_db($DB_NAME, $conn) or die("DB error");

$query = "update upload_file set f_status=0,dnc_f_name='$tag.zip' where id=$id";
$result = mysql_query($query);

/*
 * fwrite($file, "\nDatabase and files updated successfully. At: " . (round(microtime(true) * 1000)));
 */

mysql_close($mysql_link);
mysql_close($conn);
fwrite($file, "\nFilteration done in " . ((round(microtime(true) * 1000) - $start) / 1000) . " s\n\n");
fclose($file);
?>