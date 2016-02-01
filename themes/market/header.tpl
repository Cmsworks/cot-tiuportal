<!-- BEGIN: HEADER -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>{HEADER_TITLE}</title> 
<!-- IF {HEADER_META_DESCRIPTION} --><meta name="description" content="{HEADER_META_DESCRIPTION}" /><!-- ENDIF -->
<!-- IF {HEADER_META_KEYWORDS} --><meta name="keywords" content="{HEADER_META_KEYWORDS}" /><!-- ENDIF -->
<meta http-equiv="content-type" content="{HEADER_META_CONTENTTYPE}; charset=UTF-8" />
<meta name="generator" content="Cotonti http://www.cotonti.com" />
<link rel="canonical" href="{HEADER_CANONICAL_URL}" />
{HEADER_BASEHREF}
{HEADER_HEAD}
<link rel="shortcut icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
</head>

<body>
	<div id="wrapper">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="logo"><a href="{PHP.cfg.mainurl}" title="{PHP.cfg.maintitle} {PHP.cfg.separator} {PHP.cfg.subtitle}"><img src="themes/{PHP.theme}/img/logo.png"/></a></div>
					</div>
					<div class="col-md-5">
						
					</div>
					<div class="col-md-3">
						<!-- BEGIN: GUEST -->
							<div class="btn-group pull-right margintop20">
							    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{PHP.L.User}  <span class="caret"></span></button>
							    <ul class="dropdown-menu" role="menu">
							      <li><a href="{PHP|cot_url('login')}">{PHP.L.Login}</a></li>
							      <li><a href="{PHP|cot_url('users','m=register')}" >{PHP.L.Register}</a></li>
							      <li><a href="{PHP|cot_url('users', 'm=passrecover')}">{PHP.L.users_lostpass}</a></li>
							    </ul>
						  	</div>
						<!-- END: GUEST -->
						<!-- BEGIN: USER -->
							<div class="btn-group pull-right margintop20">
							    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{PHP.usr.name}  <span class="caret"></span></button>
							    <ul class="dropdown-menu" role="menu">
							    	<li><a href="{PHP|cot_url('profile')}">{PHP.L.profile_profile}</a></li>
							    	<!-- IF {PHP.cfg.payments.balance_enabled} -->
							    	<li><a href="{HEADER_USER_BALANCE_URL}">{PHP.L.payments_mybalance}: {HEADER_USER_BALANCE|number_format($this, '2', '.', ' ')} {PHP.cfg.payments.valuta}</a></li>
							    	<!-- ENDIF -->
							    	<!-- IF {HEADER_USER_MYMARKET_URL} -->
							    	<li><a href="{HEADER_USER_MYMARKET_URL}">{PHP.L.market_myproducts}</a></li>
							    	<!-- ENDIF -->
							    	<!-- IF {PHP.cot_plugins_active.tiuorders} -->
							    	<li><a href="{PHP|cot_url('tiuorders', 'm=sales')}">{PHP.L.tiuorders_mysales}</a></li>
							    	<li><a href="{PHP|cot_url('tiuorders', 'm=purchases')}">{PHP.L.tiuorders_mypurchases}</a></li>
							    	<!-- ENDIF -->
							    	<li>{HEADER_USER_PROFILE}</li>
							    	<li>{HEADER_USER_PMREMINDER}</li>
							    	<!-- IF {HEADER_USER_ADMINPANEL} --><li>{HEADER_USER_ADMINPANEL}</li><!-- ENDIF -->
							    	<li>{HEADER_USER_LOGINOUT}</li>
							    </ul>
						  	</div>
						<!-- END: USER -->
						 <div class="clearfix"></div>
					</div>
				</div>
			</div>
		</header>
		<nav class="navbar navbar-default">
			<div class="container">
				<ul class="nav navbar-nav">
					<li<!-- IF {PHP.env.ext} == 'index' --> class="active"<!-- ENDIF -->><a href="{PHP.cgf.mainurl}">{PHP.L.Home}</a></li>
					<!-- IF {PHP.cot_modules.market} -->
					<li<!-- IF {PHP.env.ext} == 'market' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('market')}">{PHP.L.market}</a></li>
					<!-- ENDIF -->
					<li<!-- IF {PHP.env.ext} == 'users' AND ({PHP.group} == 'sellers' AND {PHP.m} == 'main' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('users', 'group=sellers')}">{PHP.L.sellers}</a></li>
					<!-- IF {PHP.cot_modules.forums} -->
					<li<!-- IF {PHP.env.ext} == 'forums' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('forums')}">{PHP.L.Forums}</a></li>
					<!-- ENDIF -->
					<!-- IF {PHP.cot_plugins_active.search} -->
					<li<!-- IF {PHP.env.ext} == 'search' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('plug','e=search')}">{PHP.L.Search}</a></li>
					<!-- ENDIF -->
				</ul>
			</div>
		</nav>
			
		<div id="main" class="container">
		
<!-- END: HEADER -->