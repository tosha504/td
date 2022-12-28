<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package topdrive
 */



$footer_left = get_field('footer_left', 'options');
$footer_right = get_field('footer_right', 'options'); ?>

	<footer id="colophon" class="footer">
		<div class="container">
			<?php if(!empty($footer_left)) { ?> 
				<div class="footer__left">
					<div class="footer__left_card">
						<?php  if($footer_left['card_logo']) echo wp_get_attachment_image( $footer_left['card_logo'] , 'full'); ?> 
						<?php if($footer_left["card_description"]) { ?><p class="footer__left_card-text"><?php echo $footer_left["card_description"]; ?></p><?php } ?>
						<?php 
						if($footer_left["social_media"]) {?> 
							<div class="footer__left_card-media">
							<?php foreach ($footer_left["social_media"] as $key => $media) { ?>
								<a href="<?php echo $media['link']; ?>" target="_blank"><?php  echo wp_get_attachment_image( $media['image'] , 'full'); ?></a>
							<?php } ?>
							</div>
						<?php }?>
						<?php  if($footer_left['image_after']) echo wp_get_attachment_image( $footer_left['image_after'] , 'gallery-thumbnail'); ?>
					</div>
				</div>
			<?php } ?>	
			<?php if(!empty($footer_right)) { ?> 
				<div class="footer__right">
					<div class="footer__right_content">
						<?php if($footer_right['title']) { ?><h4 class="footer__right_content-title"><?php echo $footer_right['title']; ?></h4><?php } ?>
						<?php if($footer_right['descr']) { ?><p class="footer__right_content-descr"><?php echo $footer_right['descr']; ?></p><?php } ?>
						<?php if($footer_right['location_links']) { ?>
							<div class="footer__right_content-links">
							<?php foreach ($footer_right['location_links'] as $key => $links) {
								$link = $links['link_loc']; ?>
								<a href="<?php echo  esc_url( $link['url'] )?>" class="btn btn__white" target="_blank" ><?php echo esc_html( $link['title'] ); ?></a>		
							<?php } ?>
							<?php  if($footer_right['image_aft']) echo wp_get_attachment_image( $footer_right['image_aft'] , 'gallery-thumbnail'); ?>
						</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>	
		</div>
	</footer><!-- #colophon -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
