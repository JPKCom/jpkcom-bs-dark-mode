<?php
/*
Plugin Name: JPKCom Bootstrap 5 Dark Mode Switch
Plugin URI: https://github.com/JPKCom/jpkcom-bs-dark-mode
Description: Shortcode [jpkcom-bs-dark-mode] and JS for Bootstrap 5 Dark Mode Switch.
Version: 2.0.5
Author: Jean Pierre Kolb <jpk@jpkc.com>
Author URI: https://www.jpkc.com
Contributors: JPKCom
Tags: Bootstrap, Color, Theme, Shortcode, Gutenberg
Requires at least: 6.9
Tested up to: 7.0
Requires PHP: 8.3
Stable tag: 2.0.5
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

declare(strict_types=1);

if ( ! defined( constant_name: 'WPINC' ) ) {
	die;
}


/**
 * Plugin Constants
 *
 * @since 2.0.3
 */
if ( ! defined( 'JPKCOM_BS_DARK_MODE_VERSION' ) ) {
    define( 'JPKCOM_BS_DARK_MODE_VERSION', '2.0.5' );
}


/**
 * Initialize Plugin Updater
 *
 * Loads and initializes the GitHub-based plugin updater with SHA256 checksum verification.
 *
 * @since 2.0.3
 *
 * @return void
 */
add_action( 'init', static function (): void {
    $updater_file = plugin_dir_path( __FILE__ ) . 'includes/class-plugin-updater.php';

    if ( file_exists( $updater_file ) ) {
        require_once $updater_file;

        if ( class_exists( 'JPKComBsDarkModeGitUpdate\\JPKComGitPluginUpdater' ) ) {
            new \JPKComBsDarkModeGitUpdate\JPKComGitPluginUpdater(
                plugin_file: __FILE__,
                current_version: JPKCOM_BS_DARK_MODE_VERSION,
                manifest_url: 'https://jpkcom.github.io/jpkcom-bs-dark-mode/plugin_jpkcom-bs-dark-mode.json'
            );
        }
    }
}, 5 );

// Add Shortcode

if ( ! function_exists( function: 'jpkcom_bs_dark_mode_switch' ) ) {

    /**
     * Render the Bootstrap 5 dark mode switch and its toggle script.
     *
     * Registered for the `[jpkcom-bs-dark-mode]` shortcode. Outputs a Bootstrap
     * form-switch and persists the selected theme in `localStorage` (`bsTheme`),
     * defaulting to dark mode.
     *
     * @since 1.0.0
     *
     * @return void
     */
    function jpkcom_bs_dark_mode_switch(): void {

    echo <<<EOL
<!-- Bootstrap 5 switch -->
<form class="d-flex">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="darkModeSwitch" checked>
        <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
    </div>
</form>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const htmlElement = document.documentElement;
    const switchElement = document.getElementById('darkModeSwitch');

    // Set the default theme to dark if no setting is found in local storage
    const currentTheme = localStorage.getItem('bsTheme') || 'dark';
    htmlElement.setAttribute('data-bs-theme', currentTheme);
    switchElement.checked = currentTheme === 'dark';

    switchElement.addEventListener('change', function () {
        if (this.checked) {
            htmlElement.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('bsTheme', 'dark');
        } else {
            htmlElement.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('bsTheme', 'light');
        }
    });
});
</script>
EOL;

    }

}

add_shortcode( 'jpkcom-bs-dark-mode', 'jpkcom_bs_dark_mode_switch' );
