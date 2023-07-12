<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?> 
<section class="album">
    <pre>
        <?// print_r($arResult); ?>
    </pre>
	<div class="container">
		<a href="javascript:history.back();" class="previous-page-btn">← Вернуться</a>
		<h1><?= $arResult['NAME'] ?> <?if($arResult['PROPERTIES']['DATE']['VALUE']):?>от<?endif;?> <?= $arResult['PROPERTIES']['DATE']['VALUE'] ?></h1>
		<div class="album__grid">
			<? foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $photoID) : ?>
				<?
                    $photoBig = CFile::GetPath($photoID);
                    $photo = CFile::ResizeImageGet($photoID, array('width'=>512, 'height'=>512), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
				<a class="grid-item" data-fancybox="gallery" href="<?= $photoBig ?>">
					<img src="<?= $photo['src'] ?>" alt="">
				</a>
			<? endforeach; ?>
		</div>
	</div>
</section>

<script type="text/javascript">
    function galleryGrid(){
        gallery = new Masonry('.album__grid', {
            columnWidth: 260,
            gutter: 20,
        });
    }
    setTimeout(galleryGrid, 100);
    setTimeout(galleryGrid, 300);

	$('[data-fancybox="gallery"]').fancybox({
		infobar: false,
		buttons: ["close"]
	});
    console.log('test');
</script>