<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php the_title(); ?></title>
	<?php wp_head(); ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div class="header">
	<div class="container">
		<div class="row d-flex justify-content-between align-items-center">
			<div class="logo-box">
				<div class="logo">
					<a href="/"><img src="<?php echo jwp_get_assets_url(); ?>img/logo.png" class="img-fluid" /></a>				
				</div>
			</div>
			<div class="city-box">
				<div class="city">
					Ваш город: <span>Иркутск</span>
				</div>
			</div>				
			<div class="soc-box">
				<a target="_blank" href=""><i class="fab fa-instagram"></i></a>
				<a target="_blank" href=""><i class="fab fa-vk"></i></a>
				<a target="_blank" href=""><i class="fab fa-facebook-f"></i></a>
			</div>
			<div class="mail-box">
				<span>zakaz@сервис-ремонт.ru</span>
				<a href="mailto:zakaz@сервис-ремонт.ru">написать нам</a>	
			</div>
			<div class="btn-box">
				<div class="btn1" data-toggle="modal" data-target="#callpopup">Заявка на ремонт</div>
			</div>			
		</div>
	</div>	
	<div class="menu-btn"><span></span><span></span><span></span></div>
</div>

<div class="menu-box">
	<div class="container">
		<div class="d-flex">
			<a href="#" class="btn-cat"><i class="fas fa-bars"></i> Каталог работ</a>
			<div class="mm">
				<div class="menu">
					<div class="items">
						<a class="item" href="#">Главная</a>
						<a class="item" href="about.html">О компании</a>
						<a class="item" href="yur.html">Юридическим лицам</a>
						<a class="item" href="4-services.html">Контакты всех сервисов</a>
					</div>		
				</div>
				<div class="search-box">					
					<input type="text" name="" class="search" placeholder="Поиск..."/>
					<div class="search-btn"></div>
				</div>
			</div>
		</div>
	</div>
</div>
