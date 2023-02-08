<html>
<head>
	<title>Daftar Hasil Fuzzy</title>
</head>
<body>
<?php
ini_set('display_errors', '1');
require('fuzzymf.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$c = new mysqli("localhost","root","","kesehatan");
if(!empty($_GET['detail'])){
	$r = $c->query("select * from skripsi WHERE id='".$_GET['detail']."'");
	$d = $r->fetch_array(MYSQLI_ASSOC);
	$fd = fuzzy($d);
	tsukamoto($d,$fd,true);
}else{
	$r = $c->query("select * from skripsi order by id desc");
	echo '<table border="1">';
	echo '<tr><th rowspan="2">Jantung</th><th rowspan="2">Suhu</th>
	<th rowspan="2">Kelembaban</th><th colspan="3">Rilex</th><th colspan="3">Tenang</th>
	<th colspan="3">Cemas</th><th colspan="3">Stres</th><th rowspan="2">Hasil</th></tr>';
	echo '<tr>';
	for($i=1;$i<=4;$i++){
		echo '<td>jantung'.$i.'</td><td>suhu'.$i.'</td><td>kelembaban'.$i.'</td>';
	}
	echo '</tr>';
	while($d = $r->fetch_array(MYSQLI_ASSOC)){
		echo '<tr>';
		echo '<td>'.$d['jantung'].'</td><td>'.$d['suhuSekarang'].'</td><td>'.$d['kelembapan'].'</td>';
		$fd = fuzzy($d);
		echo '<td>'.$fd[0][0].'</td><td>'.$fd[0][1].'</td><td>'.$fd[0][2].'</td>';
		echo '<td>'.$fd[1][0].'</td><td>'.$fd[1][1].'</td><td>'.$fd[1][2].'</td>';
		echo '<td>'.$fd[2][0].'</td><td>'.$fd[2][1].'</td><td>'.$fd[2][2].'</td>';
		echo '<td>'.$fd[3][0].'</td><td>'.$fd[3][1].'</td><td>'.$fd[3][2].'</td>';
		echo '<td><a href="hasilfuzzy.php?detail='.$d['id'].'">'.tsukamoto($d,$fd,false).'</a></td>';
		echo '</tr>';
	}
	echo '</table>';
}

function fuzzy($d){
	$fd = array();
	$j1 = trimf($d['jantung'],58,65,72);
	$s1 = trimf($d['suhuSekarang'],35.8,36.5,37.2);
	$k1 = minmf($d['kelembapan'],1.8,2.2);
	array_push($fd,array($j1,$s1,$k1));
	$j2 = trimf($d['jantung'],68,83,92);
	$s2 = trimf($d['suhuSekarang'],34.7,35.5,36.2);
	$k2 = trimf($d['kelembapan'],1.8,3,4.2);
	array_push($fd,array($j2,$s2,$k2));
	$j3 = trimf($d['jantung'],88.8,94,103);
	$s3 = trimf($d['suhuSekarang'],32.7,34,35.2);
	$k3 = trimf($d['kelembapan'],3.8,4.7,6.2);
	array_push($fd,array($j3,$s3,$k3));
	$j4 = maxmf($d['jantung'],95,100);
	$s4 = minmf($d['suhuSekarang'],32,33);
	$k4 = maxmf($d['kelembapan'],5.8,6.2);
	array_push($fd,array($j4,$s4,$k4));
	return $fd;
}

function tsukamoto($d,$fd,$detail=false){
	$S = array('rilex','tenang','cemas','stres');
	$sv = array(25,50,75,100);
	$m=0;$n=0;$o=0;$p=0;
	$i=1;
	$dres=array();
	foreach($S as $s1){
		$f1 = $fd[$m][0];
		foreach($S as $s2){
			$f2 = $fd[$n][1];
			foreach($S as $s3){
				$f3 = $fd[$o][2];
				foreach($S as $s4){
					$min = min($f1,$f2,$f3);
					$res = $sv[$p]-($sv[$p] 
					*$min);
					if($detail==true){
						echo 'rule'.$i.':'.$s1.' '.$s2.' '.$s3.'->'.$s4.
						' : ['.$f1.', '.$f2.', '.$f3.']='.$sv[$p].'x'.$min.'='.
						$res.'<br>';
					}
					array_push($dres,$res);$p+=1;$i+=1;
				}$o+=1;$p=0;
			}$n+=1;$o=0;
		}$m+=1;$n=0;
	}
	$final = array_sum($dres)/sizeof($dres);
	$diagnosa = $S[0];
	for($i=0;$i<4;$i++){
		if($sv[$i]>$final){
			$diagnosa = $S[$i];
			break;
		}
	}
	if($detail==true){
		echo '<h1>Hasil : '.$final.'('.$diagnosa.')</h1>';
	}
	return $final.'('.$diagnosa.')';
}
?>
</body>
</html>
