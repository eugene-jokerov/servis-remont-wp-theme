<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="logo">
					<img src="<?php echo jwp_get_assets_url(); ?>img/logo2.png" class="img-fluid" />
				</div>
				<p class="color1">
					Поиск сервисных центров ремонта
«Сервис-Ремонт», 2019 Все права
защищены.
				</p>
				<div class="soc-box">
					<a target="_blank" href=""><i class="fab fa-instagram"></i></a>
					<a target="_blank" href=""><i class="fab fa-vk"></i></a>
					<a target="_blank" href=""><i class="fab fa-facebook-f"></i></a>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">	
				<div class="ttl">Популярные ремонты</div>
				<ul>
					<li><a href="#">Ремонт бытовой техники</a></li>
					<li><a href="#">Ремонт мелкой бытовой техники</a></li>
					<li><a href="#">Ремонт мобильной техники</a></li>
					<li><a href="#">Ремонт кухонной техники</a></li>
					<li><a href="#">Ремонт климатической техники</a></li>
				</ul>				
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">				
				<div class="ttl zero">&nbsp;</div>
				<ul>
					<li><a href="#">Ремонт часов</a></li>
					<li><a href="#">Ремонт электротранспорта</a></li>
					<li><a href="#">Ремонт техники Apple</a></li>
					<li><a href="#">Ремонт ноутбуков</a></li>
					<li><a href="#">Ремонт смартфонов</a></li>
				</ul>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="ttl">Компания</div>
				<ul>
					<li><a href="#">О компании</a></li>
					<li><a href="#">Юридическим лицам</a></li>
					<li><a href="#">Контакты всех сервисов</a></li>
					<li><a href="#">Карта сайта</a></li>
				</ul>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="row">
				<div class="col-lg-7">
					<div class="at1">
						Полная безопасность при оплате заказа
					</div>
					<div class="at2">
						100% Конфиденциальность
					</div>
				</div>
				<div class="col-lg-5 text-right">
					<span>zakaz@сервис-ремонт.ru</span>
					<a class="mail" href="mailto:zakaz@сервис-ремонт.ru">Написать нам</a>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="callpopup" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="close" data-dismiss="modal" aria-label="Close"><img src="<?php echo jwp_get_assets_url(); ?>img/close.png" /></div>          
		<div class="modal-body">
			<div class="form-ttl">Быстрая заявка на ремонт</div>
			<p>
				Опишите поломку, мы передадим ваш
номер телефона в специализированные сервисные
центры, менеджеры свяжутся в вами.
			</p>
			<div class="form1">
				<form name="" action="">				
					<input name="name" placeholder="Ваше имя"/>
					<input name="phone" required placeholder="Ваш телефон"/>
					<textarea placeholder="Опишите Вашу поломку"></textarea>
					<div class="attach">Загрузить фото</div>
					<button class="btn1" type="submit">Отправить</button>					
				</form>
			</div>
		</div>     
    </div>
  </div>
</div>
	<?php wp_footer(); ?>
</body>
</html>

