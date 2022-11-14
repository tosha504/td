<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package topdrive
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="wrapper">

	<header id="masthead" class="header">
		
		<div class="container">
			<?php 
			$header = get_field('header', 'options');
			if(!empty($header)) { ?> 
				<nav id="mobile-navigation" class="header__mobile-navigation">
					<?php
					if($header) {
						wp_nav_menu(
							array(
								'theme_location' => 'menu-mob',
								'menu_id'        => '',
								'container'		 =>	'',
								'menu_class'	 => 'menu-mobile'
							)
						);?>
						<div class="header__mobile-navigation_links">
							<?php  
							foreach ($header['social_media'] as $key => $social) { ?>
								<a href="<?php echo esc_url($social['link']); ?>" target="_blank" ><?php echo wp_get_attachment_image($social['image'] , 'full'); ?></a>
							<?php } ?>
						</div>
					<?php } ?>
				</nav>
				
				<div class="header__left">
				<?php if(!is_front_page() && !is_checkout() && !is_cart() ) {
					echo do_shortcode('[location_select]');
				} ?>
					<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-left',
								'menu_id'        => '',
								'container'		 =>	'',	
							)
						);
						?>
					</nav><!-- #site-navigation -->
				</div>
				<?php		
				$logo = $header['logo'];
				if( $logo ) { ?>  
					<div class="header__logo">
						<a href="<?php echo esc_url( home_url( '/' ) ) ?>">
						<?php echo wp_get_attachment_image($logo , 'full')  ?></a>  
					</div>
				<?php } ?> 

				<div  class="header__links">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-right',
							'menu_id'        => '',
							'container'		 =>	'',
						)
					);
					?>
					
					<div class="header__links_socials">
					<?php  
					foreach ($header['social_media'] as $key => $social) { ?>
						<a href="<?php echo esc_url($social['link']); ?>" target="_blank" ><?php echo wp_get_attachment_image($social['image'] , 'full'); ?></a>
					<?php } ?>
					</div>
				</div>
				<div class="header__menu-shop">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'cart',
							'menu_id'        => '',
							'menu_class'	 => false,		
							'container'		 =>	false,	
						)
					);?>
					<div class="header__menu-shop_count" <?php echo wc_get_cart_url(); ?>>
					<?php
					global $woocommerce;
					echo sprintf($woocommerce->cart->cart_contents_count); ?>
					</div>
				</div>

				<div class="header__burger"><span></span></div>
			<?php } ?>
		</div>
	</header><!-- #masthead -->
