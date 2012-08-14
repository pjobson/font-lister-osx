<? header('Content-Type:text/html; charset=UTF-8'); ?>
<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>System Fonts</title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.6.0/build/cssreset/cssreset-min.css" />
	<style type="text/css">
		footer {
			text-align: center;
		}
		body {
			font-family: Courier;
			margin: 10px;
		}
		th {
			padding: 5px;
		}
		td {
			padding: 5px 0;
		}
		td.samp {
			font-size: 3em;
			text-align: center;
		}
		tr.row0 {
			background-color: white;
		}
		tr.row1 {
			background-color: #e6e6e6;
		}
		th {
			color: white;
			background-color: black;
			font-weight: bold;
			font-size: 1.2em;
		}
		tr.sel {
			background-color: #F2F5A9;
		}
		input {
			width: 300px;
		}
		
	</style>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
	<script type="text/javascript">
	$('tr.sampRow').live('click',function() {
		$(this).toggleClass('sel');
	});
	$('input').live('keyup',function() {
		$('td.samp').html($(this).attr('value'));
	});
	</script>


</head>

<body>

	<header>
		
	</header>
	
	<section>
		<table>
			<thead>
				<tr>
					<td colspan="3" align="center">
						New Sample: <input type="text" value="" id="newSample" />
					</td>
				</tr>
				<tr>
					<th>Family</th><th>Style</th><th>Path</th>
				</tr>
			</thead>
			<tbody>
<?

$sample = "How razorback-jumping frogs can level six piqued gymnasts!<br/>
0123456789 ~`!@#$%^&*()_+-=[]{}:\";'<>?,.\\/";

$cmd = "/usr/X11/bin/fc-list";
$data = shell_exec($cmd);

$data = preg_replace("/:(\s|\.)+/",":",$data);
$data = preg_replace("/\\\/","",$data);
$data = preg_replace("/:style=/",":",$data);
$lines = explode("\n",$data);

$lines = array_map(function($line) {
	if ($line == "") {
		return;
	}
	if (preg_match("/\.(ttc|pfb|dfont|gz):/",$line) == 1) {
		return;
	}

	$lhash = array();
	list($lhash['path'],$lhash['family'],$lhash['style']) = explode(":", $line);
	$lhash['style'] = preg_replace("/,/",", ",$lhash['style']);

	$lhash['family'] = preg_replace("/,.+/","",$lhash['family']);

	$lhash['path'] = preg_replace("/ /","&nbsp;",$lhash['path']);
	
	return $lhash;
	
},$lines);

usort($lines,function($a,$b) {
	return strcmp(strtolower($a['family']),strtolower($b['family']));
});

$i=0;
$lastFamily = "";
foreach (array_filter($lines) as $line):
	if ($line['family'] != $lastFamily):
		$i++;
?>
				<tr class="sampRow row<?=($i%2)?>">
					<td colspan="3" class="samp" style="font-family: '<?=$line['family']?>';"><?=$sample?></td>
				</tr>
<? endif; ?>
				<tr class="row<?=($i%2)?>">
					<td><?=$line['family']?></td>
					<td><?=$line['style']?></td>
					<td><?=$line['path']?></td>
				</tr>


<?
$lastFamily = $line['family'];
endforeach;
?> 
			</tbody>
		</table>
	</section>
	<footer>
		<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type">font-lister-osx</span> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.
	</footer>
</body>

</html>