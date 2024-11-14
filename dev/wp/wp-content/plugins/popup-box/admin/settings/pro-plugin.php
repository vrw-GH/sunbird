<?php

defined( 'ABSPATH' ) || exit;


$default    = $options['item_order']['pro_feature'] ?? 1;
$item_order = ! empty( $default ) ? 1 : 0;
$open       = ! empty( $item_order ) ? ' open' : '';
?>

<div class="wpie-sidebar wpie-sidebar-features">
    <details class="wpie-item"<?php echo esc_attr( $open ); ?>>
        <input type="hidden" name="param[item_order][pro_feature]" class="wpie-item__toggle"
               value="<?php echo absint( $item_order ); ?>">
        <summary class="wpie-item_heading">
            <span class="wpie-item_heading_icon"><span class="wpie-icon wpie_icon-rocket wpie-color-danger"></span></span>
            <span class="wpie-item_heading_label"><?php esc_html_e( 'PRO FEATURES', 'popup-box' ); ?></span>
            <span class="wpie-item_heading_type"></span>
            <span class="wpie-item_heading_toogle">
        <span class="wpie-icon wpie_icon-chevron-down"></span>
        <span class="wpie-icon wpie_icon-chevron-up "></span>
    </span>
        </summary>
        <div class="wpie-fields__box">
            <h4>Triggers and Selectors</h4>
            <details class="wpie-details-sidebar">
                <summary>Open Triggers</summary>
                <div class="wpie-details-sidebar-box">
                    Click, Auto, Hover, Exit, Scrolled, Right Click, Text Selected, Loop
                </div>
            </details>
            <details class="wpie-details-sidebar">
                <summary>Open/Close Custom Selectors</summary>
                <div class="wpie-details-sidebar-box">
                    Add custom selectors to open or close the popup, providing greater flexibility and control
                    over modal interactions.
                </div>
            </details>
            <h4>Animations and Effects</h4>
            <details class="wpie-details-sidebar">
                <summary>Video Support</summary>
                <div class="wpie-details-sidebar-box">
                    Popup Box Pro seamlessly integrates with videos from Youtube and Vimeo, offering user-friendly
                    playback controls.
                </div>
            </details>

            <h4>Closing Options</h4>
            <details class="wpie-details-sidebar">
                <summary>Closing Modal</summary>
                <div class="wpie-details-sidebar-box">
                    Overlay, Esc, Auto-Close
                </div>
            </details>
            <details class="wpie-details-sidebar">
                <summary>Remove Close Button</summary>
                <div class="wpie-details-sidebar-box">
                    Option to remove the close button from the popup, ensuring users focus on the content or take
                    a required action.
                </div>
            </details>
            <details class="wpie-details-sidebar">
                <summary>Close Button Delay</summary>
                <div class="wpie-details-sidebar-box">
                    Set a delay before the close button appears on the popup, ensuring users have ample time to
                    view the content.
                </div>
            </details>
            <details class="wpie-details-sidebar">
                <summary>Redirect after Close</summary>
                <div class="wpie-details-sidebar-box">
                    Redirect users to a specific URL after the popup is closed, guiding them to additional
                    content or offers.
                </div>
            </details>
            <details class="wpie-details-sidebar">
                <summary>Close After Form Submission</summary>
                <div class="wpie-details-sidebar-box">
                    Automatically close the modal after form submission, supporting default forms, Contact Form 7, and WP Forms.
                </div>
            </details>

            <h4>Tracking and Analytics</h4>
            <details class="wpie-details-sidebar">
                <summary>Google Event Tracking</summary>
                <div class="wpie-details-sidebar-box">
                    Gain valuable insights into user engagement with your modals by integrating Google Analytics event
                    tracking. This allows you to monitor how often modals are opened and closed, helping you optimize
                    their effectiveness.
                </div>
            </details>

            <h4>Display Rules and Visibility</h4>
            <details class="wpie-details-sidebar">
                <summary>Display Rules</summary>
                <div class="wpie-details-sidebar-box">
                    Multi Display Rules - Add several Display Rules to control exactly where your popup appear
                    using shortcodes, page types, post categories/tags, author pages, date archives and more. <a
                            href="https://wow-estore.com/documentations/popup-box-pro-documentation/#doc-section-80756">Read
                        More</a>
                </div>
            </details>

            <details class="wpie-details-sidebar">
                <summary>Responsive Visibility</summary>
                <div class="wpie-details-sidebar-box">
                    Remove on Mobile, Remove on Desktop
                </div>
            </details>

            <details class="wpie-details-sidebar">
                <summary>Hide Based on Browser</summary>
                <div class="wpie-details-sidebar-box">
                    Customize the visibility of your popups depending on the user's browser. Selectively hide
                    modals for specific browsers to ensure compatibility and enhance user experience across different
                    web environments.
                </div>
            </details>

            <h4>User Permissions and Targeting</h4>

            <details class="wpie-details-sidebar">
                <summary>Permissions of Users</summary>
                <div class="wpie-details-sidebar-box">
                    Set specific permissions for displaying popups based on user roles. Customize which user
                    groups (e.g., Administrators, Editors, Authors) can view or interact with your modals, ensuring
                    relevant content reaches the appropriate audience.
                </div>

            </details>

            <details class="wpie-details-sidebar">
                <summary>URL has Param</summary>
                <div class="wpie-details-sidebar-box">
                    Trigger the popup to open if the URL contains a specific parameter, such as modal=active,
                    allowing targeted content delivery based on URL parameters.
                </div>
            </details>
            <details class="wpie-details-sidebar">
                <summary>URL has Hash</summary>
                <div class="wpie-details-sidebar-box">
                    Activate the popup when the URL contains a specific hash, enabling precise control over modal activation.
                </div>
            </details>
            <details class="wpie-details-sidebar">
                <summary>URL is Referrer</summary>
                <div class="wpie-details-sidebar-box">
                    Customize popup experiences for visitors arriving from specific websites, such as displaying
                    a welcome message for users coming from a partner site.
                </div>
            </details>

            <details class="wpie-details-sidebar">
                <summary>Geotargeting</summary>
                <div class="wpie-details-sidebar-box">
                    Show popups based on the geographic location of your website visitors, enhancing targeted
                    engagement by tailoring content to regional audiences.
                </div>
            </details>

            <details class="wpie-details-sidebar">
                <summary>Multi Language</summary>
                <div class="wpie-details-sidebar-box">
                    Restrict modal visibility to users with a specific language setting, ensuring that the content is
                    relevant and understandable for the intended audience.
                </div>
            </details>

            <h4>Scheduling</h4>
            <details class="wpie-details-sidebar">
                <summary>Schedule</summary>
                <div class="wpie-details-sidebar-box">
                    Control when your popups appear by scheduling them based on specific days, times, or dates.
                    This allows you to plan and promote time-sensitive events or campaigns effectively, ensuring your
                    messages reach users at the optimal moment.
                </div>
            </details>
        </div>
    </details>
    <div class="wpie-buttons">
        <a href="https://wow-estore.com/interactive-demo-popup-box-pro/" target="_blank" class="wpie-button is-demo">Demo</a>
        <a href="https://wow-estore.com/item/popup-box-pro/" target="_blank" class="wpie-button is-pro">GET PRO</a>
    </div>
</div>

