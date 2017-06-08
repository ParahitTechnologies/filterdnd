<?php
session_start();
	if(empty($_SESSION['id']))
	{
		header("Location:./login/index.php");
	}
            $uploaddir ="/var/www/html/govardhan/upload/";
	    ///$uploaddir ="C:/xampp/htdocs/govardhan/upload/";
		$fname = $_FILES['file']['name'];
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir.$fname))
			$move=true;
		if($move)
		{
			if (($handle = fopen($uploaddir.$fname, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			        $i=1;
					for ($c=0; $c < 1; $c++) {
      						$ch = @curl_init() or die("Not init");
						@curl_setopt($ch, CURLOPT_URL, "http://125.63.73.251/dnd/check_dnd.php?phone=$data[0]") or die("error1");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$contents = curl_exec($ch);
						curl_close ($ch);
						if($contents==1)
						 {
						}
						else
						{
						 $tsv1[]= implode("\t",array($data[0].",".$data[1]));
						}
						
				}
			       usleep(100);
			}
			fclose($handle);
		}
	}
	$tsv1 = implode("\r\n",$tsv1);
	$emaildisp_from="LEAD";
$fileName =$emaildisp_from.".csv";
header("Content-type: application/vnd.ms-csv"); 
header("Content-Disposition: attachment; filename=$fileName");
echo $tsv1;
?>