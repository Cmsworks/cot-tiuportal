<!-- BEGIN: MAIN -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>{MESSAGE_TITLE}</title> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="generator" content="Cotonti http://www.cotonti.com" />
{MESSAGE_BASEHREF}

<link href="themes/{PHP.theme}/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
{MESSAGE_STYLESHEET}
</head>

<body>
	<div class="container">
		<br/>
		<br/>
		<br/>
		<div class="text-center">
			<a href="{PHP.cfg.mainurl}" title="{PHP.cfg.maintitle} {PHP.cfg.separator} {PHP.cfg.subtitle}"><img src="themes/{PHP.theme}/img/logo.png"/></a>
		</div>
		<h1 class="text-center">{MESSAGE_TITLE}</h1>
		<div class="alert alert-warning">
			{MESSAGE_BODY}
		</div>
	</div>

	<script type="text/javascript" src="themes/{PHP.theme}/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<!-- END: MAIN -->