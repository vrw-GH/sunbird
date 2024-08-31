<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* functions for learnpress plugin
**/

// remove price bottom of single course page
if ( ! function_exists( 'tx_remove_lp_price' ) ) {
	add_action('after_setup_theme', 'tx_remove_lp_price' );
	function tx_remove_lp_price(){
		remove_action( 'learn-press/content-landing-summary', 'learn_press_course_price', 25);
	}
}


/**
 * Display course info
 */
if ( ! function_exists( 'tx_course_info' ) ) {
  function tx_course_info() {
    $course    = LP()->global['course'];
    $course_id = get_the_ID();

    $course_skill_level = get_post_meta( $course_id, 'thim_course_skill_level', true );
    $course_language    = get_post_meta( $course_id, 'thim_course_language', true );
    $course_duration    = get_post_meta( $course_id, 'thim_course_duration', true );

    ?>
    <div class="lp-course-features">
      <h3 class="title"><?php esc_html_e( 'Course Features', 'avas' ); ?></h3>
      <ul>
        <li class="lectures-feature">
          <i class="fa fa-files-o"></i>
          <span class="label"><?php esc_html_e( 'Lectures', 'avas' ); ?></span>
          <span class="value"><?php echo esc_html($course->get_curriculum_items( 'lp_lesson' ) ? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0); ?></span>
        </li>
        <li class="quizzes-feature">
          <i class="fa fa-puzzle-piece"></i>
          <span class="label"><?php esc_html_e( 'Quizzes', 'avas' ); ?></span>
          <span class="value"><?php echo esc_html($course->get_curriculum_items( 'lp_quiz' ) ? count( $course->get_curriculum_items( 'lp_quiz' ) ) : 0); ?></span>
        </li>
        <?php if ( ! empty( $course_duration ) ): ?>
          <li class="duration-feature">
            <i class="fa fa-clock-o"></i>
            <span class="label"><?php esc_html_e( 'Duration', 'avas' ); ?></span>
            <span class="value"><?php echo esc_html($course_duration,'avas'); ?></span>
          </li>
        <?php endif; ?>
        <?php if ( ! empty( $course_skill_level ) ): ?>
          <li class="skill-feature">
            <i class="fa fa-level-up"></i>
            <span class="label"><?php esc_html_e( 'Skill level', 'avas' ); ?></span>
            <span class="value"><?php echo esc_html( $course_skill_level,'avas' ); ?></span>
          </li>
        <?php endif; ?>
        <?php if ( ! empty( $course_language ) ): ?>
          <li class="language-feature">
            <i class="fa fa-language"></i>
            <span class="label"><?php esc_html_e( 'Language', 'avas' ); ?></span>
            <span class="value"><?php echo esc_html( $course_language,'avas' ); ?></span>
          </li>
        <?php endif; ?>
        <li class="students-feature">
          <i class="fa fa-users"></i>
          <span class="label"><?php esc_html_e( 'Students', 'avas' ); ?></span>
          <?php $user_count = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0; ?>
          <span class="value"><?php echo esc_html( $user_count ,'avas'); ?></span>
        </li>
        <li class="assessments-feature">
          <i class="fa fa-check-square-o"></i>
          <span class="label"><?php esc_html_e( 'Assessments', 'avas' ); ?></span>
          <span class="value"><?php echo ( get_post_meta( $course_id, '_lp_course_result', true ) == 'evaluate_lesson' ) ? ( 'Yes' ) : ( 'No' ); ?></span>
        </li>
      </ul>
    </div>
    <?php
  }
}



/**
 * Display related courses
 */
