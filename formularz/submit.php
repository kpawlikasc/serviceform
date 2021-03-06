<?php


	//Load WordPress functions.
	require_once( '../../../../../../wp-load.php' );

	
	


	if ( $notification_email = get_field( 'send_to_email', 173 ) ) {


		if ( isset( $_POST[ 'name' ] ) && $_POST[ 'name' ] ) {


			if ( isset( $_POST[ 'email' ] ) && $_POST[ 'email' ] ) {


				if ( isset( $_POST[ 'description' ] ) && $_POST[ 'description' ] ) {
					
					
					//Load the captcha validation template.
					get_template_part( 'inc/forms/validation/captcha' );

					
					
					//Whether the notification email email address is not empty.
					if ( $notification_email ) {
						
						
						$content = '<h2 style="font-size:16px;">Imię i nazwisko:</h2>' .
						'<p>' . $_POST[ 'name' ] . '</p>' .
						
						
						( isset( $_POST[ 'company_name' ] ) && $_POST[ 'company_name' ] ? '<h2 style="font-size:16px;">Nazwa firmy:</h2>' .
						'<p>' .  $_POST[ 'company_name' ] . '</p>' : '' ) .
						
						
						( isset( $_POST[ 'phone' ] ) && $_POST[ 'phone' ] ? '<h2 style="font-size:16px;">Telefon:</h2>' .
						'<p>' .  $_POST[ 'phone' ] . '</p>' : '' ) .
						
						
						'<h2 style="font-size:16px;">E-mail:</h2>'.
						'<p>' . strtolower( $_POST[ 'email' ] ) . '</p>' .
						
						
						'<h2 style="font-size:16px;">Treść zapytania:</h2>'.
						'<p>' . nl2br( $_POST[ 'description' ] ) . '</p>';

								
						//Whether the notification email template is not empty.
						if ( $content ) {
							
							
							//Submit the notification email.
							$is_submit = wp_mail (
							
								$notification_email,
								
								'Zapytanie ofertowe - ascpro.pl',
								
								$content,
								
								array('Content-Type: text/html; charset=UTF-8')
							
							);


							//Whether the email is not submit.
							if ( !$is_submit ) {


								//Display the error notification.
								echo json_encode(

									array(
									
										'status' => 'error',

										'title' => _x( 'Wystąpił błąd', 'Form notification' ),

										'content' => _x( 'Spróbuj ponownie.', 'Form notification' )
									) 

								);
							
							
								exit();
								
								
							}
							
							
						}
						
						
					}


					$html = get_field( 'email-confirmation-text', 173 );

					
					//Whether the confirmation email template is not empty.
					if ( $html ) {
						
						
						//Submit the confirmation email.
						$is_submit = wp_mail (
						
							$_POST[ 'email' ],
							
							'Potwierdzenie wysłania zapytania ofertowego.',
							
							$html,
								
							array('Content-Type: text/html; charset=UTF-8')
						
						);


						//Whether the email is not submit.
						if ( !$is_submit ) {


							//Display the error notification.
							echo json_encode(

								array(
								
									'status' => 'error',

										'title' => _x( 'Wystąpił błąd', 'Form notification' ),

										'content' => _x( 'Spróbuj ponownie.', 'Form notification' )
								) 

							);
						
						
							exit();
							
							
						}
						
						
					}


					//Display the success notification.
					echo json_encode(
					
						array(
						
							'status' => 'success',

							'title' => _x( 'Dziękujemy za wiadomość.', 'Form notification' ),

							'content' => _x( 'Skontaktujemy się wkrótce.', 'Form notification' )
						) 
					
					);
				
				//end description
				} else {


					echo json_encode ( 
					
						array ( 
							'status' => 'error',
							'title' => _x( 'Wypełnij pole obowiązkowe', 'Form notification' ),
							'content' => _x( '<strong>Opis</strong>.', 'Form notification' )
						)
						
					);
					
					
				}
			
			
			} else {


				echo json_encode( 
				
					array (
						'status' => 'error',
						'title' => _x( 'Wypełnij pole obowiązkowe', 'Form notification' ),
						'content' => _x( '<strong>Adres e-mail</strong>.', 'Form notification' )
					)
					
				);
				
				
			}
			
			
		} else {
			
			
			echo json_encode(
			
				array (
				
					'status' => 'error',
					'title' => _x( 'Wypełnij pole obowiązkowe', 'Form notification' ),
					'content' => _x( '<strong>Nazwa</strong>.', 'Form notification' )
				
				)
			
			);
			
			
		}
			
			
	} else {


		echo json_encode( 
			
			array (
				'status' => 'error',
				'title' => _x( 'Wystąpił błąd formularza', 'Form notification' ),
				'content' => _x( 'Prosimy o kontakt przez e-mail lub telefon.', 'Form notification' )
			)
			
		);
		
		
	}
	
	
?>