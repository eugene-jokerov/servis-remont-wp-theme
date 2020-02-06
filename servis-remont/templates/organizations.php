<?php /* Template Name: Организации */ ?>
<?php get_header(); ?>
	
<div class="page-content">
	<div class="container">
		<div class="page-httl">
			Ремонт компьютерной техники в Москве
		</div>
		<div class="page-sidebar">
			<div class="sidebar">
				<?php jwp_get_template_part( 'parts/side-filter' ); ?>
			</div>
			<div class="content">
				<?php jwp_get_template_part( 'parts/top-filter' ); ?>
				<?php jwp_get_template_part( 'parts/order-box' ); ?>
				
				<div class="prods-list">
					<?php
						$organizations = new WP_Query( array(
							'post_type'      => 'organization',
							'posts_per_page' => 4,
						) );
					?>
					<?php foreach ( $organizations->posts as $organization ) : ?>
						<?php jwp_get_template_part( 'parts/organization', array( 'post' => $organization ) ); ?>
					<?php endforeach; ?>
				</div>
				
				<div class="btn-more-box">
					<div class="btn3">Загрузить еще</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<?php jwp_get_template_part( 'parts/partners' ); ?>

<?php get_footer(); ?>


