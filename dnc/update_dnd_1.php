<?php
//$f = '/var/speeddnc/upload/1386565639-dnc1.csv';//$argv[1];
//$id = '86';//$argv[2];
//$fn = '1386565639-dnc1.csv';//explode(".",$argv[3]);

$f = $argv[1];
$id = $argv[2];
$fn = explode(".",$argv[3]);

require_once("../common/connection.php");

if (($handle = @fopen($f, "r")) !== FALSE) {
	do{
		if(date("G") > 8 || date("G") < 20){
			//sleep(1);
			//continue;
		}

		$all_data = array();
		$dnd_data = array();
		$non_dnd = array();
		$invalid_data = array();
		$tag = $fn[0];

		$path = $ZIP_DIR;

		$table = array();
		$query = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'dnd_new'";
		$result = @mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($result)) {
			while ($row = mysql_fetch_object($result)) {
				if ($row->table_name == 'dnd_delete' || $row->table_name == 'never_call' || $row->table_name == 'dnd_ignore') {
					continue;
				}
				$table[] = $row->table_name;
			}
		}

		$i = 0;
		$pho = array();
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if(strlen($data[0])!=10){            
				array_push($invalid_data, $data[0]);
				continue;
			}
			$ph = $data[0];
			$i = 0;

			$query = "";
			foreach($table as $t){
				$query .= "select f4 from dnd_new.$t where f2='$ph' union ";
			}
			$query = rtrim($query," union ");
			$msg = "";
			echo $result = @mysql_query($query);
			if(mysql_num_rows($result)){
				array_push($dnd_data,$ph);
			}
			else{
				array_push($non_dnd,$ph);
			}
			usleep(50);  
			$i +=1;
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
		$result = @mysql_query($query);   

		break;
	}while(true);
}
else{
    echo "File opening error...!\n";
}
?>
