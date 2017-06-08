<?php
$id = $argv[2];
$f = $argv[1];
$fn = explode(".",$argv[3]);

require_once("../common/connection.php");

if (($handle = @fopen($f, "r")) !== FALSE) {
    $all_data = array();
    $dnd_data = array();
    $non_dnd = array();
    $invalid_data = array();
    $tag = $fn[0];

    $path = $ZIP_DIR;

    $i = 0;
    $pho = array();
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	$data[0] = trim($data[0]);
        if(strlen($data[0])!=10){            
            array_push($invalid_data, $data[0]);
            continue;
        }
        $ph = trim($data[0]);

        $query = "select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_31 where f2='$ph' or f2='\"$ph\"' limit 1";
        $msg = "";
        $result = @mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result)){
            $row = mysql_fetch_object($result);
            if($row->f4=='A'){
                array_push($dnd_data,$ph);
                $msg = $ph." = DND : ".$row->f4;
            }
            if($row->f4=='D'){
                array_push($non_dnd,$ph);
                $msg = $ph." = DND : ".$row->f4;
            }
            usleep(10);  
            $i +=1;
            echo $i." ===> ".$msg."\n";            
            continue;
        }        

        $query = "select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd where f2='$ph' or f2='\"$ph\"' limit 1";
        $msg = "";
        $result = @mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result)){
            $row = mysql_fetch_object($result);
            if($row->f4=='A'){
                array_push($dnd_data,$ph);
                $msg = $ph." = DND : ".$row->f4;
            }
            if($row->f4=='D'){
                array_push($non_dnd,$ph);
                $msg = $ph." = DND : ".$row->f4;
            }
            usleep(10);  
            $i +=1;
            echo $i." ===> ".$msg."\n";            
            continue;
        }        

        $query = "select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_0 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_1 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_2 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_3 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_4 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_5 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_6 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_7 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_8 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_9 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_10 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_11 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_12 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_13 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_14 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_15 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_16 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_17 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_18 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_19 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_20 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_21 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_22 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_23 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_24 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_25 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_26 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_27 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_28 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_29 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_30 where f2='$ph' or f2='\"$ph\"' union
        select replace(f2,'\"','') as f2,replace(f4,'\"','') as f4 from dnd.dnd_13AUG where f2='$ph' or f2='\"$ph\"' limit 1";

        $msg = "";
        $result = @mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result)){
            $row = mysql_fetch_object($result);
            if($row->f4=='A'){
                array_push($dnd_data,$ph);
                $msg = $ph." = DND : ".$row->f4;
            }
            if($row->f4=='D'){
                array_push($non_dnd,$ph);
                $msg = $ph." = DND : ".$row->f4;
            }                  
        }
        else{
            array_push($non_dnd,$ph);
            $msg = $ph." = DND : D";
        }
        usleep(10);  
        $i +=1;
        echo $i." ===> ".$msg."\n";
    }
    $non_dnd = array_filter($non_dnd);
    $dnd_data = array_filter($dnd_data);
    $invalid_data = array_filter($invalid_data);
    
    $myFile1 = $path.$tag."-non_dnd.csv";
    $myFileLocal1 = $tag."-non_dnd.csv";
    $fh = fopen($myFile1, 'w');    
    fwrite($fh, implode("\n",$non_dnd));
    @fclose($fh);    

    $myFile2 = $path.$tag."-dnd.csv";
    $myFileLocal2 = $tag."-dnd.csv";
    $fh = fopen($myFile2, 'w');    
    fwrite($fh, implode("\n",$dnd_data));
    @fclose($fh);    

    $myFile3 = $path.$tag."-error.csv";
    $myFileLocal3 = $tag."-error.csv";
    $fh = fopen($myFile3, 'w');    
    fwrite($fh, implode("\n",$invalid_data));
    @fclose($fh);  
    
    $zip = new ZipArchive();
    $filename = $path.$tag.".zip";

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }
    $zip->addFile($myFile1,$myFileLocal1);
    $zip->addFile($myFile2,$myFileLocal2);
    $zip->addFile($myFile3,$myFileLocal3);
    
    echo "numfiles: " . $zip->numFiles . "\n";
    echo "status:" . $zip->status . "\n";
    $zip->close();
    
    unlink($myFile1);
    unlink($myFile2);
    unlink($myFile3);
    
    $query = "update upload_file set f_status=0,dnc_f_name='$tag.zip' where id=$id";
    $result = @mysql_query($query) or die(2);   
}
else{
    echo "File opening error...!\n";
}
?>
