<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://theme-x.org/
*
* ====================================
*         Single Team
* ====================================
*
*/

global $tx;
$team_fb = get_post_meta( $post->ID, 'team_fb', true );
$team_tw = get_post_meta( $post->ID, 'team_tw', true );
$team_gp = get_post_meta( $post->ID, 'team_gp', true );
$team_ln = get_post_meta( $post->ID, 'team_ln', true );
$team_in = get_post_meta( $post->ID, 'team_in', true );

$hire_me = get_post_meta( $post->ID, 'hire_me', true );
$hour_rate = get_post_meta( $post->ID, 'hour_rate', true );

$skill_title = get_post_meta($post->ID, 'skill_title', true);
$skill_fields = get_post_meta($post->ID, 'skill_fields', true);

get_header();

?>
	
<div class="container space-content">
  	<div class="row">
  		<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<div class="col-md-5 col-sm-12 team-single-left">
			<?php the_post_thumbnail('tx-ts-thumb'); ?>
			<?php if($tx['team_social_profile']) : ?>
			<div class="team_profile">
			
				<?php if (!empty($hire_me) || ($hour_rate) ) : ?>
                            <?php $hire_me_hour = $hour_rate; ?>
                            <a href="<?php echo esc_url($hire_me); ?>" class="hire_me"><?php echo esc_attr($hire_me_hour); ?></a>
                            <?php endif; ?>

        		<?php if (!empty($team_fb || $team_tw || $team_gp || $team_ln || $team_in) ) : ?>
				<div class="team-social-box">
				<ul class="team-social">
							<?php if (!empty($team_fb)) : ?>
							<li><a href="<?php echo esc_url($team_fb); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($team_tw)) : ?>
							<li><a href="<?php echo esc_url($team_tw); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($team_gp)) : ?>
							<li><a href="<?php echo esc_url($team_gp); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($team_ln)) : ?>
							<li><a href="<?php echo esc_url($team_ln); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($team_in)) : ?>
							<li><a href="<?php echo esc_url($team_in); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
							<?php endif; ?>
				</ul>
				</div>
				<?php endif; ?>	<!-- Social media -->
			</div>
			<?php endif; ?>
			<div id="secondary" class="col-md-10 col-sm-12 widget-area mt40" role="complementary">
			<?php
				if (is_active_sidebar('sidebar-team')) : 
    			dynamic_sidebar('sidebar-team'); ?>
			<?php endif; ?>
			</div>
		</div> <!-- left column end -->

		<div class="col-md-7 col-sm-12 team-single-right">
			<header class="team-title">
				<h2 class="team-name"><?php the_title(); ?></h2>
				<?php
					global $post;
					$terms = get_the_terms( $post->ID, 'team-category' );
					if ( $terms && ! is_wp_error( $terms ) ) :
					    $taxonomy = array();
					    foreach ( $terms as $term ) :
					    $taxonomy[] = $term->name;
					    endforeach;
					    $cat_name = join( " ", $taxonomy);
					    $cat_link = get_term_link( $term );
					else:
					  	$cat_name = '';
					endif;
				?>
				<?php if(!empty($cat_name)) : ?>
				<p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
				<?php endif; ?>  
			</header>

			<div class="team-content"><?php the_content(); ?></div>
			

			<div class="team-skills">
                    <?php if ( !empty($skill_title) ) : ?>
                         <h4 class="skill-title"><?php echo esc_html($skill_title ); ?></h4>
                    <?php endif; ?>
                         
                    <?php if ( $skill_fields ) : ?>
                        <?php foreach ( $skill_fields as $field ) : ?>

                                <?php if($field['name'] != '') : ?>
                                <h5 class="skill-name"><?php echo esc_html( $field['name'] ); ?></h5>
                            	<?php endif; ?>

                            	<?php if($field['value'] != '') : ?>
	                            <div class="progress">
	                                <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr( $field['value'] ); ?>%;" aria-valuemin="0" aria-valuemax="100"><?php echo esc_attr( $field['value'] ); ?>%</div>
	                            </div>
	                            <?php endif; ?>

                        <?php endforeach; ?>
                    <?php endif; ?>
			</div><!-- skills end-->

			<?php if($tx['project_experience']): ?>
			<h4 class="project-exp-title"><?php echo esc_html($tx['project_experience_title']); ?></h4>
			<?php get_template_part( 'template-parts/project', 'experience' ) ?> <!-- project experience-->
			<?php endif; ?>

		</div> <!-- right column end -->

    <?php endwhile;	?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>


<?php get_footer();