<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->SetViewTarget("NAME_Product");?>
<p><?=$arResult["NAME"]?></p>
<?$this->EndViewTarget();?>
<?echo($arResult["ORIGINAL_PARAMETERS"]["CURRENT_BASE_PAGE"])?>
<div class="catalog-detail">
	<div class="catalog-item">
<?
$width = 0;
if($arParams['DETAIL_SHOW_PICTURE'] != 'N' && (is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"]))):
    ?>
		<div class="catalog-item-image">
<?
	if(is_array($arResult["DETAIL_PICTURE"])):
		$width = $arResult["DETAIL_PICTURE"]["WIDTH"];
?>
			<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
<?
	elseif(is_array($arResult["PREVIEW_PICTURE"])):
		$width = $arResult["PREVIEW_PICTURE"]["WIDTH"];
?>
			<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
<?
	endif;
?>
		</div>
<?
endif;
?>
		<div class="catalog-item-desc<?=$width < 300 ? '-float' : ''?>">
<?
if($arResult["DETAIL_TEXT"]):
	echo $arResult["DETAIL_TEXT"];
elseif($arResult["PREVIEW_TEXT"]):
	echo $arResult["PREVIEW_TEXT"];
endif;
?>
		</div>
<?
foreach($arResult["PRICES"] as $code=>$arPrice):
?>
	<?if($arPrice["PRINT_VALUE"] > 0):?>
		<div class="catalog-item-price"><span><?=GetMessage('CR_PRICE')?>:</span> <?=$arPrice["PRINT_VALUE"]?></div>
	<?endif;?>
<?
endforeach;
?>

<?
if (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0):
	$cnt = 0;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
		if ($pid != 'PRICE' && $pid != 'PRICECURRENCY'):
			if ($cnt == 0):
				$cnt++;
?>
		<div class="catalog-item-properties">
			<div class="catalog-item-properties-title"><?=GetMessage("CATALOG_CHAR")?></div>
<?
			endif;
?>

			<div class="catalog-item-property">
				<span><?=$arProperty["NAME"]?></span>
				<b><?
			if(is_array($arProperty["DISPLAY_VALUE"])):
				echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
			elseif($pid=="MANUAL"):
?>
					<a href="<?=$arProperty["VALUE"]?>"><?=GetMessage("CATALOG_DOWNLOAD")?></a>
<?
			else:
				echo $arProperty["DISPLAY_VALUE"];
			endif;
				?></b>
			</div>
<?
		endif;
	endforeach;
	
	if ($cnt > 0):
?>
		</div>
<?
	endif;
endif;

if(is_array($arResult["SECTION"])):
?>
		<br /><a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>">&larr; <?=GetMessage("CATALOG_BACK")?></a>
<?
elseif (is_array($arResult['IBLOCK'])):
?>
		<br /><a href="<?=$arResult["IBLOCK"]["LIST_PAGE_URL"]?>">&larr; <?=GetMessage("CATALOG_BACK")?></a>
<?
endif;
?>

        <a href="#wantСheaperForm"  class="wantСheaper">Хочу дешевле</a>

        <div id="wantСheaperForm"  artnumber="<?=$arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]?>">
            <form id="f_want_p">
                <label for="f_name">Фамилия</label><br>
                <input type="text" id="LAST_NAME" value="<?=$arResult["USER"]["LAST_NAME"]?>"> <br>
                <label for="f_name">Имя</label><br>
                <input type="text" id="NAME" value="<?=$arResult["USER"]["NAME"]?>" ><br>
                <label for="f_name">Отчество</label><br>
                <input type="text" id="SECOND_NAME" value="<?=$arResult["USER"]["SECOND_NAME"]?>"><br>
                <label for="f_name">Телефон</label><br>
                <input type="text" id="PERSONAL_MOBILE"  value="<?=$arResult["USER"]["PERSONAL_MOBILE"]?>" ><br>
                <label for="f_name">Желаемая цена</label><br>
                <input type="text" id="WANT_PRICE" >
                 <button id="send_want_p">Отправить</button>

            </form>
        </div>


	</div>
</div>

<script>

    $(".wantСheaper").fancybox();

    $(document).on('click', '#send_want_p', function (e) {

      $(".catalog-item-price").children().remove();
        $("#f_want_p").submit(function () {
            return false;
        });
        if ($('#comment').val() == "" && $('select').val() == 3) {
            $('#comment').css('border-color', 'red');
        } else {
             var formData = new FormData();
            formData.append('NAME_PROD', "<?=$arResult['NAME']?>");
            formData.append('ARTNUMBER', $("#wantСheaperForm").attr("artnumber"));
            formData.append('NAME', $("#NAME").val());
            formData.append('LAST_NAME', $("#LAST_NAME").val());
            formData.append('SECOND_NAME', $("#SECOND_NAME").val());
            formData.append('PERSONAL_MOBILE', $("#PERSONAL_MOBILE").val());
            formData.append('USER_ID', '<?=$_SESSION["SESS_AUTH"]["USER_ID"]?>');
            formData.append('DETAIL_URL', '<? echo $arResult["ORIGINAL_PARAMETERS"]["CURRENT_BASE_PAGE"]?>');
            formData.append('PRICE', $(".catalog-item-price").html());
            formData.append('WANT_PRICE',$("#WANT_PRICE").val());



            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]);
            }
            jQuery.ajax({
                url: '/local/templates/MY_furniture_dark-blue/components/bitrix/catalog/.default/bitrix/catalog.element/.default/ajax/addHighLoad.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType: 'html',
                success: function (response) {
                    console.log(response);
                    $.fancybox(response, {
                        // fancybox API options
                        fitToView: false,
                        width: 700,
                        height: 400,
                        autoSize: true,
                        closeClick: false,
                        openEffect: 'none',
                        closeEffect: 'none'
                    }); // fancybox
                    $(document).on('click', '.fancybox-close', function (e) {
                        location.reload();
                    });
                }
            });
        }
    });


</script>
