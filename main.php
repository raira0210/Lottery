<?php


if(empty($_GET["file"])){
	header("Location:https://nxlottery.azurewebsites.net/");//左のパスの置き換えをお願いします。
	exit;
}else{

	$file_enc = $_GET["file"].".txt";
	

	exec('cat txt/'.$file_enc.' | awk -F \',\' \'{print $6}\'',$number);
	exec('cat txt/'.$file_enc.' | awk -F \',\' \'{print $3}\'',$keihin);
	exec('cat txt/'.$file_enc.' | awk -F \',\' \'{print $1}\'',$ban);

	$array = array();

	for ($i = 1 ; $i < count($number); $i++) {
	
		for ($b = 0 ; $b < $number[$i]; $b++){
		
			$array[] = $ban[$i];
		
		}

	}

}

	$tw = count($array) -1;

	$random = mt_rand(0, $tw);
	header( "Location: https://nxlottery.azurewebsites.net/answer.php?ans=".$array[$random]."&file=".$file_enc."&fileo=".$_GET["file"]);//左のパスの置き換えをお願いします。

	//echo $random;
	//var_dump($array);

?>
