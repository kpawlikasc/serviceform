<?php


	//Load WordPress functions.
    require_once( '../../../../../../wp-load.php' );
    

	
	


	if ( $notification_email = get_field( 'send_to_email', 7081 ) ) {


		if ( isset( $_POST[ 'imie_i_nazwisko' ] ) && $_POST[ 'imie_i_nazwisko' ] ) {


			if ( isset( $_POST[ 'adress' ] ) && $_POST[ 'adress' ] ) {


                if ( isset( $_POST[ 'emails' ] ) && $_POST[ 'emails' ] ) {
                    
                    
                    if ( isset( $_POST[ 'numer_telefonu' ] ) && $_POST[ 'numer_telefonu' ] ) {
                    
                    
                    if ( isset( $_POST[ 'model_urzadzenia' ] ) && $_POST[ 'model_urzadzenia' ] ) {


                    if ( isset( $_POST[ 'opis_usterki' ] ) && $_POST[ 'opis_usterki' ] ) {


					//Load the captcha validation template.
					get_template_part( 'inc/forms/validation/captcha' );

					
					
					//Whether the notification email email address is not empty.
					if ( $notification_email ) {
						
						
						$content = '<h2 style="font-size:16px;">Imię i nazwisko:</h2>' .
						'<p>' . $_POST[ 'imie_i_nazwisko' ] . '</p>' .
						
						
						( isset( $_POST[ 'nazwa_firmy' ] ) && $_POST[ 'nazwa_firmy' ] ? '<h2 style="font-size:16px;">Nazwa firmy:</h2>' .
                        '<p>' .  $_POST[ 'nazwa_firmy' ] . '</p>' : '' ) .
                        

                        '<h2 style="font-size:16px;">Adres:</h2>' .
						'<p>' .  $_POST[ 'adress' ] . '</p>' .
						
						
                        '<h2 style="font-size:16px;">E-mail:</h2>'.
                        '<p>' . strtolower( $_POST[ 'emails' ] ) . '</p>' .


                        '<h2 style="font-size:16px;">Telefon:</h2>' .
                        '<p>' .  $_POST[ 'numer_telefonu' ] . '</p>' .

                        
                        '<h2 style="font-size:16px;">Model urządzenia:</h2>' .
						'<p>' .  $_POST[ 'model_urzadzenia' ] . '</p>' .
						
						
						'<h2 style="font-size:16px;">Treść usterki:</h2>'.
						'<p>' . nl2br( $_POST[ 'opis_usterki' ] ) . '</p>';

								
						//Whether the notification email template is not empty.
						if ( $content ) {
							
							
							//Submit the notification email.
							$is_submit = wp_mail (
							
								$notification_email,
								
								'Zapytanie serwisowe - ascpro.pl',
								
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


					$html = get_field( 'email-confirmation-text', 7081 );

					
					//Whether the confirmation email template is not empty.
					if ( $html ) {
						
						
						//Submit the confirmation email.
						$is_submit = wp_mail (
						
							$_POST[ 'email' ],
							
							'Potwierdzenie wysłania zapytania serwisowego.',
							
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
                            'content' => _x( '<strong>Adres</strong>.', 'Form notification' )
                        )
                        
                    );
                    
                    
                }
                } else {


                    echo json_encode ( 
                    
                        array ( 
                            'status' => 'error',
                            'title' => _x( 'Wypełnij pole obowiązkowe', 'Form notification' ),
                            'content' => _x( '<strong>Numer telefonu</strong>.', 'Form notification' )
                        )
                        
                    );
                    
                    
                }
                } else {


                    echo json_encode ( 
                    
                        array ( 
                            'status' => 'error',
                            'title' => _x( 'Wypełnij pole obowiązkowe', 'Form notification' ),
                            'content' => _x( '<strong>Model urządzenia</strong>.', 'Form notification' )
                        )
                        
                    );
                    
                    
                }
				} else {


					echo json_encode ( 
					
						array ( 
							'status' => 'error',
							'title' => _x( 'Wypełnij pole obowiązkowe', 'Form notification' ),
							'content' => _x( '<strong>Opis usterki</strong>.', 'Form notification' )
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
					'content' => _x( '<strong>Imię i nazwisko</strong>.', 'Form notification' )
				
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