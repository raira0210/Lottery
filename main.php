<?php


if(empty($_GET["file"])){
	header("Location: /");
	exit;
}else{

	$file_enc = $_GET["file"].".txt";
	

	exec('cat txt/'.$file_enc.' | awk -F \',\' \'{print $6}\'',$number);
	exec('cat txt/'.$file_enc.' | awk -F \',\' \'{print $3}\'',$keihin);
	exec('cat txt/'.$file_enc.' | awk -F \',\' \'{print $1}\'',$ban);

	$array = array();
	$num =0;

	for ($i = 1 ; $i < count($number); $i++) {
		
		$num = $num + $number[$i];	
		for ($b = 0 ; $b < $number[$i]; $b++){
		
			$array[] = $ban[$i];
		
		}

	}

}

	$tw = count($array) -1;

	$random = mt_rand(0, $tw);
	header( "Location: /answer.php?ans=".$array[$random]."&file=".$file_enc."&fileo=".$_GET["file"]."&zaiko=".$num);//左のパスの置き換えをお願いします。


?>
