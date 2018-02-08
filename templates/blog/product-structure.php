<div class="product-loop">
						<?php 
						global $wp_query;
						$query = new WP_Query(array_merge(
						$wp_query->query, 
						array(
						    'post_type' => 'any'
						    )
						));

						while($query->have_posts()) : $query->the_post(); 
						 ?>

							<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							    <div class="product-header clearfix" style="background-color: <?php echo get_field('background_color'); ?>; min-height: 0px;">
							    	<?php the_content(); ?>
							    	<div class="clearfix"></div>
							    	<div class="product-container">
							    		
							    	<div class="product-logo-holder">	
							    		<img class="product-logo" src="<?php echo get_field('product_logo'); ?>">
							    		<div class="link-to-product"><?php echo get_field('product_website_link'); ?></div>
							    	</div>
							    	<div class="product-description"><?php echo get_field('product_description'); ?></div>
							    	</div>
							    </div>
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="product-image-holder">
										<?php the_post_thumbnail(); ?>		
									</div>					
								<?php endif; ?>
							</div>

						<?php endwhile; wp_reset_query(); ?>
						

</div>