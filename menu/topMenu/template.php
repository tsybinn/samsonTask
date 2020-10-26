<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
 <div class="menu popup-block">
<ul>

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a <?if($arItem["PARAMS"]["COLORMENU"]):?> class="<?=$arItem["PARAMS"]["COLORMENU"]?>"  <?endif?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				<ul>
					<?if($arItem["PARAMS"]["TEXTMENU"]):?>
					<div class="menu-text"><?=$arItem["PARAMS"]["TEXTMENU"]?></div>
					<?endif?>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" ><?=$arItem["TEXT"]?></a>
				<ul>
					<?if($arItem["PARAMS"]["TEXTMENU"]):?>
					<div class="menu-text"><?=$arItem["PARAMS"]["TEXTMENU"]?></div>
					<?endif?>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<?if($arItem["PARAMS"]["LINKHOME"] == "TRUE" ):?>
				<li class="main-page"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
				<?else:?>
				<li><a <?if($arItem["PARAMS"]["COLORMENU"]):?> class="<?=$arItem["PARAMS"]["COLORMENU"]?>"  <?endif?>  href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
				<?endif?>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>

<?endif?>
     <a href="" class="btn-close"></a>
                    </div>