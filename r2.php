<?php

#$r=$_SESSION['aa']->query("select leaves from adijoz where user_id=-1 and year=2020");
#dd($r);

function read_wolne() { #{{{
	$wolne=json_decode('[["2020-01-01","zal"],["2020-01-04","zal"],["2020-01-05","zal"],["2020-01-06","zal"],["2020-01-11","zal"],["2020-01-12","zal"],["2020-01-18","zal"],["2020-01-19","zal"],["2020-01-25","zal"],["2020-01-26","zal"],["2020-02-01","zal"],["2020-02-02","zal"],["2020-02-08","zal"],["2020-02-09","zal"],["2020-02-15","zal"],["2020-02-16","zal"],["2020-02-22","zal"],["2020-02-23","zal"],["2020-02-29","zal"],["2020-03-01","zal"],["2020-03-07","zal"],["2020-03-08","zal"],["2020-03-14","zal"],["2020-03-15","zal"],["2020-03-21","zal"],["2020-03-22","zal"],["2020-03-28","zal"],["2020-03-29","zal"],["2020-04-04","zal"],["2020-04-05","zal"],["2020-04-11","zal"],["2020-04-12","zal"],["2020-04-13","zal"],["2020-04-18","zal"],["2020-04-19","zal"],["2020-04-25","zal"],["2020-04-26","zal"],["2020-05-01","zal"],["2020-05-02","zal"],["2020-05-03","zal"],["2020-05-09","zal"],["2020-05-10","zal"],["2020-05-16","zal"],["2020-05-17","zal"],["2020-05-23","zal"],["2020-05-24","zal"],["2020-05-30","zal"],["2020-05-31","zal"],["2020-06-06","zal"],["2020-06-07","zal"],["2020-06-11","zal"],["2020-06-13","zal"],["2020-06-14","zal"],["2020-06-20","zal"],["2020-06-21","zal"],["2020-06-27","zal"],["2020-06-28","zal"],["2020-07-04","zal"],["2020-07-05","zal"],["2020-07-11","zal"],["2020-07-12","zal"],["2020-07-18","zal"],["2020-07-19","zal"],["2020-07-25","zal"],["2020-07-26","zal"],["2020-08-01","zal"],["2020-08-02","zal"],["2020-08-08","zal"],["2020-08-09","zal"],["2020-08-15","zal"],["2020-08-16","zal"],["2020-08-22","zal"],["2020-08-23","zal"],["2020-08-29","zal"],["2020-08-30","zal"],["2020-09-05","zal"],["2020-09-06","zal"],["2020-09-12","zal"],["2020-09-13","zal"],["2020-09-19","zal"],["2020-09-20","zal"],["2020-09-26","zal"],["2020-09-27","zal"],["2020-10-03","zal"],["2020-10-04","zal"],["2020-10-10","zal"],["2020-10-11","zal"],["2020-10-17","zal"],["2020-10-18","zal"],["2020-10-24","zal"],["2020-10-25","zal"],["2020-10-31","zal"],["2020-11-01","zal"],["2020-11-07","zal"],["2020-11-08","zal"],["2020-11-11","zal"],["2020-11-14","zal"],["2020-11-15","zal"],["2020-11-21","zal"],["2020-11-22","zal"],["2020-11-28","zal"],["2020-11-29","zal"],["2020-12-05","zal"],["2020-12-06","zal"],["2020-12-12","zal"],["2020-12-13","zal"],["2020-12-19","zal"],["2020-12-20","zal"],["2020-12-25","zal"],["2020-12-26","zal"],["2020-12-27","zal"]]',1);
	return $wolne;
}
/*}}}*/
function read_stanley() { #{{{
	$json=json_decode('
{
    "name": "Łazowy Stanisław",
    "time_off": {
        "01": {
            "zal": [],
            "wyp": [],
            "dod": [],
            "nz": []
        },
        "02": {
            "zal": [],
            "wyp": [],
            "dod": [ 7, 10, 11, 12, 13, 14, 17, 18, 19, 20, 21 ],
            "nz": []
        },
        "03": {
            "zal": [],
            "wyp": [],
            "dod": [],
            "nz": []
        },
        "04": {
            "zal": [ 10, 20, 21, 22, 23, 24 ],
            "wyp": [],
            "dod": [],
            "nz": []
        },
        "05": {
            "zal": [],
            "wyp": [],
            "dod": [],
            "nz": []
        },
        "06": {
            "zal": [],
            "wyp": [
                12
            ],
            "dod": [],
            "nz": []
        },
        "07": {
            "zal": [],
            "wyp": [ 1, 2, 3, 13, 14, 15, 16, 17, 20, 21, 22, 23, 24, 27, 28, 29, 30 ],
            "dod": [],
            "nz": [ 31 ]
        },
        "08": {
            "zal": [],
            "wyp": [],
            "dod": [],
            "nz": [ 3, 4, 5 ]
        },
        "09": {
            "zal": [],
            "wyp": [],
            "dod": [],
            "nz": []
        },
        "10": {
            "zal": [],
            "wyp": [],
            "dod": [],
            "nz": []
        },
        "11": {
            "zal": [],
            "wyp": [],
            "dod": [],
            "nz": []
        },
        "12": {
            "zal": [],
            "wyp": [ 28, 29, 30, 31 ],
            "dod": [ 23, 24 ],
            "nz": []
        }
    }
}

	', 1);
	return $json;
}
/*}}}*/
function rok(){/*{{{*/ //w tym roku przestepny 29 dni w lutym
	$months=array(
		"01"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0),
		"02"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0),
		"03"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0),
		"04"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0),
		"05"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0),
		"06"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0),
		"07"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0),
		"08"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0),
		"09"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0),
		"10"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0),
		"11"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0),
		"12"=> array("01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0, "16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0),
		);
	$year=[];
	foreach($months as $mon=>$v){
		foreach ($v as $dom=>$val){
			$key=$mon."_".$dom;
			$year[$key]=0;
		}	
	}
	return $year;

}/*}}}*/
function wolne(){/*{{{*/
	$wolne=array(
	"01"=>array('01','04','05','11','12','18','19','25','26'),
	"02"=>array('01','02','08','09','15','16','22','23','29'),
	"03"=>array('01','07','08','14','15','21','22','28','29'),
	"04"=>array('04','05','11','12','13','18','19','25','26',)
	);
	return($wolne);
}/*}}}*/
function fill_year(){//tworzy os czasu dni zaplanowane + dni wolne od pracy (sobota niedziela, swieta)/*{{{*/
	$wolne=read_wolne(); 
	$kto=read_stanley(); //dni zaplanowane pracownika
	$time_line=rok(); //wszystkie dni w roku
	foreach($kto['time_off'] as $k_mon=>$v){ //wstawienie zaplanowanych dni pracownika na os czasu
		foreach($v as $type=>$val){
			foreach ($val as $k_dom){
				$key=$k_mon."_".$k_dom;
				$time_line[$key]=$type; //dodaj dzien urlopu do timeline
			}
		}
	}
	foreach($wolne as $w){ //wpisywanie wolnego w timeline
		$data=explode("-",$w[0]);
		$key=$data[1]."_".$data[2];
		$time_line[$key]='wol';
	}
	return($time_line);	
}/*}}}*/
function remove_holiday_at_end($temp_table){/*{{{*/
		while(end($temp_table)=='wol'){
			array_pop($temp_table);
		}
		return($temp_table);
}/*}}}*/
function make_con_table($new_temp, $count){ //dodaj temp table do duzej listy/*{{{*/
			#echo "Koniec serii $count dni planowanych \n";
			$keys=array_keys($new_temp);
			$from_array=explode("_",reset($keys));
			$from=$from_array[1].".".$from_array[0];	
			$to_array=explode("_",end($keys));
			$to=$to_array[1].".".$to_array[0];	
			$ret=array('from'=>$from,'to'=>$to,'count'=>$count);
			return($ret);
}/*}}}*/
function find_continuity($time_line){/*{{{*/
	global $con_table,$limit;
	#print_r($time_line);
	$temp_table=[];
	$found=0;
	$count=0;//liczba dni zaplanowanych w serii
	$limit=10;
	$juz_zaplanowanych=0;
	foreach($time_line as $date=>$type){
		if(!empty($type)and $type!='wol' ){ //znalazlem poczatek serii - nie zaczynamy od dnia wolnego
			$found=1;
			$temp_table[$date]=$type;
			$count++;//liczba dni zaplanowanych w serii
			$juz_zaplanowanych++;
			if($juz_zaplanowanych==$limit){
				$d=explode("_",$date);
				$limit="Osiagnieto limit $limit dni w  ".$d[1].".".$d[0].".2020\n";
				}
		}
		if(!empty($type) and $found==1){ //znalazłem kolejny wpis w serii
			$temp_table[$date]=$type;
		}
		if(empty($type) and $found==1){ //ten wpis juz nie w serii
#			echo "Koniec serii $count dni planowanych \n";
#			print_r($temp_table);
			$new_temp=remove_holiday_at_end($temp_table); //usun z konca dni swiateczne
			$con_table[]=make_con_table($new_temp, $count);//dodaj znaleziona serie do duzej listy
			$count=0;
			$found=0;
			$temp_table=[];
		}
	}
	return($con_table);	
}/*}}}*/
function find_first_long($con_table){/*{{{*/
	$limit=10;
	foreach ($con_table as $k=>$v){
			if( $con_table[$k]['count']>=$limit){
				$dlugi_urlop="Długi urlop długości min $limit zaplanowano od ".$con_table[$k]['from']." do ".$con_table[$k]['to']."\n";
				return($dlugi_urlop);
			}
	}
}/*}}}*/

global $limit;
function stanley_liczy() { #{{{
	$con_table=[];//empty table 
	$time_line=fill_year();
	$con_table=find_continuity($time_line);
	$dlugi_urlop= find_first_long($con_table);
	echo $dlugi_urlop;
	echo $limit;
	print_r($con_table);
}
/*}}}*/
?>
