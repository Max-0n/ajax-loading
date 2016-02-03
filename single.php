<?php get_header(); ?>
<?php get_sidebar();?>

		<div class="content">
			<a href="<?php echo site_url(); ?>" class="logo"></a>
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<?php //remove_filter('the_content', 'wpautop'); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<?php //comments_template(); ?>
			<?php endif; ?>
		</div>

<?php wp_footer(); ?>
<?php get_footer(); ?>
	</body>
</html>
