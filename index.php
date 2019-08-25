<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>簡易スピードくじ(仮作成)</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex" />
<link rel="stylesheet" href="https://nxlottery.azurewebsites.net/css/style.css"><!--左のパスでCSSを指定してください、相対パスではなく絶対パスでお願いします。-->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<div id="container">
</nav>
<div id="contents">
<div class="main">
<section id="new">
<section>
<?php

function checkSimilar(array $list):string
{
	$value_count = array_count_values($list);
	$max = max($value_count);
	return $max;
}

if(empty($_GET["txt"])){

	$html = "<CENTER>URLの末尾に  ?txt=該当txtのファイル名(拡張子除く)を  入力してください。<br>例:http://www.testhp.shop/?txt=abcde(ファイル名)</CENTER>";//左のパスをお使いになるドメインに置き換えてください。なお、/kujiから後ろは固定となりますので、その前まで置き換えをお願いします。
}else{

	$file = $_GET["txt"].".txt";
	$file_enc = $_GET["txt"]."_back.txt";
	$check = exec('ls -l txt/'.$file);

	if(empty($check)){

		$html = "<CENTER>指定されたtxtファイルは存在しません</CENTER>";

		}else{

			echo "<br>";
			exec('nkf -w txt/'.$file.' > txt/'.$file_enc);

			exec('cat txt/'.$file.' | awk -F \',\' \'{print $6}\'',$output);
		
			$num = 0;

			for ($i = 1 ; $i < count($output); $i++) {

				$num = $num + intval($output[$i]);

			}

			exec('cat txt/'.$file.' | awk -F \',\' \'{print $1}\'',$tyou);

			if(checkSimilar($tyou) != 1){

				$html = "<CENTER>txtファイル内のNoが重複しています。確認してください。</CENTER>";

			}else{

				exec('cat txt/'.$file.' | awk -F \',\' \'{print $4}\'',$im);

				$num5 = 0;
				$num4 = 0;

				for ($i = 1 ; $i < count($im); $i++) {

					$check2 = exec('ls -l '.$im[$i]);

					if(empty($check2)){

						if($num4 != 0){

							$num4 = "$num4"."$i".".";

						}else{

							$num4 = "$i".".";

						}

						$num5 = $num5 + 1;

					}
				}

			if($num5 != 0){

			$html = "<CENTER>No:".$num4."に指定されたimageファイルは存在しません</CENTER>";

			}else{

				$html = "<CENTER>下の赤い箱をタップして、くじを引いてね！！<br><br><a href=\"https://nxlottery.azurewebsites.net/main.php?file=".$_GET["txt"]."\"><img src=\"https://nxlottery.azurewebsites.net/images/kujiwohiku.png\" width=\"40%\" height=\"40%\"></a><br><br>くじは残り".$num."枚です。</CENTER>";//左のmain.phpとkujiwohiku.pngのパスも置き換えをお願いします。

			}

		}

	}
}

echo $html;

?>

</section>

</div>
<!--/main-->

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
