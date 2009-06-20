<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>

<div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
			    <a class="sh2" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( "Permanent Link to ", "wptouch" ); ?><?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a>
			        <div class="single-post-meta-top"><?php echo get_the_time('M jS, Y @ h:i a') ?> &rsaquo; <?php the_author() ?><br />

		<!-- Let's check for DISQUS... we need to skip to a different div if it's installed and active -->		
		<?php if ('open' == $post->comment_status)) : ?>
		<?php if (function_exists('dsq_comments_template')) { ?>
	 		<a href="#dsq-add-new-comment">&darr; <?php _e( "Skip to comments", "wptouch" ); ?></a></div>
		<?php } elseif (function_exists('id_comments_template')) { ?>
			<a href="#idc-container-parent">&darr; <?php _e( "Skip to comments", "wptouch" ); ?></a></div>
		<?php } elseif (isset($post->comment_count) && $post->comment_count == 0) { ?>
			<a href="#respond">&darr; <?php _e( "Leave a comment", "wptouch" ); ?></a></div>
		<?php } else { ?>
			<a href="#com-head">&darr; <?php _e( "Skip to comments", "wptouch" ); ?></a></div>		
		<?php } endif; ?>
		<div class="clearer"></div>
	</div>

         <div class="post" id="post-<?php the_ID(); ?>">
         	<div id="singlentry" class="<?php echo $wptouch_settings['style-text-size']; ?> <?php echo $wptouch_settings['style-text-justify']; ?>">
            	<?php the_content(); ?>				
			</div>  
			
<!-- Categories and Tags post footer -->        

			<div class="single-post-meta-bottom">
				<?php link_pages('<div class="post-page-nav">' . __( "Article Pages", "wptouch" ) . ': ', '</div>', 'number', ' &raquo;', '&laquo; '); ?>          
			    <?php _e( "Categories", "wptouch" ); ?>: <?php if (the_category(', ')) the_category(); ?>
			    <?php if (function_exists('get_the_tags')) the_tags('<br />' . __( 'Tags', 'wptouch' ) . ': ', ', ', ''); ?>  
		    </div>
    
<!-- Mail and Bookmark code -->	

	<div class="single-links">
		<div class="single-bookmark-right"><a href="#" onclick="$wptouch('#bookmark-box').slideToggle(300); return false;"><?php _e( "Bookmark It", "wptouch" ); ?></a></div>
			<div class="single-mail-left"><a href="mailto:?subject=<?php
bloginfo('name'); ?>- <?php the_title();?>&body=<?php _e( "Check out this post:", "wptouch" ); ?> <?php the_permalink() ?>"><?php _e( "Mail It", "wptouch" ); ?></a></div>
				<div class="clearer"></div>
			</div>
		<div class="post-spacer"></div>
	</div>

<!-- Hidden bookmark box code (activated by the above link) -->

	<div id="bookmark-box" style="display:none">
		<ul>
			<li><a  href="http://del.icio.us/post?url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/delicious.jpg" alt="" /> <?php _e( "Del.icio.us", "wptouch" ); ?></a></li>
			<li><a href="http://digg.com/submit?phase=2&url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/digg.jpg" alt="" /> <?php _e( "Digg", "wptouch" ); ?></a></li>
			<li><a href="http://technorati.com/faves?add=<?php the_permalink() ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/technorati.jpg" alt="" /> <?php _e( "Technorati", "wptouch" ); ?></a></li>
			<li><a href="http://ma.gnolia.com/bookmarklet/add?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/magnolia.jpg" alt="" /> <?php _e( "Magnolia", "wptouch" ); ?></a></li>
			<li><a href="http://www.newsvine.com/_wine/save?popoff=0&u=<?php echo get_permalink() ?>&h=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/newsvine.jpg" target="_blank"> <?php _e( "Newsvine", "wptouch" ); ?></a></li>
			<li class="noborder"><a href="http://reddit.com/submit?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/reddit.jpg" alt="" /> <?php _e( "Reddit", "wptouch" ); ?></a></li>
		</ul>
	</div>

	<div class="navigation">

<!-- Single post navigation links -->

		<div class="alignleft"><?php next_post_link('%link', 'Prev Post') ?></div>
		<div class="alignright"><?php previous_post_link('%link', 'Next Post') ?></div>

<!-- Let's make sure there's no float strangeness happening. Sometimes plugins get funky here. -->
		<div class="clearer"></div>
	</div>

<!-- Let's rock the comments -->

	<?php comments_template(); ?>

	<?php endwhile; else : ?>

<!-- Dynamic test for what page this is. A little redundant, but so what? -->

	<div class="result-text-footer">
		<?php wptouch_core_else_text(); ?>
	</div>

	<?php endif; ?>
</div>
	
	<!-- Do the footer things -->
	
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>