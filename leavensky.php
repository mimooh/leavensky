<?php
session_name('leavensky');
require_once("inc.php");

function head() { /*{{{*/
	echo "
<HTML><HEAD>
<META http-equiv=Content-Type content='text/html; charset=utf-8' />
<title>leavensky</title>
</HEAD>
<link rel='stylesheet' type='text/css' href='css/css.css'>
<link rel='stylesheet' type='text/css' href='css/datepicker.css' />
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/taffy-min.js'></script>
<script type='text/javascript' src='js/moment.min.js'></script>
<script type='text/javascript' src='js/datepicker.js'></script>
<script type='text/javascript' src='js/script.js'></script>
";
}
/*}}}*/
function setup() {/*{{{*/
	if(!empty($_SESSION['setup'])) {
		$_SESSION['setup']=[];
		$_SESSION['setup']['titles']=[];
		$conf=json_decode(file_get_contents("conf.json"),1)['leave_titles'];
		foreach($conf as $t) {
			$_SESSION['setup']['titles'][$t[0]]=$t[1];
		}

		$r=$_SESSION['ll']->query("SELECT taken,limits FROM summary WHERE user_id=$1 AND year=$2", array($_SESSION['user_id'], $_SESSION['year']))[0]; 
		$taken=json_decode($r['taken'],1);
		$limits=json_decode($r['limits'],1);

		$leaves=$_SESSION['ll']->query("SELECT lday,ltype FROM leavensky WHERE user_id=$1 AND year=$2", array($_SESSION['user_id'], $_SESSION['year'])); 
		$_SESSION['setup']["summary"]=array('taken'=>$taken, 'limits'=>$limits); 
		$_SESSION['setup']["leaves"]=$leaves;

		echo "
		<script type='text/javascript'>
			var setup=".json_encode($_SESSION['setup']).";
		</script>
		";
	}

}
/*}}}*/
function form() { /*{{{*/
	extract($_SESSION['i18n']);

	$titles='';
	foreach($_SESSION['setup']['titles'] as $k=>$v) { 
		$titles.="<th><label class=lradio id='l$k' title='$v'>$v</label>";
	}

	echo "
	<form method=post> 
	<input type=hidden name=collect id=collect>
	<table style='width:1px'> <tr> <th>$i18n_choose<th> $titles </table>
	<input id=leavensky_submit type=submit value='OK'><br>
	<div style='display:inline-block'>
		<div id='multi-calendar' style='float:left'></div>
		<div id=preview></div>
	</div>
	<br><br>
	</form>
	";

}
/*}}}*/
function submit() { /*{{{*/
	if(empty($_REQUEST['collect'])) { return; }
	$collect=json_decode($_REQUEST['collect'],1); 
	$_SESSION['ll']->query("DELETE FROM leavensky WHERE year=$1 AND user_id=$2", array($_SESSION['year'],$_SESSION['user_id']));
	foreach($collect as $v) {
		$_SESSION['ll']->query("INSERT INTO leavensky(year,user_id,ltype,lday,creator_id) values($1,$2,$3,$4,666)", array($_SESSION['year'],$_SESSION['user_id'],$v[1],$v[0]));
	}
}
/*}}}*/

$_SESSION['user_id']=1;
$_SESSION['year']=2018;
head();
submit();
setup();
form();

?>
