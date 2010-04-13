<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Adauga Tara</title>
<link rel="stylesheet" type="text/css" href="../../../../www/media/css/view.css" media="all">
<script type="text/javascript" src="../../../../www/media/javascript/view.js"></script>
</head>
<body id="main_body" >

	<img id="top" src="top.png" alt="">
	<div id="form_container">

		<h1><a>Adauga Tara</a></h1>
		<form id="form_219067" class="appnitro"  method="post" action="index.php?route=AdaugaTara/adaugatara">
					<div class="form_description">
			<h2>Adauga Tara</h2>
			<p>De aici poti adauga tara si regiune pentru vacante.
Desc: Generare Meniu
TODO:</p>
		</div>
			<ul >

					<li id="li_1" >
		<label class="description" for="element_1">Tara </label>
		<div>
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/>
                        <p class="errors"><?php echo $tara['tara']; ?>
		</div><p class="guidelines" id="guide_1"><small>Adauga Tara</small></p>
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Regiune </label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/>
                        <p class="errors"><?php echo $regiune['regiune']; ?>
		</div><p class="guidelines" id="guide_2"><small>Regiune</small></p>
		</li>

					<li class="buttons">
			    <input type="hidden" name="form_id" value="219067" />

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>