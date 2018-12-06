<?php
/**
 * The template for displaying with sidebar pages.
 *
 * Template Name: Zapytanie serwisowe
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
					
					
					<form id="contact-form" name="contact-form" method="post" action="<?= esc_url( get_template_directory_uri() . '/inc/forms/submit/submit-service.php' ) ?>">
					
					
						<div class="form-group">
						
						
							<label for="imie_i_nazwisko"><?= get_field( 'imie_i_nazwisko_label' ) ?></label>
							
							
							<input type="text" id="imie_i_nazwisko" name="imie_i_nazwisko" required/>
							
						
						</div>
					
					
						<div class="form-group">
						
						
							<label for="nazwa_firmy"><?= get_field( 'nazwa_firmy_label' ) ?></label>
							
							
							<input type="text" id="nazwa_firmy" name="nazwa_firmy" />
							
						
						</div>
					
					
						<div class="form-group">
						
						
							<label for="adress"><?= get_field( 'adress_label' ) ?></label>
							
							
							<input type="text" id="adress" name="adress" required/>
							
						
						</div>
					
					
						<div class="form-group">
					
					
							<label for="emails"><?= get_field( 'emails_label' ) ?></label>
							
							
							<input type="email" id="emails" name="emails" required/>
							
						
						</div>
                        
                        <div class="form-group">
					
					
							<label for="numer_telefonu"><?= get_field( 'numer_telefonu_label' ) ?></label>
							
							
							<input type="text" id="numer_telefonu" name="numer_telefonu" required/>
							
						
                        </div>

                        <div class="form-group">
					
					
							<label for="model_urzadzenia"><?= get_field( 'model_urzadzenia_label' ) ?></label>
							
							
							<input type="text" id="model_urzadzenia" name="model_urzadzenia" required/>
							
						
						</div>
                        
                        <div class="form-group">
					
						
							<label for="opis_usterki"><?= get_field( 'opis_usterki_label' ) ?></label>
							
							
							<textarea id="opis_usterki" name="opis_usterki" rows="7" required></textarea>
							
						
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
