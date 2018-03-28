<?php
/**
 * Plugin Name: Social Links Bar
 * Description: This plugin adds a navbar with social media links and a link to a contact page.
 * Version: 1.0.0
 * Author: Chriss Haddad
 * Author URI: https://koookiii.github.io/
 * License: GPL2
 */
 
 add_action( 'wp_enqueue_scripts', 'font_awesome' );
 
 function font_awesome() {
	wp_enqueue_style( 'icon-font', "//use.fontawesome.com/releases/v5.0.8/css/all.css");
	wp_enqueue_style( 'navbar-styling', plugin_dir_url( __FILE__ ) . 'css/navbar.css');
}

add_action('admin_menu', 'social_media_bar_menu');

function social_media_bar_menu() {
	add_menu_page('Social Media Bar', 'Social Media Bar Settings', 'administrator', 'social-media-bar-settings', 'social_media_bar_settings_page', 'dashicons-share');
}

function social_media_bar_settings_page(){
?>
<div class="wrap">
<h1>Social Media Links</h\1>

<form method="post" action="options.php">
    <?php settings_fields( 'my-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Facebook Url</th>
        <td><input type="text" name="facebook_link" value="<?php echo esc_attr( get_option('facebook_link') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Twitter Url</th>
        <td><input type="text" name="twitter_link" value="<?php echo esc_attr( get_option('twitter_link') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Pinterest Url</th>
        <td><input type="text" name="pinterest_link" value="<?php echo esc_attr( get_option('pinterest_link') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Youtube Url</th>
        <td><input type="text" name="youtube_link" value="<?php echo esc_attr( get_option('youtube_link') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Contact Page Url</th>
        <td><input type="text" name="contact_link" value="<?php echo esc_attr( get_option('contact_link') ); ?>" /></td>
        </tr>
         
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php
}

function social_media_bar_creation(){
    ?>
         <div class="navbar-container">
        <div class="navbar-contents">
            <div class="socials-section">
                <span class="social-bar-text">Follow Us !</span>
                <div class="social-icons-group">
                        <?php if(!empty(esc_attr( get_option('facebook_link')))) : ?>
                        <a href="<?php echo esc_attr( get_option('facebook_link'));?>" class="facebook-icon" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <?php endif;?>
                        <?php if(!empty(esc_attr( get_option('twitter_link')))) : ?>
                        <a href="<?php echo esc_attr( get_option('twitter_link'));?>" class="twitter-icon" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <?php endif;?>
                        <?php if(!empty(esc_attr( get_option('pinterest_link')))) : ?>
                        <a href="<?php echo esc_attr( get_option('pinterest_link'));?>" class="pinterest-icon" target="_blank">
                            <i class="fab fa-pinterest"></i>
                        </a>
                        <?php endif;?>
                        <?php if(!empty(esc_attr( get_option('youtube_link')))) : ?>
                        <a href="<?php echo esc_attr( get_option('youtube_link'));?>" class="youtube-icon" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <?php endif;?>
                </div>
            </div>
            <?php if(!empty(esc_attr( get_option('contact_link')))) : ?>
            <div class="contact-section">
                <a href="<?php echo esc_attr( get_option('contact_link'));?>" class="contact-text">
                    <i class="fas fa-envelope"></i><span class="social-bar-text">Contact Us !</span>
                </a>
            </div>
            <?php endif;?>
        </div>
    </div>

    <?php
}

add_shortcode('socials', 'social_media_bar_creation');


add_action( 'admin_init', 'social_media_bar_settings' );

function social_media_bar_settings() {
	register_setting( 'my-plugin-settings-group', 'facebook_link' );
	register_setting( 'my-plugin-settings-group', 'twitter_link' );
	register_setting( 'my-plugin-settings-group', 'youtube_link' );
	register_setting( 'my-plugin-settings-group', 'pinterest_link' );
	register_setting( 'my-plugin-settings-group', 'contact_link' );
}