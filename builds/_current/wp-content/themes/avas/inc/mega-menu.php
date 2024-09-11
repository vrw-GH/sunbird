<?php
/*
 * Saves new field to postmeta for navigation
 */

add_filter( 'wp_nav_menu_args', 'tx_modify_arguments', 100 );
function tx_modify_arguments( $arguments ) {
    $arguments['walker']          = new HeroMenuWalker();
    return $arguments;
}
add_action('wp_update_nav_menu_item', 'tx_custom_nav_update',10, 3);
function tx_custom_nav_update($menu_id, $menu_item_db_id, $args ) {
    $fields = array('submenu_type','dropdown_type','widget_area','hide_link','bg_image','bg_image_attachment','bg_image_size','bg_image_position','bg_image_repeat','bg_color','menu_icon','highlight');
    foreach($fields as $i=>$field){
        if (isset($_REQUEST['menu-item-'.$field][$menu_item_db_id])) {
            $mega_value = $_REQUEST['menu-item-'.$field][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_'.$field, $mega_value );
        }
    }
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','tx_custom_nav_item' );
function tx_custom_nav_item($menu_item) {
    $fields = array('submenu_type','dropdown_type','widget_area','hide_link','bg_image','bg_image_attachment','bg_image_size','bg_image_position','bg_image_repeat','bg_color','menu_icon','highlight');
    foreach($fields as $i=>$field){
        $menu_item->$field = get_post_meta( $menu_item->ID, '_menu_item_'.$field, true );
    }
    return $menu_item;
}
add_action( 'admin_enqueue_scripts','tx_add_js_mega_menu');
function tx_add_js_mega_menu(){
    wp_enqueue_script( 'set_background', TX_JS . 'mega-menu.min.js', array( 'jquery', 'jquery-ui-sortable' ), false, true );
    wp_enqueue_media();
    add_thickbox();
}

add_filter( 'wp_edit_nav_menu_walker', 'tx_custom_nav_edit_walker',10,2 );
function tx_custom_nav_edit_walker($menu_id) {
    return 'Walker_Nav_Menu_Edit_Custom';
}

/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
/**
 * @see Walker_Nav_Menu::start_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function start_lvl( &$output, $depth = 0, $args = array() ) {}

/**
 * @see Walker_Nav_Menu::end_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function end_lvl( &$output, $depth = 0, $args = array() ) {}

/**
 * @see Walker::start_el()
 * @since 3.0.0
 *
 * @param string $output Passed by reference. Used to append additional content.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param object $args
 */
function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    ob_start();
    $item_id = esc_attr( $item->ID );
    $removed_args = array(
        'action',
        'customlink-tab',
        'edit-menu-item',
        'menu-item',
        'page-tab',
        '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
        if ( is_wp_error( $original_title ) )
            $original_title = false;
    } elseif ( 'post_type' == $item->type ) {
        $original_object = get_post( $item->object_id );
        $original_title = $original_object->post_title;
    }

    $classes = array(
        'menu-item menu-item-depth-' . $depth,
        'menu-item-' . esc_attr( $item->object ),
        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
    );

    $title = $item->title;

    if ( ! empty( $item->_invalid ) ) {
        $classes[] = 'menu-item-invalid';
        /* translators: %s: title of menu item which is invalid */
        $title = sprintf( __( '%s (Invalid)', 'avas'), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( __('%s (Pending)', 'avas'), $item->title );
    }

    $title = empty( $item->label ) ? $title : $item->label;

    ?>
    <li data-menuanchor="" id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-up-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','avas'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-down-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','avas'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e('Edit Menu Item','avas'); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php esc_html_e( 'Edit Menu Item' ,'avas'); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'URL' ,'avas'); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
                    <?php esc_html_e( 'Navigation Label' ,'avas'); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
                    <?php esc_html_e( 'Title Attribute','avas' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php esc_html_e( 'Open link in a new window/tab' ,'avas'); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
                    <?php esc_html_e( 'CSS Classes (optional)' ,'avas'); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
                    <?php esc_html_e( 'Link Relationship (XFN)' ,'avas'); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
                    <?php esc_html_e( 'Description' ,'avas'); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); ?></textarea>
                    <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','avas'); ?></span>
                </label>
            </p>
            <?php
            /*
             * This is the added field
             */
			if ( ! $depth ) {
				$title = esc_html__('Submenu Type','avas');
				$key = "menu-item-submenu_type";
				$value = $item->submenu_type;
				?>
				<p class="description description-thin">
					<?php echo esc_html( $title ); ?><br />
					<label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
						<select id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>">
							<option value="standard" <?php echo ( esc_attr($value) == 'standard' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Standard Dropdown', 'avas' ); ?></option>
							<option value="columns1" <?php echo ( esc_attr($value) == 'columns1' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '1 column Dropdown', 'avas' ); ?></option>
                            <option value="columns2" <?php echo ( esc_attr($value) == 'columns2' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '2 columns Dropdown', 'avas' ); ?></option>
							<option value="columns3" <?php echo ( esc_attr($value) == 'columns3' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '3 columns Dropdown', 'avas' ); ?></option>
							<option value="columns4" <?php echo ( esc_attr($value) == 'columns4' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '4 columns Dropdown', 'avas' ); ?></option>
						</select>
					</label>
				</p>
            <?php } ?>

		    <?php if($depth) {
    			$title = esc_html__('Widget Area','avas');
    			$key = "menu-item-widget_area";
    			$value = $item->widget_area;
    			$sidebars = $GLOBALS['wp_registered_sidebars'];
    			$style = '';//( $item->submenu_type == 'widget_area' ) ? '' : ' style="display:none;" ';
    			?>
    			<p class="description description-thin"<?php echo esc_attr( $style ); ?>>
    				<?php echo esc_html( $title ); ?><br />
    				<label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
    					<select id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>">
    						<option value="" <?php echo ( esc_attr($value) == '' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Select Widget Area', 'avas' ); ?></option>
    						<?php
    						foreach ( $sidebars as $sidebar ) {
    							echo '<option value="' . $sidebar['id'] . '" ' . ( ( $value == $sidebar['id'] ) ? ' selected="selected" ' : '' ) . '>' . $sidebar['name'] . '</option>';
    						}
    						?>
    					</select>
    				</label>
    			</p>
			<?php } ?>

			<?php if($depth) {
    			$title = esc_html__('Hide Link?', 'avas');
    			$key = "menu-item-hide_link";
    			$value = $item->hide_link;
    			?>
    			<p class="description description-thin">
    				<?php echo esc_html( $title ); ?><br />
    				<label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
    					<select id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>">
    						<option value="0" <?php echo ( esc_attr($value) == '0' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'No', 'avas' ); ?></option>
    						<option value="1" <?php echo ( esc_attr($value) == '1' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Yes', 'avas' ); ?></option>
    					</select>
    				</label>
    			</p>
    		<?php } ?>
            <?php     
                $title = esc_html__('Icon(EX: fa fa-home)','avas');
                $LineAwesome = esc_html__('Icon(EX: la la-home)','avas');
                $key = "menu-item-menu_icon";
                $value = $item->menu_icon;
            ?>
                <p class="description description-thin">
                    <label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
                        <?php echo esc_html( $title ); ?> <a href="<?php echo esc_url('https://fontawesome.com/v4.7.0/icons/'); ?>" target="_blank"><?php esc_html_e('FontAwesome Icon URL', 'avas'); ?></a><br />
                        <?php echo esc_html( $LineAwesome ); ?> <a href="<?php echo esc_url('https://icons8.com/line-awesome'); ?>" target="_blank"><?php esc_html_e('LineAwesome Icon URL', 'avas'); ?></a><br />
                        <input type="text" value="<?php echo esc_attr( $value ); ?>" id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>" />
                    </label>
                </p>

            <!-- Start highlight text callouts button -->
            <?php     
                $title = esc_html__('Highlight text callouts button','avas');
                $key = "menu-item-highlight";
                $value = $item->highlight;
            ?>
                <p class="description description-thin">
                    <label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
                        <?php echo esc_html( $title ); ?>
                        <input type="text" value="<?php echo esc_attr( $value ); ?>" id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>" />
                    </label>
                </p>

    		<!-- Start background menu -->
            <?php
    			if ( ! $depth ) {
                $title = esc_html__('DropDown Background Image','avas');
                $key = "menu-item-bg_image";
                $value = $item->bg_image;
                ?>
            
                <p class="description description-wide">
                    <label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
                        <?php echo esc_html( $title ); ?><br />
                        <input type="text" value="<?php echo esc_attr( $value ); ?>" id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>" />
                        <button id="browse-edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class="set_custom_images button button-secondary submit-add-to-menu"><?php esc_html_e( 'Browse Image', 'avas' ); ?></button>
    					<a class="button btn_clear button-primary" href="javascript: void(0);"><?php echo esc_html__('Clear','avas');?></a>
                    </label>
                </p>
                <p class="description description-wide description_width_25">
                    <?php
                    $key = "menu-item-bg_image_repeat";
                    $value = $item->bg_image_repeat;
                    $options = array( 'repeat', 'no-repeat', 'repeat-x', 'repeat-y' );
                    ?>
                    <label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
                        <select id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>">
                            <?php
                            foreach ( $options as $option ) {
                                ?>
                                <option value="<?php echo esc_attr( $option ); ?>" <?php echo ( esc_attr($value) == $option ) ? ' selected="selected" ' : ''; ?>><?php echo esc_html( $option ); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </label>
                    <?php
                    $key = "menu-item-bg_image_attachment";
                    $value = $item->bg_image_attachment;
                    $options = array( 'scroll', 'fixed' );
                    ?>
                    <label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
                        <select id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>">
                            <?php
                            foreach ( $options as $option ) {
                                ?>
                                <option value="<?php echo esc_attr( $option ); ?>" <?php echo ( esc_attr($value) == $option ) ? ' selected="selected" ' : ''; ?>><?php echo esc_html( $option ); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </label>

                    <?php
                    $key = "menu-item-bg_image_position";
                    $value = $item->bg_image_position;
                    $options = array( 'center', 'center left', 'center right', 'top left', 'top center', 'top right', 'bottom left', 'bottom center', 'bottom right' );
                    ?>
                    <label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
                        <select id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>">
                            <?php
                            foreach ( $options as $option ) {
                                ?>
                                <option value="<?php echo esc_attr( $option ); ?>" <?php echo ( esc_attr($value) == $option ) ? ' selected="selected" ' : ''; ?>><?php echo esc_html( $option ); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </label>

                    <?php
                    $key = "menu-item-bg_image_size";
                    $value = $item->bg_image_size;
                    $options = array( "auto"      => "Keep original",
                                      "100% auto" => "Stretch to width",
                                      "auto 100%" => "Stretch to height",
                                      "cover"     => "cover",
                                      "contain"   => "contain" );
                    ?>
                    <label for="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>">
                        <select id="edit-<?php echo esc_attr( $key . '-' . $item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[" . $item_id . "]" ); ?>">
                            <?php
                            foreach ( $options as $op_value => $op_text ) {
                                ?>
                                <option value="<?php echo esc_attr( $op_value ); ?>" <?php echo ( esc_attr($value) == $op_value ) ? ' selected="selected" ' : ''; ?>><?php echo esc_html( $op_text ); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </label>
                </p>
			<?php } ?>
			<!-- End background menu -->
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( __('Original: %s', 'avas'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    ),
                    'delete-menu_item_' . esc_attr( $item_id )
                ); ?>"><?php esc_html_e('Remove','avas'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e('Cancel','avas'); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
    <?php
    $output .= ob_get_clean();
    }
}
class HeroMenuWalker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        //display this element
        if ( isset( $args[0] ) && is_array( $args[0] ) ) {
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        }
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'start_el' ), $cb_args );

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ( $max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[$id] ) ) {
            $b          = $args[0];
            $b->element = $element;
            $b->count_child = count($children_elements[$id]);
			//$b->mega_child = $element->mega;
            $args[0]    = $b;
            foreach ( $children_elements[$id] as $child ) {
                if ( ! isset( $newlevel ) ) {
                    $newlevel = true;
                    //start the child delimiter
					$cb_args = array_merge( array( &$output, $depth ), $args );
					$cb_args = array_merge( array( &$output, $depth ), $args );
                    call_user_func_array( array( $this, 'start_lvl' ), $cb_args );
                }
                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }
            unset( $children_elements[$id] );
        }

        if ( isset( $newlevel ) && $newlevel ) {
            //end the child delimiter
            $cb_args = array_merge( array( &$output, $depth ), $args );
            call_user_func_array( array( $this, 'end_lvl' ), $cb_args );
        }

        //end this element
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'end_el' ), $cb_args );
    }

    function start_lvl( &$output, $depth = 0, $args = array() )  {
        $bg_image        = isset($args->element->bg_image)?$args->element->bg_image:'';
        $pos_left        = isset($args->element->pos_left)?$args->element->pos_left:'';
        $pos_right        = isset($args->element->pos_right)?$args->element->pos_right:'';
        $submenu_type        = isset($args->element->submenu_type)?$args->element->submenu_type:'standard';
        $class = null;
		$style = 'style="';
		$class .= 'depth'.$depth;
		$class .= ' '.$submenu_type;
        $class = $bg_image?$class .= ' sub-menu mega-bg-image':$class .= ' sub-menu';
        if ( $bg_image ) {
            $bg_image_repeat     = $args->element->bg_image_repeat;
            $bg_image_attachment = $args->element->bg_image_attachment;
            $bg_image_position   = $args->element->bg_image_position;
            $bg_image_size       = $args->element->bg_image_size;
            $style               .= 'background-image:url(' . $bg_image . ');background-repeat:' . $bg_image_repeat . ';background-attachment:' . $bg_image_attachment . ';background-position:' . $bg_image_position . ';background-size:' . $bg_image_size . ';';
        }
        if ( $pos_left ) {
            $style               .= 'left:'.$pos_left.';';
        }
        if ( $pos_right ) {
            $style               .= 'right:'.$pos_right.';';
        }
        $style .='"';
        $indent = str_repeat( "\t", $depth );

        $output .= "\n$indent<ul class='$class' $style>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = '';
        $menu_icon = $item->menu_icon;
        $highlight = $item->highlight;
        $hide_link = $item->hide_link;
        $submenu_type = $item->submenu_type;
        $dropdown_type = $item->dropdown_type;
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		if($submenu_type != '' && $submenu_type != 'standard' && $depth==0){
			$classes[]= 'mega-menu-item';
		}else{
			$classes[]= 'nomega-menu-item';
		}
        $classes[] = $dropdown_type;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .'>';
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        $x = '';
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $x );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        if ( is_object($args) ) {
			$item_output = isset($args->before)?$args->before:'';
			$link_before = isset($args->link_before)?$args->link_before:'';
			$link_after = isset($args->link_after)?$args->link_after:'';
			$after = isset($args->after)?$args->after:'';
		} else {
			$item_output = isset($args['before'])?$args['before']:'';
			$link_before = isset($args['link_before'])?$args['link_before']:'';
			$link_after = isset($args['link_after'])?$args['link_after']:'';
			$after = isset($args['after'])?$args['after']:'';
		}
		if(!$hide_link || $hide_link=="0"):
			$item_output .= '<a'. $attributes .' class="mega-menu-title">';
		else:
			$item_output .= '<a'. $attributes .' class="hide_link">';
		endif;
        if ( $menu_icon ) :
            $item_output .= '<i class=" ' . $menu_icon . '"></i> ';
        endif;
        if(is_rtl()) :
            if ( $highlight ) :
            $item_output .= '<span class="tx-menu-highlight">' . $highlight . '</span>';
            endif;
        endif;
        $item_output .= $link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $link_after;

        if( !is_rtl()) :
            if ( $highlight ) :
                $item_output .= '<span class="tx-menu-highlight">' . $highlight . '</span>';
            endif;
        endif;

        $item_output .= '</a>';
		$widget_area = $item->widget_area;
		if ($widget_area && $depth != 0) :
			ob_start();
			if (is_active_sidebar($widget_area)) { dynamic_sidebar($widget_area); }
			$content         = ob_get_clean();
			if ( $content ) {
				$item_output .= $content;
			}
		endif;
        $item_output .= $after;
		
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}


if(!function_exists('tx_get_main_menu_parent_items')){
    function tx_get_main_menu_parent_items(){
        $menu_name = 'main_menu';
        $locations = get_nav_menu_locations();
        $items = array();

        if ( isset( $locations[ $menu_name ] ) && $locations[ $menu_name ] != 0) {
            $menu_id = $locations[ $menu_name ];

            $items = tx_get_menu_parent_items($menu_id);


            //get the WPML translated items
            $trans_items = tx_get_translation_items($menu_id);
            if(!empty($trans_items)){
                $items = array_merge($items, $trans_items);
            }

        }

        return $items;
    }
}

if(!function_exists('tx_get_menu_parent_items')){
    function tx_get_menu_parent_items($menu_id){
        $menu = wp_get_nav_menu_object( $menu_id );

        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $items = array();

        if(sizeof($menu_items)){
            foreach ($menu_items as $item) {
                if($item->menu_item_parent==0){
                    $items[]= array('id'=>$item->ID, 'name'=>$item->title);
                }
            }
        }

        return $items;
    }
}


/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */