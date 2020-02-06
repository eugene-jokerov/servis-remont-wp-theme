<div class="prod">
	<div class="top">
		<div class="name">
			<b><?php echo esc_attr( $post->post_title ); ?></b>
			<div class="p-rev">10 отзывов</div>
			<div class="p-star"><?php echo get_field( 'рейтинг', $post->ID ); ?></div>
		</div>
		<div class="p-oc"><span class="open">Сейчас открыто</span></div>
		
	</div>
	<div class="middle">
		<div class="box">
			<div class="txt">
				<div class="ttl"><?php echo get_field( 'специализация', $post->ID ); ?></div>
				<?php if ( have_rows( 'услуги', $post->ID ) ) : ?>
					<ul class="ul">
						<?php while ( have_rows( 'услуги', $post->ID ) ) : the_row(); ?>
							<li><?php the_sub_field( 'услуга' ); ?></li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<div class="box">
			<div class="row">
				<div class="col-xl-6">
					<div class="cont1">
						<div class="addr"><?php echo get_field( 'адрес', $post->ID ); ?></div>
						<div class="metro"><?php echo get_field( 'метро', $post->ID ); ?></div>
						<div class="time"><?php echo get_field( 'время_работы', $post->ID ); ?></div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="cont2">
						<div class="p-logo"><img src="<?php echo get_the_post_thumbnail_url( $post->ID ); ?>" class="img-fluid" /></div>
						<a class="p-phone" href="tel:<?php echo str_replace( array( ' ', '(', ')', '-' ), '', get_field( 'телефон', $post->ID ) ); ?>"><?php echo get_field( 'телефон', $post->ID ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
