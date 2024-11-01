<div id="wp_admin_notice_admin_wrapper" class="wrap wp_admin_notice_admin_wrapper">
<h2>WP Admin Notice</h2>
<p>
    <?php _e('This plugin allows you to show a simple notice to alert admins.') ?>
</p>

<div id="poststuff">

    <div id="post-body" class="metabox-holder columns-3">

	<!-- main content -->
	<div id="post-body-content">

	    <div class="meta-box-sortables ui-sortable">

		<div class="postbox">
		    <h3><span><?php _e('Settings');?></span></h3>
		    <div class="inside">
			<form method="post" action="options.php">
			    <?php settings_fields('wp_admin_notice_settings') ?>
			    <table class="form-table">
				<tr valign="top">
				    <th scope="row"><?php _e('Status') ?></th>
				    <td>
					<label for="wp_admin_notice_options_radio1">
					    <input type="radio" id="wp_admin_notice_options_radio1" name="wp_admin_notice_options[status]"
						   value="1" <?php echo $opts['status'] ? 'checked="checked"' : ''; ?> /> <?php _e('Enable') ?>
					</label>
					<br/>
					<label for="wp_admin_notice_options_radio2">
					    <input type="radio" id="wp_admin_notice_options_radio2" name="wp_admin_notice_options[status]"
						   value="0" <?php echo !$opts['status'] ? 'checked="checked"' : ''; ?> /> <?php _e('Disable') ?>
					</label>
				    </td>
				</tr>
				<tr>
				    <th scope="row"><?php _e('Text') ?></th>
				    <td>
					    <input type="text" id="wp_admin_notice_options_notice" class="widefat"
						   name="wp_admin_notice_options[notice]"
						   value="<?php echo esc_attr($opts['notice']); ?>" />
					<p>
					    <?php _e('Example: We are going to be doing server maintenance at 9pm today.') ?>
					</p>
				    </td>
				</tr>
                                <tr>
                                    <th scope="row"><?php _e('Size') ?></th>
                                    <td>
                                            <input type="text" id="wp_admin_notice_options_notice" class="widefat"
                                                   name="wp_admin_notice_options[font_size]"
                                                   value="<?php echo esc_attr($opts['font_size']); ?>" />
                                        <p>
                                            <?php _e('Set the font size of the notice text,default font size is 12px.') ?>
                                        </p>
                                    </td>
                                </tr>
				<tr>
				    <th scope="row"><?php _e('Text Color') ?></th>
				    <td>
					<label for="wp_admin_notice_options_text_color">
					    <input type="text" id="wp_admin_notice_options_text_color" size="7"
						   name="wp_admin_notice_options[text_color]"
						   value="<?php echo esc_attr($opts['text_color']); ?>" />

					    <div id="text_color_picker"></div> <!-- Used for old WP color picker WP < 3.5 -->
					</label>
					<p><?php _e('Set the color of the notice text,default color is #444') ?></p>
				    </td>
				</tr>
                                <tr>
                                    <th scope="row"><?php _e('Style') ?></th>
                                    <td>
                                        <label for="wp_admin_notice_options_style">
                                            <select id="wp_admin_notice_options_style" name="wp_admin_notice_options[style]">
                                                <option value="updated" <?php echo $opts['style']=='updated' ? 'selected' : '';?>>green</option>
                                                <option value="error"   <?php echo $opts['style']=='error' ? 'selected' : '';?>>red</option>
                                            </select>
                                        </label>
                                        <p><?php _e('Select the display style for notice') ?></p>
                                    </td>
                                </tr>
			    </table>
			    <p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			    </p>
			</form>
		    </div> <!-- .inside -->
		</div> <!-- .postbox -->

	    </div> <!-- .meta-box-sortables .ui-sortable -->

	</div> <!-- post-body-content -->

    </div> <!-- #post-body .metabox-holder .columns-3 -->

    <br class="clear">
</div> <!-- #poststuff -->

<!-- AddThis Button END part2 -->
</p>
<!-- /share -->

</div>
