<?php

if(empty($_GET["file"]) || empty($_GET["ans"])){
	header("Location:https://nxlottery.azurewebsites.net/");//左のパスの置き換えをお願いします
	exit;
}else{}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>スピードくじアプリ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex" />
<link rel="stylesheet" href="https://nxlottery.azurewebsites.net/css/style.css"><!--左のパスでCSSを指定してください、相対パスではなく絶対パスでお願いします。-->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<?php 

$fileo = $_GET["fileo"];
echo "<body onLoad=setTimeout(\"location.href=\'/?txt=".$fileo."\'\",7000)>";

?>
	
<script>
$(document).ready(function () {

  hsize = $(window).height();

  $("section").css("height", hsize + "px");

});

$(window).resize(function () {

  hsize = $(window).height();

  $("section").css("height", hsize + "px");

});
</script>


<div id="container">

</nav>

<div id="contents">

<div class="main">

<section id="new">

<section>
<?php

$ans = $_GET["ans"];
$file_enc = $_GET["file"];


exec('cat txt/'.$file_enc.' | egrep \'^'.$ans.'\' | awk -F \',\' \'{print $1}\'',$namunamu);
exec('cat txt/'.$file_enc.' | egrep \'^'.$ans.'\' | awk -F \',\' \'{print $2}\'',$rank);
exec('cat txt/'.$file_enc.' | egrep \'^'.$ans.'\' | awk -F \',\' \'{print $3}\'',$keihin);
exec('cat txt/'.$file_enc.' | egrep \'^'.$ans.'\' | awk -F \',\' \'{print $4}\'',$image);
exec('cat txt/'.$file_enc.' | egrep \'^'.$ans.'\' | awk -F \',\' \'{print $5}\'',$all);
exec('cat txt/'.$file_enc.' | egrep \'^'.$ans.'\' | awk -F \',\' \'{print $6}\'',$nokori);

$nokori2 = intval($nokori[0]) - 1;

//ファイルパス
$rdfile = "txt/".$fileo.".txt";
 
//ファイルの内容を全て文字列に読み込む
$str = file_get_contents($rdfile);
 
//検索文字列に一致したすべての文字列を置換する
$str_grep = preg_replace('/('.$keihin[0].')(.*),[0-9]*/', '$1$2,'.$nokori2, $str);

 
//文字列をファイルに書き込む
file_put_contents($rdfile, $str_grep);

echo "<CENTER><p style=\"font-size:300%\"><font color=\"#ff0000\">".$rank[0]."</font></p>";
echo "<p><img src=\"".$image[0]."\" height=\"50vh\"></p>";
echo "<p style=\"font-size:300%\">".$keihin[0]."</font></p><CENTER>";

/*
if (unlink('txt/'.$file_enc)){
  echo $file_enc.'の削除に成功しました。';
}else{
  echo $file_enc.'の削除に失敗しました。';
}*/


?>



</section>

</div>
<!--/main-->
<CENTER>
<p>7秒後にくじ引き画面に戻ります。</p>
</CENTER>
</div>
<!--/contents-->

</div>
<!--/container-->


<script type="text/javascript">
if (OCwindowWidth() <= 900) {
	open_close("newinfo_hdr", "newinfo");
}

</body>
</html>
