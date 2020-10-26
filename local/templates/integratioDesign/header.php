<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <?$APPLICATION->ShowHead();?>

	<title><?$APPLICATION->ShowTitle()?></title>

  <?  use Bitrix\Main\Page\Asset;
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/template_style.css");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-1.8.2.min.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/slides.min.jquery.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.carouFredSel-6.1.0-packed.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/functions.js");

  ?>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
	<div class="wrap">
		<div class="hd_header_area">
			<div class="hd_header">
				<table>
					<tr>
						<td rowspan="2" class="hd_companyname">
							<h1><a href=""><?=GetMessage('CFT_MAIN')?></a></h1>
						</td>
						<td rowspan="2" class="hd_txarea">
							<span class="tel">            <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    ".default",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/local/templates/integratioDesign/include/phone.php"
                                    ),
                                    false
                                );?></span>	<br/>
							время работы <span class="workhours">ежедневно с 10-00 до 20-00</span>
						</td>
						<td style="width:232px">
							<form action="">
								<div class="hd_search_form" style="float:right;">
									<input placeholder="<?=GetMessage('CFT_SEARCH')?>" type="text"/>
									<input type="submit" value=""/>
								</div>
							</form>
						</td>
					</tr>
					<tr>
						<td style="padding-top: 11px;">
							<span class="hd_singin"><a id="hd_singin_but_open" href=""><?=GetMessage('LOG_IN')?></a>
							<div class="hd_loginform">
								<span class="hd_title_loginform"><?=GetMessage('LOG_IN')?></span>
								<form name="" method="" action="">
					
									<input placeholder="Логин"  type="text">
									<input  placeholder="Пароль"  type="password">			
									<a href="/" class="hd_forgotpassword"><?=GetMessage('FOGOT_PASSWORD')?>Забыли пароль</a>
									
									<div class="head_remember_me" style="margin-top: 10px">
										<input id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" type="checkbox">
										<label for="USER_REMEMBER_frm" title="Запомнить меня на этом компьютере">Запомнить меня</label>
									</div>				
									<input value="Войти" name="Login" style="margin-top: 20px;" type="submit">
									</form>
								<span class="hd_close_loginform">Закрыть</span>
							</div>
							</span><br>
							<a href="" class="hd_signup"><?=GetMessage('REGISTER')?></a>
						</td>
					</tr>
				</table>
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"horizontal_multilevel1", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "top",
		"COMPONENT_TEMPLATE" => "horizontal_multilevel1",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N"
	),
	false
);?>
			</div>
		</div>
		
		<!--- // end header area --->
        <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"template1",
	array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "1",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?>
<!--		<div class="bc_breadcrumbs">-->
<!--			<ul>-->
<!--				<li><a href="">Каталог</a></li>-->
<!--				<li><a href="">Мебель</a></li>-->
<!--				<li><a href="">Выставки и события</a></li>-->
<!--			</ul>-->
<!--			<div class="clearboth"></div>-->
<!--		</div>-->


		<div class="main_container page">
			<div class="mn_container">
				<div class="mn_content">
					<div class="main_post">
						<div class="main_title">
							<p class="title"><?$APPLICATION->ShowTitle()?></p>
						</div>
		