<div class="row expanded">

<header id="front-hero" role="banner">
	<div class="marketing">
		<div class="tagline">
			<h1><span style="color:#FF6908;">asdb</span>Base</h1>
			<h4 class="subheader">Стартовый шаблон WordPress<br />премиум классса от студии <span style="font-weight:bold;color:#FF6908;">asdb</span></h4>
		    <a role="button" class="download large button sites-button hide-for-small-only" href="https://asdbthemes.ru/downloads/">Download asdbBase</a>
		</div>
		<div id="watch">
		На базе фреймворка <a href="https://github.com/olefredrik/asdbbase">Foundation 6.2</a>.<br />
		Внедрены оригинальные виджеты от команды asdb <br />
		Настройка шаблона из панели администратора <br />
		Настройка произвольных типов записей <br />
		Настраиваемый 1, 2, 3 колоночный вывод записей.
		</div>

	</div>

</header>


<?php while ( have_posts() ) : the_post(); ?>
<section class="intro" role="main">
	<div class="fp-intro">

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'asdbbase_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'asdbbase' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
		</div>

	</div>

</section>
<?php endwhile;?>

<div class="section-divider">
	<hr />
</div>


<section class="benefits">
	<header>
		<h2>Построено на базе Foundation, работает на WordPress</h2>
		<h4>Фреймвок <strong>Foundation</strong> - выбор профессиональных разработчиков, дизайнеров и веб студий. <br /> WordPress на сегодняшний день самая популярная CMS в мире ( 38% сайтов построено на WordPress ).</h4>
	</header>

	<div class="semantic">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/demo/semantic.svg" alt="semantic">
		<h3>Разметка</h3>
		<p>Чистая семантичаская разметка, полная функциональность без ущерба для скорости загрузки.</p>
	</div>

	<div class="responsive">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/demo/responsive.svg" alt="responsive">
		<h3>Адаптивность</h3>
		<p>Дизайн построен на принципе mobile first, полностью адаптивный дизайн для всех типов устройств.</p>

	</div>

	<div class="customizable">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/demo/customizable.svg" alt="customizable">
		<h3>Настраиваемость</h3>
		<p> Шаблон имеет высокую управляемость и настраиваемость из административной панели.</p>

	</div>

	<div class="professional">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/demo/professional.svg" alt="professional">
		<h3>Поддержка</h3>
		<p> Миллионы дизайнеров и разработчиков используют Foundation. Вы сможете получить помощь сообщества разработчиков.</p>
	</div>

	<div class="why-foundation">
		<a href="https://asdbthemes.ru/asdbbase/elements">Элементы дизайна →</a>
	</div>

</section>
</div>