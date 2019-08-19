<?php
/**
 * Plugin Name: WP GitHub Widgets
 * Description: Lightweight GitHub widgets plugin for your blog. Includes shortcode for embedding GitHub hosted gists/files and buttons for follow, watch, star, fork and more.
 * Version:     1.0.0
 * Author:      James Barnden
 * Author URI:  https://jamqes.com
 */

/**
 * Load script required for GitHub widgets in footer.
 * 
 * @since 1.0.0
 */
function wp_github_widgets_buttons_script() {
    // Don't enqueue more than once.
    if ( wp_script_is( 'github-buttons-js', 'enqueued' ) ) {
        return;
    }

    wp_enqueue_script(
        'github-buttons-js', 		// $handle
        __DIR__ . 'public/js/buttons.js',  // $src
        array(), 					// $deps
        false,						// $ver
        true						// $in_footer
    );
}

/**
 * Renders a follow button for the specified GitHub user.
 *
 * @since 1.0.0
 */
function wp_github_widgets_follow_button( $atts ) {
    $a = shortcode_atts( array(
        'user' => '',
        'size' => 'small',
        'show_count' => 'false',

    ), $atts);

    // Set size
    if ( $a['size'] == 'large' ) {
        $size = 'data-size="large"';
    } else { 
        $size = '';
    }

    // Set show count
    if ( $a['show-count'] == 'large' ) {
        $count = 'data-show-count="true"';
    } else { 
        $count = '';
    }

    // Load script in footer
    wp_github_widgets_buttons_script();

    // Render
    ob_start();

    // If user att was set
    if ( $a['user'] != '' ) {
        // Render button based on params
        ?>
            <a
                class="github-button"
                href="https://github.com/<?php $a['user']; ?>"
                aria-label="Follow @<?php $a['user']; ?> on GitHub"
                <?php if ( $size != '' ) { echo $size; } ?>
                <?php if ( $count != '' ) { echo $count; } ?>
            >
                Follow @<?php $a['user']; ?>
            </a>
        <?php
    }
    else {
        ?>
            <p>A required parameter was not passed to the github widget shortcode.</p>
        <?php
    }

	return ob_get_clean();
}

/**
 * Renders either Watch, Star, Fork, Issue or Download button for a specified
 * repository based on given parameters.
 *
 * @since 1.0.0
 */
function wp_github_widgets_repo_button ( $atts ) {
    $a = shortcode_atts( array(
        'type' => 'default',
        'user' => '',
        'repo' => '',
        'size' => 'small',
        'show_count' => 'false',
        'icon' => 'type_default'
    ), $atts);

    // Load script in footer
    wp_github_widgets_buttons_script();

    // Set size
    if ( $a['size'] == 'large' ) {
        $size = 'data-size="large"';
    } else {
        $size = '';
    }

    // Set show count
    if ( $a['show_count'] == 'true') {
        $count = 'data-show-count="true"';
    } else {
        $count = '';
    }

    // Set href and icon values
    if ( $a['type'] == 'watch' ) {
        $href = 'href="https://github.com/' . $a['user'] . '/' . $a['repo'] . '/subscription"';
        $icon = 'data-icon="octicon-eye"';
    } else if ( $a['type'] == 'star' ) {
        $href = 'href="https://github.com/' . $a['user'] . '/' . $a['repo'] . '"';
        $icon = 'data-icon="octicon-star"';
    } else if ( $a['type'] == 'fork' ) {
        $href = 'href="https://github.com/' . $a['user'] . '/' . $a['repo'] . '/fork"';
        $icon = 'data-icon="octicon-repo-forked"';
    } else if ( $a['type'] == 'issue' ) {
        $href = 'href="https://github.com/' . $a['user'] . '/' . $a['repo'] . '/issues"';
        $icon = 'data-icon="octicon-issue-opened"';
    } else if ( $a['type'] == 'download' ) {
        $href = 'href="https://github.com/' . $a['user'] . '/' . $a['repo'] . '/archive/master.zip"';
        $icon = 'data-icon="octicon-cloud-download"';
    } else {
        // Star by default
        $icon = 'data-icon="octicon-star"';
    }

    // Override icon if standard
    if ( $a['icon'] == 'standard' ) {
        $icon = '';
    }

    // Render
    ob_start();
    // If required atts were set
    if ( $a['user'] != '' && $a['repo'] != '' ) {
        // Render button based on params
        ?>
            <a
                class="github-button"
                <?php echo $href ?>
                aria-label="Follow @<?php $a['user']; ?> on GitHub"
                <?php echo $size ?>
                <?php echo $count ?>
                <?php if ( $icon != '' ) { echo $icon; } ?>
            >
                Follow @<?php $a['user']; ?>
            </a>
        <?php
    }
    else {
        ?>
            <p style="font-weight: bold;">A required parameter was not passed to the github widget shortcode.</p>
        <?php
    }
	return ob_get_clean();
}

/**
 * Renders the github hosted file at the specified URL.
 * 
 * @since 1.0.0
 */
function wp_github_widgets_display_file ( $atts ) {
    $a = shortcode_atts( array(
        'url' => ''
    ), $atts);

    // Render
    ob_start();
    if ( $a['url'] != '' ) {
        ?><script src="http://gist-it.appspot.com/<?php $a['url'] ?>"></script><?php
    } else {
        ?><p style="font-weight: bold;">The 'url' parameter was not passed to the github widget shortcode.</p><?php
    }

    ob_get_clean();
}
