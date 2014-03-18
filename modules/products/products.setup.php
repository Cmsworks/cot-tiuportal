<?php
/* ====================
[BEGIN_COT_EXT]
Name=Products
Description=Products
Version=1.0.1
Date=2013-04-10
Author=CMSWorks Team
Copyright=(c) CMSWorks Team 2010-2013
Notes=BSD License
Auth_guests=R
Lock_guests=A
Auth_members=RW1
Lock_members=
Admin_icon=img/adminmenu_products.png
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
markup=01:radio::1:
parser=02:callback:cot_get_parsers():none:
count_admin=03:radio::0:
autovalidateprd=04:radio::1:
maxlistsperpage=06:select:5,10,15,20,25,30,40,50,60,70,100,200,500:30:
title_products=07:string::{TITLE} - {CATEGORY}:
productssitemap=08:radio::1:Включить вывод в sitemap
productssitemap_freq=09:select:default,always,hourly,daily,weekly,monthly,yearly,never:default:Products change frequency
productssitemap_prio=10:select:0.0,0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1.0:0.5:Products priority
description=11:string:::Описание модуля (meta-description по-умолчанию)
[END_COT_EXT_CONFIG]

[BEGIN_COT_EXT_CONFIG_STRUCTURE]
order=01:callback:cot_products_config_order():date:
way=02:select:asc,desc:desc:
maxrowsperpage=03:string::30:
truncateprdtext=04:string::200:
allowemptyprdtext=05:radio::0:
keywords=06:string:::
[END_COT_EXT_CONFIG_STRUCTURE]
==================== */
