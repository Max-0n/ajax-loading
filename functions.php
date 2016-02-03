<?php
	//if(function_exists('register_sidebar')) register_sidebar();
	//remove_filter('the_excerpt', 'wpautop');
	//remove_filter('the_content', 'wpautop');
function onPop(){
	$args= array();
	$args['post_status'] = 'publish';
	if( $_POST[category] ) $args['category_name'] = $_POST[category];
	
	if( $_POST[article] ):
		$args['name'] = $_POST[article];

		$q = new WP_Query($args);
		if( $q->have_posts() ):
			while( $q->have_posts() ): $q->the_post();
				remove_filter('the_content', 'wpautop');			
?>
<a href="http://max0n.com" class="logo"></a>
<h1><?php echo get_the_title(); ?></h1>
<div><?php the_content(); ?></div>
<?php
			endwhile;
		endif;
	else:
		$args['posts_per_page'] = 5*($_POST[page]-1);
		$args['paged'] = 1;
	
		$q = new WP_Query($args);
		if( $q->have_posts() ):
?>
<a href="http://max0n.com" class="logo"></a>
<?php
			while( $q->have_posts() ):
				$q->the_post();
				remove_filter('the_excerpt', 'wpautop');
?>
<a href="<?php echo urldecode(get_the_permalink()); ?>" rel="bookmark" title="<?php echo $q->post->post_title; ?>" class="control excerpt"><h2><?php echo $q->post->post_title; ?></h2><?php the_excerpt();//the_content();?></a>
<?php
			endwhile;
		endif;
	endif;
	wp_reset_postdata();
	wp_die();
}
//подкачка дополнительных постов
add_action('wp_ajax_onPop', 'onPop');
add_action('wp_ajax_nopriv_onPop', 'onPop');

function autoload_posts(){
	$args= array();
	
	if( $_POST[category] ) $args['category_name'] = $_POST[category];
	$args['paged'] = $_POST[page]; // следующая страница
	$args['post_status'] = 'publish';
	//$args['order'] = 'ASC';
	$q = new WP_Query($args);
	if( $q->max_num_pages() > $_POST[page])
		return false;
	else if( $q->have_posts() ):
		while( $q->have_posts() ):
			$q->the_post();
			remove_filter('the_excerpt', 'wpautop');
			/*
			 * Со строчки 13 по 27 идет HTML шаблон поста, максимально приближенный к теме TwentyTen.
			 * Для своей темы вы конечно же можете использовать другой код HTML.
			 */

/*
			<div id="post-<?php echo $q->post->ID ?>" class="post-<?php echo $q->post->ID ?> hentry">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $q->post->post_title ?></a></h2>
				<div class="entry-meta">
					<span class="meta-prep meta-prep-author">Опубликовано</span> <span class="entry-date"><?php the_time('j M Y') ?></span></a>
					<span class="meta-sep">автором</span>
					<span class="author vcard"><?php the_author_link(); ?> </span>
				</div>
				<div class="entry-content"><p style="text-align: center;"><?php the_content() ?></p></div>
				<div class="entry-utility">
					<span class="cat-links">
					<span class="entry-utility-prep entry-utility-prep-cat-links">Рубрика:</span> <?php the_category(', '); ?></span>
					<span class="meta-sep">|</span>
					<span class="comments-link"><a href="<?php the_permalink() ?>#comments">Комментарии (<?php echo $q->post->comment_count ?>)</a></span>
				</div>
			</div>
*/
	//<script>$('pre code').each(function(i, block) {hljs.highlightBlock(block);});</script>
?>
<a href="<?php echo urldecode(get_the_permalink()); ?>" rel="bookmark" title="<?php echo $q->post->post_title; ?>" class="control excerpt"><h2><?php echo $q->post->post_title; ?></h2><?php the_excerpt();//the_content();?></a>
<?php
		endwhile;
	endif;
	wp_reset_postdata();
	wp_die();
}
//подкачка дополнительных постов
add_action('wp_ajax_loadmore', 'autoload_posts');
add_action('wp_ajax_nopriv_loadmore', 'autoload_posts');



function load_post(){
	$args= array();
	$args['category_name'] = $_POST[category];
	$args['name'] = $_POST[article];
	$args['post_status'] = 'publish';

	$q = new WP_Query($args);
	if( $q->have_posts() ):
		while( $q->have_posts() ): $q->the_post();
			remove_filter('the_content', 'wpautop');			
?>
<a href="http://max0n.com" class="logo"></a>
<h1><?php echo get_the_title(); ?></h1>
<div><?php the_content(); ?></div>
<?php
		endwhile;
	endif;
	wp_reset_postdata();
	wp_die();
}
//загрузка статьи
add_action('wp_ajax_getArticle', 'load_post');
add_action('wp_ajax_nopriv_getArticle', 'load_post');


function getCategory(){
	$args = array('posts_per_page' => -1, 'category_name' => $_POST[category], 'post_status' => 'publish', 'orderby' => 'title','order' => 'ASC');
	$q = new WP_Query($args);
	if ( $q->have_posts() ) :
		while ( $q->have_posts() ):
			$q->the_post();
			if( strpos(urldecode(get_the_permalink()), urldecode($_SERVER['REQUEST_URI'])) && urldecode($_SERVER['REQUEST_URI'])!='/' && get_the_title() ):
				echo '<li><a href="'.urldecode(get_the_permalink()).'" title="'.get_the_title().'" class="control is-active loaded">'.get_the_title().'</a></li>';
			else:
				echo '<li><a href="'.urldecode(get_the_permalink()).'" title="'.get_the_title().'" class="control loaded">'.get_the_title().'</a></li>';
			endif;
		endwhile;
	endif;
	wp_reset_postdata();
	wp_die();
}
//список статей в категории
add_action('wp_ajax_getCategory', 'getCategory');
add_action('wp_ajax_nopriv_getCategory', 'getCategory');


function go_home(){
	$args = array('paged' => 1, 'post_status' => 'publish');
	$q = new WP_Query($args);
	if ( $q->have_posts() ) :
?>
<a href="http://max0n.com" class="logo"></a>
<?php
		while ( $q->have_posts() ):
			$q->the_post();
			remove_filter('the_excerpt', 'wpautop');
?>
<a href="<?php echo urldecode(get_the_permalink()); ?>" rel="bookmark" title="<?php echo $q->post->post_title; ?>" class="control excerpt"><h2><?php echo $q->post->post_title; ?></h2><?php the_excerpt();//the_content();?></a>
<?php
		endwhile;
	endif;
	wp_reset_postdata();
	wp_die();
}
//переход на главную страницу
add_action('wp_ajax_goHome', 'go_home');
add_action('wp_ajax_nopriv_goHome', 'go_home');
?>