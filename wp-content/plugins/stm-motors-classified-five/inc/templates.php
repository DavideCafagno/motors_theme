<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}


/**
 * Locate template in stm_classified_five scope
 *
 * @param string|array $templates Single or array of template files
 *
 * @return string
 */
function stm_c_f_locate_template($templates)
{
	$located = false;

	foreach ((array)$templates as $template) {
		if (substr($template, -4) !== '.php') {
			$template .= '.php';
		}

		if (!($located = locate_template('classified-five/' . $template))) {
			$located = STM_MOTORS_C_F_PATH . '/templates/' . $template;
		}

		if (file_exists($located)) {
			break;
		}

	}

	return apply_filters('stm_c_f_locate_template', $located, $templates);
}

/**
 * Load template
 *
 * @param $__template
 * @param array $__vars
 */
function stm_c_f_load_template($__template, $__vars = array())
{
	extract($__vars);
	include stm_c_f_locate_template($__template);
}

/**
 * Load a template part into a template.
 *
 * The same as core WordPress stm_c_f_load_template(), but also includes stm_classified_five scope
 *
 * @param string $template
 * @param string $name
 * @param array $vars
 */
function stm_c_f_template_part($template, $name = '', $vars = array())
{
	$templates = array();
	$name = (string)$name;
	if ('' !== $name) {
		$templates[] = "{$template}-{$name}.php";
	}

	$templates[] = "{$template}.php";

	if ($located = stm_c_f_locate_template($templates)) {
		stm_c_f_load_template($located, $vars);
	}
}

add_filter('archive_template', 'stm_c_f_archive_template');

function stm_c_f_archive_template($template)
{

	if (is_post_type_archive('stm_office')) {
		$located = stm_c_f_locate_template('archive.php');
		if ($located) {
			$template = $located;
		}
	}

	return $template;
}

add_filter('page_template', 'stm_c_f_archive_page_template');

function stm_c_f_archive_page_template($template)
{
	if (is_post_type_archive('stm_office')) {
		$located = stm_c_f_locate_template('archive.php');
		if ($located) {
			$template = $located;
		}
	}

	return $template;
}

add_filter('single_template', 'stm_get_single_c_f_template');

function stm_get_single_c_f_template($template)
{

	if (is_singular('stm_office') && $located = stm_c_f_locate_template('single.php')) {
		$template = $located;
	}

	return $template;
}

add_filter('template_include', 'stm_c_f_taxonomy_template');
function stm_c_f_taxonomy_template( $template ){

	if((is_tax('c_f_tag') || is_tax('c_f_category')) && $located = stm_c_f_locate_template('taxonomy.php')) {
		$template = $located;
	}

	return $template;
}