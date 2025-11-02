<?php
/**
 * VK4WIP Theme - Custom Fields
 * Meta boxes for Events and Repeaters (native WordPress implementation)
 * For ACF integration, these can be replaced with ACF field groups
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Event Meta Boxes
 */
function vk4wip_add_event_meta_boxes() {
    add_meta_box(
        'vk4wip_event_details',
        __( 'Event Details', 'vk4wip-theme' ),
        'vk4wip_event_details_callback',
        'event',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'vk4wip_add_event_meta_boxes' );

/**
 * Event Details Meta Box Callback
 */
function vk4wip_event_details_callback( $post ) {
    wp_nonce_field( 'vk4wip_event_details_nonce', 'vk4wip_event_details_nonce' );
    
    $event_date = get_post_meta( $post->ID, '_vk4wip_event_date', true );
    $event_time = get_post_meta( $post->ID, '_vk4wip_event_time', true );
    $event_location = get_post_meta( $post->ID, '_vk4wip_event_location', true );
    $event_featured = get_post_meta( $post->ID, '_vk4wip_event_featured', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="vk4wip_event_date"><?php _e( 'Event Date', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="date" id="vk4wip_event_date" name="vk4wip_event_date" value="<?php echo esc_attr( $event_date ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Select the event date', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_event_time"><?php _e( 'Event Time', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="time" id="vk4wip_event_time" name="vk4wip_event_time" value="<?php echo esc_attr( $event_time ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Select the event time', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_event_location"><?php _e( 'Event Location', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="text" id="vk4wip_event_location" name="vk4wip_event_location" value="<?php echo esc_attr( $event_location ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Enter the event location (e.g., Club House, Online, etc.)', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_event_featured"><?php _e( 'Featured Event', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="checkbox" id="vk4wip_event_featured" name="vk4wip_event_featured" value="1" <?php checked( $event_featured, '1' ); ?> />
                <label for="vk4wip_event_featured"><?php _e( 'Display this event prominently on the homepage', 'vk4wip-theme' ); ?></label>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Event Meta Box Data
 */
function vk4wip_save_event_meta_boxes( $post_id ) {
    if ( ! isset( $_POST['vk4wip_event_details_nonce'] ) ) {
        return;
    }
    
    if ( ! wp_verify_nonce( $_POST['vk4wip_event_details_nonce'], 'vk4wip_event_details_nonce' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if ( isset( $_POST['vk4wip_event_date'] ) ) {
        update_post_meta( $post_id, '_vk4wip_event_date', sanitize_text_field( $_POST['vk4wip_event_date'] ) );
    }
    
    if ( isset( $_POST['vk4wip_event_time'] ) ) {
        update_post_meta( $post_id, '_vk4wip_event_time', sanitize_text_field( $_POST['vk4wip_event_time'] ) );
    }
    
    if ( isset( $_POST['vk4wip_event_location'] ) ) {
        update_post_meta( $post_id, '_vk4wip_event_location', sanitize_text_field( $_POST['vk4wip_event_location'] ) );
    }
    
    $featured = isset( $_POST['vk4wip_event_featured'] ) ? '1' : '0';
    update_post_meta( $post_id, '_vk4wip_event_featured', $featured );
}
add_action( 'save_post_event', 'vk4wip_save_event_meta_boxes' );

/**
 * Add Repeater Meta Boxes
 */
function vk4wip_add_repeater_meta_boxes() {
    add_meta_box(
        'vk4wip_repeater_details',
        __( 'Repeater Technical Details', 'vk4wip-theme' ),
        'vk4wip_repeater_details_callback',
        'repeater',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'vk4wip_add_repeater_meta_boxes' );

/**
 * Repeater Details Meta Box Callback
 */
function vk4wip_repeater_details_callback( $post ) {
    wp_nonce_field( 'vk4wip_repeater_details_nonce', 'vk4wip_repeater_details_nonce' );
    
    $frequency = get_post_meta( $post->ID, '_vk4wip_repeater_frequency', true );
    $offset = get_post_meta( $post->ID, '_vk4wip_repeater_offset', true );
    $tone = get_post_meta( $post->ID, '_vk4wip_repeater_tone', true );
    $coverage = get_post_meta( $post->ID, '_vk4wip_repeater_coverage', true );
    $callsign = get_post_meta( $post->ID, '_vk4wip_repeater_callsign', true );
    $location = get_post_meta( $post->ID, '_vk4wip_repeater_location', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="vk4wip_repeater_callsign"><?php _e( 'Callsign', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="text" id="vk4wip_repeater_callsign" name="vk4wip_repeater_callsign" value="<?php echo esc_attr( $callsign ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Repeater callsign (e.g., VK4RAI)', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_repeater_frequency"><?php _e( 'Frequency', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="text" id="vk4wip_repeater_frequency" name="vk4wip_repeater_frequency" value="<?php echo esc_attr( $frequency ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Output frequency in MHz (e.g., 146.900)', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_repeater_offset"><?php _e( 'Offset', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="text" id="vk4wip_repeater_offset" name="vk4wip_repeater_offset" value="<?php echo esc_attr( $offset ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Frequency offset (e.g., -600 kHz or -5 MHz)', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_repeater_tone"><?php _e( 'CTCSS Tone', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="text" id="vk4wip_repeater_tone" name="vk4wip_repeater_tone" value="<?php echo esc_attr( $tone ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'CTCSS tone in Hz (e.g., 91.5)', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_repeater_location"><?php _e( 'Location', 'vk4wip-theme' ); ?></label></th>
            <td>
                <input type="text" id="vk4wip_repeater_location" name="vk4wip_repeater_location" value="<?php echo esc_attr( $location ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'Repeater site location', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="vk4wip_repeater_coverage"><?php _e( 'Coverage Area', 'vk4wip-theme' ); ?></label></th>
            <td>
                <textarea id="vk4wip_repeater_coverage" name="vk4wip_repeater_coverage" rows="3" class="large-text"><?php echo esc_textarea( $coverage ); ?></textarea>
                <p class="description"><?php _e( 'Description of coverage area', 'vk4wip-theme' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Repeater Meta Box Data
 */
function vk4wip_save_repeater_meta_boxes( $post_id ) {
    if ( ! isset( $_POST['vk4wip_repeater_details_nonce'] ) ) {
        return;
    }
    
    if ( ! wp_verify_nonce( $_POST['vk4wip_repeater_details_nonce'], 'vk4wip_repeater_details_nonce' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    $fields = array(
        'vk4wip_repeater_callsign',
        'vk4wip_repeater_frequency',
        'vk4wip_repeater_offset',
        'vk4wip_repeater_tone',
        'vk4wip_repeater_location',
        'vk4wip_repeater_coverage',
    );
    
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $meta_key = '_' . $field;
            $value = ( $field === 'vk4wip_repeater_coverage' ) 
                ? sanitize_textarea_field( $_POST[ $field ] ) 
                : sanitize_text_field( $_POST[ $field ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
}
add_action( 'save_post_repeater', 'vk4wip_save_repeater_meta_boxes' );

/**
 * Helper function to get event date formatted
 */
function vk4wip_get_event_date( $post_id, $format = 'F j, Y' ) {
    $date = get_post_meta( $post_id, '_vk4wip_event_date', true );
    if ( $date ) {
        return date_i18n( $format, strtotime( $date ) );
    }
    return '';
}

/**
 * Helper function to get event time formatted
 */
function vk4wip_get_event_time( $post_id, $format = 'g:i A' ) {
    $time = get_post_meta( $post_id, '_vk4wip_event_time', true );
    if ( $time ) {
        return date_i18n( $format, strtotime( $time ) );
    }
    return '';
}

/**
 * Helper function to check if event is featured
 */
function vk4wip_is_featured_event( $post_id ) {
    return get_post_meta( $post_id, '_vk4wip_event_featured', true ) === '1';
}

/**
 * Helper function to get repeater frequency display
 */
function vk4wip_get_repeater_frequency_display( $post_id ) {
    $frequency = get_post_meta( $post_id, '_vk4wip_repeater_frequency', true );
    $offset = get_post_meta( $post_id, '_vk4wip_repeater_offset', true );
    $tone = get_post_meta( $post_id, '_vk4wip_repeater_tone', true );
    
    $display = '';
    if ( $frequency ) {
        $display .= $frequency . ' MHz';
    }
    if ( $offset ) {
        $display .= ' · ' . $offset;
    }
    if ( $tone ) {
        $display .= ' · ' . $tone . ' Hz';
    }
    
    return $display;
}
