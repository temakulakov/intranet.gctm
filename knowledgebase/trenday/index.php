<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Трендельник"); ?><style>
	.trendelnik {
		padding: 30px 60px;
	}

	.trendelnik * {
		font-family: "Inter";
		box-sizing: border-box;
		padding: 0;
		margin: 0;
		border: 0;
		color: #000;
	}

	.trendelnik .container {
		margin: 0 auto;
		background-image: url(../../local/templates/bitrix24/images/404.png);
		background-size: auto auto;
		background-position: bottom right;
		background-repeat: no-repeat;
		padding-bottom: 360px;
	}

	.trendelnik h1 {
		margin-bottom: 25px;
		font-size: 48px;
		line-height: 60px;
		font-weight: 700;
	}

	.trendelnik p {
		margin-bottom: 60px;
	}

	.trendelnik__btn {
		padding: 20px 84px;
		font-weight: 700;
		font-size: 16px;
		line-height: 25px;
		border-radius: 14px;
		display: inline-block;
		background-color: #B7274C;
		color: #fff;
		transition: 0.3s;
	}

	.trendelnik__btn:hover {
		color: #fff;
		background-color: #891635;
	}
</style> <section class="trendelnik">
<div class="container">
	 <!-- <a href="" class="previous-page-btn"><img src="" alt="">← Вернуться</a> -->
	<h1>Трендельники</h1>
	<p>
		Запрашиваемая страница находится в разработке.
	</p>
 <a href="/knowledgebase/" class="trendelnik__btn btn">
	На главную </a>
</div>
 </section><?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>