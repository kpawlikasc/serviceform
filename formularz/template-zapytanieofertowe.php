<?php
/**
 * The template for displaying with sidebar pages.
 *
 * Template Name: Zapytanie ofertowe
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' ); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header">
						<?php
						storefront_post_thumbnail( 'full' );
						the_title( '<h1 class="entry-title">', '</h1>' );
						?>
					</header><!-- .entry-header -->
					
					<div class="entry-content content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
					
					
					<form id="contact-form" name="contact-form" method="post" action="<?= esc_url( get_template_directory_uri() . '/inc/forms/submit/submit.php' ) ?>">
					
					
						<div class="form-group">
						
						
							<label for="name"><?= get_field( 'name_label' ) ?></label>
							
							
							<input type="text" id="name" name="name" required/>
							
						
						</div>
					
					
						<div class="form-group">
						
						
							<label for="company_name"><?= get_field( 'company_label' ) ?></label>
							
							
							<input type="text" id="company_name" name="company_name" />
							
						
						</div>
					
					
						<div class="form-group">
						
						
							<label for="phone"><?= get_field( 'phone_label' ) ?></label>
							
							
							<input type="text" id="phone" name="phone" />
							
						
						</div>
					
					
						<div class="form-group">
					
					
							<label for="email"><?= get_field( 'email_label' ) ?></label>
							
							
							<input type="email" id="email" name="email" required/>
							
						
						</div>
					
					
						<div class="form-group">
					
						
							<label for="description"><?= get_field( 'description_label' ) ?></label>
							
							
							<textarea id="description" name="description" rows="7" required></textarea>
							
						
						</div>
					
					
						<div class="form-group captcha">
					
						
							<label for="captcha"><?= get_field( 'captcha_label' ) ?></label>
							
							
							<div class="inline-middle">
							
							
								<?php
									$value1 = rand( 1, 9 );
									$value2 = rand( 1, 9 );
									$sum = $value1 + $value2;
								?>
								
									
								<span><?= $value1 ?>&nbsp;+&nbsp;<?= $value2 ?>&nbsp;=&nbsp;</span>
								
								
								<input name="captcha-result" type="hidden" value="<?= esc_attr( $sum ) ?>" required />
								
								
								<input name="captcha" type="text" required />
								
								
							</div>
							
						
						</div>
						
						
						<button type="submit" class="subbmit-button"><?= get_field( 'button_label' ) ?></button>
					
					
					</form>
					
					
				</div>	
					
				<?php
				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );
			
			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar_page' );
get_footer();
