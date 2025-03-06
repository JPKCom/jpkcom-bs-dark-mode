<?php
/*
Plugin Name: JPKCom Bootstrap 5 Dark Mode Switch
Plugin URI: https://github.com/JPKCom/jpkcom-bs-dark-mode
Description: Shortcode [jpkcom-bs-dark-mode] and JS for Bootstrap 5 Dark Mode Switch.
Version: 2.0.0
Author: Jean Pierre Kolb <jpk@jpkc.com>
Author URI: https://www.jpkc.com
Contributors: JPKCom
Tags: Bootstrap, Light, Dark, Color, Theme, Shortcode, HTML, Gutenberg
Requires at least: 6.7
Tested up to: 6.7
Requires PHP: 8.3
Stable tag: trunk
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
GitHub Plugin URI: JPKCom/jpkcom-bs-dark-mode
Primary Branch: main
*/

if ( ! defined( constant_name: 'WPINC' ) ) {
	die;
}

// Add Shortcode

if ( ! function_exists( function: 'jpkcom_bs_dark_mode_switch' ) ) {

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
