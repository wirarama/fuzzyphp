<?php
function minmf($x,$a,$b){
    if($x<=$a){
        return 1;
    }elseif($x>$b){
        return 0;
    }else{
        return ($b-$x)/($b-$a);
	}
}
function maxmf($x,$a,$b){
    if($x>=$b){
        return 1;
    }elseif($x<$a){
        return 0;
    }else{
        return ($x-$a)/($b-$a);
	}
}
function trimf($x,$a,$b,$c){
    if($x<$a || $x>$c){
        return 0;
    }elseif($x==$b){
        return 1;
    }elseif($x>=$a && $x<$b){
        return maxmf($x,$a,$b);
    }elseif($x>$b and $x<=$c){
        return minmf($x,$b,$c);
	}
}
/*
echo minmf(24,20,40).'<br>';
echo maxmf(38,30,39).'<br>';
echo trimf(32,30,35,39).'<br>';
echo trimf(37.5,30,35,39).'<br>';
echo (min(minmf(35,34,36.5),maxmf(120,100,140),trimf(2,1,3,5))).'<br>';
echo (sum([minmf(35,34,36.5),maxmf(120,100,140),trimf(2,1,3,5)])/3).'<br>';*/

/*
 def rilexInferensi(gsrStatus, suhuStatus, detakStatus, hasilStatus, arrayAlpha, arrayZValue):
    gsrValue = 0
    suhuValue = 0
    detakValue = 0
    
#     set value gsr
    if gsrStatus == "rilex":
        gsrValue = value_RK
    elif gsrStatus == "tenang":
        gsrValue = value_TK
    elif gsrStatus == "cemas":
        gsrValue = value_CK
    elif gsrStatus == "stres":
        gsrValue = value_SK
        
#     set value suhu
    if suhuStatus == "rilex":
        suhuValue = value_RS
    elif suhuStatus == "tenang":
        suhuValue = value_TS
    elif suhuStatus == "cemas":
        suhuValue = value_CS
    elif suhuStatus == "stres":
        suhuValue = value_SS

#     set value detak
    if detakStatus == "rilex":
        detakValue = value_RD
    elif detakStatus == "tenang":
        detakValue = value_TD
    elif detakStatus == "cemas":
        detakValue = value_CD
    elif detakStatus == "stres":
        detakValue = value_SD
        
    alphaPredikat = min(gsrValue, suhuValue, detakValue)
    
    if hasilStatus == "rilex":
        zValue = 25 - (25 * alphaPredikat)
    elif hasilStatus == "tenang":
        zValue = 50 - (25 * alphaPredikat)
    elif hasilStatus == "cemas":
        zValue = 75 - (25 * alphaPredikat)
    elif hasilStatus == "stres":
        zValue = 100 - (25 * alphaPredikat)
        
    arrayAlpha.append(alphaPredikat)
    arrayZValue.append(zValue)
    
    
    hasil = 0
	pembagi = 0

	for i in range(len(arrAlphaPredikat)):
		hasil = hasil + (arrAlphaPredikat[i] * arrZvalue[i])
		pembagi = pembagi + arrAlphaPredikat[i]

	hasil = hasil / pembagi
	print(hasil)
 */
?>
