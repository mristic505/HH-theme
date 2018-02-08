<?php
/*
Template Name: Blog: Standard
*/
?>
<?php get_header(); ?>
<?php
global $wp_query;
global $qode_template_name;
$id = $wp_query->get_queried_object_id();
$qode_template_name = get_page_template_slug($id);
$category = get_post_meta($id, "qode_choose-blog-category", true);
$post_number = esc_attr(get_post_meta($id, "qode_show-posts-per-page", true));
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
$page_object = get_post( $id );
$qode_content = $page_object->post_content;

$blog_content_position = "content_above_blog_list";
if(isset($qode_options['blog_standard_type_content_position'])){
	$blog_content_position = $qode_options['blog_standard_type_content_position'];
}

$sidebar = get_post_meta($id, "qode_show-sidebar", true);

if(get_post_meta($id, "qode_page_background_color", true) != ""){
    $background_color = 'background-color: '.esc_attr(get_post_meta($id, "qode_page_background_color", true));
}else{
    $background_color = "";
}

$content_style = "";
if(get_post_meta($id, "qode_content-top-padding", true) != ""){
    if(get_post_meta($id, "qode_content-top-padding-mobile", true) == 'yes'){
        $content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px !important";
    }else{
        $content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px";
    }
}

if(isset($qode_options['blog_standard_type_number_of_chars']) && $qode_options['blog_standard_type_number_of_chars'] != "") {
    qode_set_blog_word_count(esc_attr($qode_options['blog_standard_type_number_of_chars']));
}

?>
<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
    <script>
        var page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)); ?>;
    </script>
<?php } ?>

<?php get_template_part( 'title' ); ?>
<?php get_template_part('slider'); ?>

    <div style="padding-left: 0px; padding-right: 0px;" <?php qode_inline_style($background_color); ?>>

        <?php if ( has_post_thumbnail() ) : ?>
            <div style="max-width: 100% !important;" class="featured-image-holder">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="header-title"> 
                <?php echo get_field('header_title'); ?>   
            </div>                  
        <?php endif; ?>


        
			<?php if($qode_options['overlapping_content'] == 'yes') {?>
				<div class="overlapping_content"><div class="overlapping_content_inner">
			<?php } ?>
        <div class="container_inner default_template_holder" <?php qode_inline_style($content_style); ?>>
            <?php if(($sidebar == "default")||($sidebar == "")) : ?>
                <?php
                echo apply_filters('the_content', wp_kses_post($qode_content));
				query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
                get_template_part('templates/blog/blog', 'structure');
                ?>
            <?php elseif($sidebar == "1" || $sidebar == "2"): ?>
				<?php
					if($blog_content_position != "content_above_blog_list"){
						echo apply_filters('the_content', wp_kses_post($qode_content));
					}
				?>
                <div class="<?php if($sidebar == "1"):?>two_columns_66_33<?php elseif($sidebar == "2") : ?>two_columns_75_25<?php endif; ?> background_color_sidebar grid2 clearfix">
                    <div class="column1 content_left_from_sidebar">
                        <div class="column_inner">
                            <?php
							if($blog_content_position == "content_above_blog_list"){
								echo apply_filters('the_content', wp_kses_post($qode_content));
							}
							query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
                            get_template_part('templates/blog/blog', 'structure');
                            ?>
                        </div>
                    </div>
                    <div class="column2">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php elseif($sidebar == "3" || $sidebar == "4"): ?>
				<?php
					if($blog_content_position != "content_above_blog_list"){
						echo apply_filters('the_content', wp_kses_post($qode_content));
					}
				?>
                <div class="<?php if($sidebar == "3"):?>two_columns_33_66<?php elseif($sidebar == "4") : ?>two_columns_25_75<?php endif; ?> background_color_sidebar grid2 clearfix">
                    <div class="column1">
                        <?php get_sidebar(); ?>
                    </div>
                    <div class="column2 content_right_from_sidebar">
                        <div class="column_inner">
                            <?php
                            if($blog_content_position == "content_above_blog_list"){
								echo apply_filters('the_content', wp_kses_post($qode_content));
							}
							query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
                            get_template_part('templates/blog/blog', 'structure');
                            ?>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        </div>
				<?php if($qode_options['overlapping_content'] == 'yes') {?>
					</div></div>
				<?php } ?>
    </div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>