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
						<div class="auth">
							<a href="{PHP|cot_url('login')}">{PHP.L.Login}</a>&nbsp;&#8226;&nbsp;<a href="{PHP|cot_url('users','m=register')}">{PHP.L.Register}</a>
						</div>
						<!-- END: GUEST -->
						<!-- BEGIN: USER -->
						<div class="auth">
							<!-- IF {PHP.cot_modules.profile} -->
							<div><a href="{PHP|cot_url('profile')}">{PHP.L.profile_profile}</a></div>
							<!-- ENDIF -->
							<!-- IF {PHP.cfg.payments.balance_enabled} -->
							<div><a href="{HEADER_USER_BALANCE_URL}">{PHP.L.payments_mybalance}: {HEADER_USER_BALANCE|number_format($this, '2', '.', ' ')} {PHP.cfg.payments.valuta}</a></div>
							<!-- ENDIF -->
							<!-- IF {PHP.cot_plugins_active.myproducts} -->
							<div><a href="{PHP|cot_url('myproducts')}">{PHP.L.myproducts_title}</a></div>
							 <!-- ENDIF -->
							<!-- IF {PHP.cot_plugins_active.tiuorders} -->
							<div><a href="{PHP|cot_url('tiuorders', 'm=sales')}">{PHP.L.tiuorders_mysales}</a></div>
							<div><a href="{PHP|cot_url('tiuorders', 'm=purchases')}">{PHP.L.tiuorders_mypurchases}</a></div>
							 <!-- ENDIF -->
							<div>{HEADER_USER_PROFILE}</div>
							<div>{HEADER_USER_PMREMINDER}</div>
							<div>{HEADER_USER_ADMINPANEL} {HEADER_USER_LOGINOUT}</div>
						</div>
						<!-- END: USER -->
					</div>
				</div>

				<div class="navbar navbar-default">
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
			</div>
		</header>
			
		<div id="main" class="container">
		
<!-- END: HEADER -->