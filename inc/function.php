<?php

//-----------LA_C_IFRAME ------------------//
// Add Shortcode
function la_content_iframe_render($atts = null, $content = null)
{
	$atts = shortcode_atts(
		array(
			'iframe' => '',
		),
		$atts
	);
	// $content = do_shortcode($content);

	$path = plugin_dir_path(__DIR__) . "linha_iframe/iframes/" . $atts['iframe'] . "/index.php";
	$url = plugin_dir_url(__DIR__) . "linha_iframe/iframes/" . $atts['iframe'] . "/index.html";

	ob_start();
	?>
	<div class="iframe-content">
		<div class="bg">
			<iframe src="<?= $url ?>" frameborder="0" style="width: 100%; height: 100%" scrolling="no"></iframe>
		</div>
		<div class="text">
			<?= $content ?>
		</div>
	</div>

	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('linha_content_iframe_render', 'la_content_iframe_render');



?>