if ( ! function_exists( 'tx_related_courses' ) ) {
  function tx_related_courses() {
    $related_courses    = tx_get_related_courses( 5 );
?>
  <div class="edu-ralated-course">
    <h3 class="related-title">
      <?php esc_html_e( 'You May Like', 'avas' ); ?>
    </h3>

        <div class="related-course owl-carousel owl-theme">
            <?php foreach ( $related_courses as $course_item ) : ?>
              <?php $course = LP_Global::course();
              $course      = learn_press_get_course( $course_item->ID );
              $is_required = $course->is_required_enroll();
              ?>
             <div class="lpr_course item">

              <div class="lp-course-price">
                        <?php if ( $price = $course->get_price_html() ) {
                        $origin_price = $course->get_origin_price_html();
                        $sale_price   = $course->get_sale_price();
                        $sale_price   = isset( $sale_price ) ? $sale_price : '';
                        $class        = '';
                        if ( $course->is_free() || ! $is_required ) {
                          $class .= ' free-course';
                          $price = esc_html__( 'Free', 'avas' );
                        }
                        ?>
                            <?php
                            if ( $sale_price ) {
                              echo '<span class="origin-price">' . $origin_price . '</span>';
                            }
                            ?>
                            <?php echo '<span class="price">' . $price .'</span>'; ?>
                         
                        <?php
                      }
                      ?>
              </div>

                <div class="course-thumbnail">
                    <a class="thumb" href="<?php echo get_the_permalink( $course_item->ID ); ?>">
                      
                     
                    <?php echo wp_kses_post($course->get_image( 'course_thumbnail' )); ?>
                                            
                    </a>
                    <?php do_action( 'thim_inner_thumbnail_course' ); ?>
                   
                </div>
            <div class="course-summary">
                <div class="course-cateogory">
                    <?php
                        $terms = get_the_terms( $course_item->ID , 'course_category' );
                        if($terms):
                        foreach ( $terms as $term ) {
                        echo '<a href="'.get_term_link($term->term_id).'">'.$term->name .'</a>';
                        }
                        endif;
                    ?>
                </div>

                <h4 class="course-title">
                  <a rel="bookmark"
                         href="<?php echo get_the_permalink( $course_item->ID ); ?>"><?php echo esc_html( $course_item->post_title ); ?></a>
                </h4> <!-- .entry-header -->
            </div>
                  <div class="related-course-footer">
                        <div class="lp-author">
                          <a href="<?php echo esc_url( learn_press_user_profile_link( $course_item->post_author ) ); ?>">
                             <?php echo get_avatar( $course_item->post_author, 40 ); ?>
                          </a>
                        </div>

              <?php 

              global $course;
              $course_id       = $course_item->ID;
              $course_rate_res = learn_press_get_course_rate( $course_id, false );
              $course_rate     = $course_rate_res['rated'];
              $total           = $course_rate_res['total'];
              ?>
              <div class="course-rate">
                  <?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) ); ?>
              </div>

                    <div class="course-students">
                      <?php
                      global $course;
                      $count_student = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0;
                      ?>
                        <?php do_action( 'learn_press_begin_course_students' ); ?>
                        <i class="fa fa-group"></i>
                          <?php echo esc_html( $count_student ); ?>
                        <?php do_action( 'learn_press_end_course_students' ); ?>
                    </div>

                  </div>
                
              </div>
            <?php endforeach; ?>
        </div><!-- related-course owl-carousel owl-theme -->
    </div>
    <?php
    

  }
}

if ( ! function_exists( 'tx_get_related_courses' ) ) {
  function tx_get_related_courses( $limit ) {
    if ( ! $limit ) {
      $limit = 6;
    }
    $course_id = get_the_ID();

    $tag_ids = array();
    $tags    = get_the_terms( $course_id, 'course_tag' );

    if ( $tags ) {
      foreach ( $tags as $individual_tag ) {
        $tag_ids[] = $individual_tag->term_id;
      }
    }

    $args = array(
      'posts_per_page'      => $limit,
      'paged'               => 1,
      'ignore_sticky_posts' => 1,
      'post__not_in'        => array( $course_id ),
      'post_type'           => 'lp_course'
    );

    if ( $tag_ids ) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'course_tag',
          'field'    => 'term_id',
          'terms'    => $tag_ids
        )
      );
    }
    $related = array();
    if ( $posts = new WP_Query( $args ) ) {
      global $post;
      while ( $posts->have_posts() ) {
        $posts->the_post();
        $related[] = $post;
      }
    }
    wp_reset_query();

    return $related;
  }
}


/**
 * Display rating stars
 *
 * @param $rate
 */
function thim_print_rating( $rate ) {

  ?>
  <div class="review-stars-rated">
    <ul class="review-stars">
      <li><span class="la la-star-o"></span></li>
      <li><span class="la la-star-o"></span></li>
      <li><span class="la la-star-o"></span></li>
      <li><span class="la la-star-o"></span></li>
      <li><span class="fa fa-star-o"></span></li>
    </ul>
    <ul class="review-stars filled" style="<?php echo esc_attr( 'width: ' . ( $rate * 20 ) . '%' ) ?>">
      <li><span class="la la-star"></span></li>
      <li><span class="la la-star"></span></li>
      <li><span class="la la-star"></span></li>
      <li><span class="la la-star"></span></li>
      <li><span class="la la-star"></span></li>
    </ul>
  </div>
  <?php
}


// course student enrolled
function tx_lp_student_endrolled() {
global $course;
$course = LP_Global::course();
$count = $course->get_users_enrolled();
?>
<div class="course-students"> 

        <i class="fa fa-users"></i>
        <?php echo esc_html( $count ); ?>
        

</div>
<?php } 

// course rating
function tx_lp_rating() {
global $course;
$course_id       = get_the_ID();
if( class_exists( 'LP_Addon_Course_Review' ) ) {
$course_rate_res = learn_press_get_course_rate( $course_id, false );
$course_rate     = $course_rate_res['rated'];
$total           = $course_rate_res['total'];


?>

<div class="course-rate">
    <?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) ); ?>
</div>
<?php 
}
}

//course instructor
function tx_lp_author() {
global $course; 
$course = LP_Global::course();
$instructor = $course->get_instructor()->get_profile_picture();
$html = sprintf('<a href="%s">%s</a>',learn_press_user_profile_link( get_post_field( 'post_author', get_the_ID() ) ),$instructor);

return '<div class="lp-author">'.$html . '</div>';

}

