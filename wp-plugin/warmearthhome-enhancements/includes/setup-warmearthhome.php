<?php
/**
 * Initialization helpers to create taxonomy/pages/menu/homepage.
 */

if (!defined('ABSPATH')) {
	exit;
}

function wehp_create_product_categories() {
	if (term_exists('lighting', 'product_cat')) {
		return;
	}
	$lighting_id = wp_insert_term('Lighting', 'product_cat', array(
		'slug' => 'lighting',
		'description' => 'All lighting products'
	));
	if (!is_wp_error($lighting_id)) {
		$parent_id = $lighting_id['term_id'];
		$subcategories = array(
			array('name' => 'Wall Lights', 'slug' => 'wall-lights', 'description' => 'Wall mounted lighting fixtures'),
			array('name' => 'Pendant Lights', 'slug' => 'pendant-lights', 'description' => 'Pendant and hanging lights'),
			array('name' => 'Table Lamps', 'slug' => 'table-lamps', 'description' => 'Table and desk lamps'),
			array('name' => 'Floor Lamps', 'slug' => 'floor-lamps', 'description' => 'Floor standing lamps'),
		);
		foreach ($subcategories as $subcat) {
			wp_insert_term($subcat['name'], 'product_cat', array(
				'slug' => $subcat['slug'],
				'parent' => $parent_id,
				'description' => $subcat['description']
			));
		}
	}
}

function wehp_create_room_tags() {
	$room_tags = array('Bedroom','Living Room','Dining / Kitchen','Entryway');
	foreach ($room_tags as $tag) {
		if (!term_exists($tag, 'product_tag')) {
			wp_insert_term($tag, 'product_tag', array('slug' => sanitize_title($tag)));
		}
	}
}

function wehp_create_collection_tags() {
	$collections = array('Scandinavian Wood & Linen','Warm Brass & Opal Glass');
	foreach ($collections as $collection) {
		if (!term_exists($collection, 'product_tag')) {
			wp_insert_term($collection, 'product_tag', array('slug' => sanitize_title($collection)));
		}
	}
}

function wehp_create_support_pages() {
	$pages = array(
		array('title' => 'About Us', 'slug' => 'about-us', 'content' => 'Brand story and values will be added here.'),
		array('title' => 'Shipping & Returns', 'slug' => 'shipping-returns', 'content' => 'Shipping and returns policy will be added here.'),
		array('title' => 'Contact', 'slug' => 'contact', 'content' => 'Contact form and information will be added here.'),
	);
	foreach ($pages as $page) {
		$existing_page = get_page_by_path($page['slug']);
		if (!$existing_page) {
			wp_insert_post(array(
				'post_title' => $page['title'],
				'post_name' => $page['slug'],
				'post_content' => $page['content'],
				'post_status' => 'publish',
				'post_type' => 'page'
			));
		}
	}
}

function wehp_setup_navigation_menu() {
	$menu_name = 'Main Navigation';
	$menu_obj  = wp_get_nav_menu_object($menu_name);
	$menu_id   = $menu_obj ? (int) $menu_obj->term_id : 0;
	if (!$menu_id) {
		$menu_id = wp_create_nav_menu($menu_name);
		if (is_wp_error($menu_id)) return;
	}
	$existing_items = wp_get_nav_menu_items($menu_id);
	$existing_titles = array();
	if ($existing_items && !is_wp_error($existing_items)) {
		foreach ($existing_items as $item) { $existing_titles[] = $item->title; }
	}
	$has_item = function($title) use ($existing_titles) { return in_array($title, $existing_titles, true); };

	$shop_page_id = function_exists('wc_get_page_id') ? wc_get_page_id('shop') : 0;
	$shop_url     = $shop_page_id ? get_permalink($shop_page_id) : home_url('/shop/');

	$wall_term     = get_term_by('slug', 'wall-lights', 'product_cat');
	$pendant_term  = get_term_by('slug', 'pendant-lights', 'product_cat');
	$table_term    = get_term_by('slug', 'table-lamps', 'product_cat');
	$floor_term    = get_term_by('slug', 'floor-lamps', 'product_cat');

	$room_terms = array(
		get_term_by('slug', sanitize_title('Bedroom'), 'product_tag'),
		get_term_by('slug', sanitize_title('Living Room'), 'product_tag'),
		get_term_by('slug', sanitize_title('Dining / Kitchen'), 'product_tag'),
		get_term_by('slug', sanitize_title('Entryway'), 'product_tag'),
	);

	$collection_terms = array(
		get_term_by('slug', sanitize_title('Scandinavian Wood & Linen'), 'product_tag'),
		get_term_by('slug', sanitize_title('Warm Brass & Opal Glass'), 'product_tag'),
	);

	$about_page    = get_page_by_path('about-us');
	$shipping_page = get_page_by_path('shipping-returns');
	$contact_page  = get_page_by_path('contact');

	$shop_item_id = 0;
	if (!$has_item('Shop')) {
		$shop_item_id = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'  => 'Shop',
			'menu-item-url'    => esc_url_raw($shop_url),
			'menu-item-status' => 'publish',
		));
	}
	$parent_for_categories = is_wp_error($shop_item_id) || !$shop_item_id ? 0 : (int) $shop_item_id;
	$maybe_add_term_item = function($title, $term) use ($menu_id, $parent_for_categories, $has_item) {
		if ($term && !is_wp_error($term) && !$has_item($title)) {
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title'   => $title,
				'menu-item-object'  => 'product_cat',
				'menu-item-object-id'=> (int) $term->term_id,
				'menu-item-type'    => 'taxonomy',
				'menu-item-parent-id'=> $parent_for_categories,
				'menu-item-status'  => 'publish',
			));
		}
	};
	$maybe_add_term_item('Wall Lights', $wall_term);
	$maybe_add_term_item('Pendant Lights', $pendant_term);
	$maybe_add_term_item('Table Lamps', $table_term);
	$maybe_add_term_item('Floor Lamps', $floor_term);

	$space_item_id = 0;
	if (!$has_item('Shop by Space')) {
		$space_item_id = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'  => 'Shop by Space',
			'menu-item-url'    => esc_url_raw(home_url('/shop/space/')),
			'menu-item-status' => 'publish',
		));
	}
	$parent_for_space = is_wp_error($space_item_id) || !$space_item_id ? 0 : (int) $space_item_id;
	foreach ($room_terms as $term) {
		if ($term && !is_wp_error($term)) {
			if (!$has_item($term->name)) {
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title'    => $term->name,
					'menu-item-object'   => 'product_tag',
					'menu-item-object-id'=> (int) $term->term_id,
					'menu-item-type'     => 'taxonomy',
					'menu-item-parent-id'=> $parent_for_space,
					'menu-item-status'   => 'publish',
				));
			}
		}
	}

	$collections_item_id = 0;
	if (!$has_item('Collections')) {
		$collections_item_id = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'  => 'Collections',
			'menu-item-url'    => esc_url_raw(home_url('/collections/')),
			'menu-item-status' => 'publish',
		));
	}
	$parent_for_collections = is_wp_error($collections_item_id) || !$collections_item_id ? 0 : (int) $collections_item_id;
	foreach ($collection_terms as $term) {
		if ($term && !is_wp_error($term)) {
			if (!$has_item($term->name)) {
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title'    => $term->name,
					'menu-item-object'   => 'product_tag',
					'menu-item-object-id'=> (int) $term->term_id,
					'menu-item-type'     => 'taxonomy',
					'menu-item-parent-id'=> $parent_for_collections,
					'menu-item-status'   => 'publish',
				));
			}
		}
	}

	$support_item_id = 0;
	if (!$has_item('Support')) {
		$support_item_id = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'  => 'Support',
			'menu-item-url'    => esc_url_raw(home_url('/support/')),
			'menu-item-status' => 'publish',
		));
	}
	$parent_for_support = is_wp_error($support_item_id) || !$support_item_id ? 0 : (int) $support_item_id;
	$maybe_add_page_item = function($title, $page) use ($menu_id, $parent_for_support, $has_item) {
		if ($page && !is_wp_error($page) && !$has_item($title)) {
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title'    => $title,
				'menu-item-object'   => 'page',
				'menu-item-object-id'=> (int) $page->ID,
				'menu-item-type'     => 'post_type',
				'menu-item-parent-id'=> $parent_for_support,
				'menu-item-status'   => 'publish',
			));
		}
	};
	$maybe_add_page_item('About Us', $about_page);
	$maybe_add_page_item('Shipping & Returns', $shipping_page);
	$maybe_add_page_item('Contact', $contact_page);

	$locations = get_registered_nav_menus();
	$theme_locs = get_nav_menu_locations();
	if (!empty($locations)) {
		if (isset($locations['primary'])) {
			$theme_locs['primary'] = (int) $menu_id;
		} else {
			$first_slug = array_key_first($locations);
			if ($first_slug) { $theme_locs[$first_slug] = (int) $menu_id; }
		}
		set_theme_mod('nav_menu_locations', $theme_locs);
	}
}

function wehp_setup_homepage() {
	$show_on_front = get_option('show_on_front');
	$front_id      = (int) get_option('page_on_front');
	if ($show_on_front === 'page' && $front_id > 0) {
		return;
	}
	$home_page = get_page_by_path('home');
	if (!$home_page) {
		$page_id = wp_insert_post(array(
			'post_title'   => 'Home',
			'post_name'    => 'home',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		));
		if (is_wp_error($page_id)) { return; }
		$home_page = get_post($page_id);
	}
	update_post_meta($home_page->ID, '_wp_page_template', 'templates/wordpress/page-homepage.php');
	update_option('show_on_front', 'page');
	update_option('page_on_front', (int) $home_page->ID);
}

function wehp_initialize_site_structure() {
	if (!current_user_can('manage_options')) {
		return;
	}
	wehp_create_product_categories();
	wehp_create_room_tags();
	wehp_create_collection_tags();
	wehp_create_support_pages();
	wehp_setup_navigation_menu();
	wehp_setup_homepage();
}

// URL trigger: /wp-admin/?weh_setup=1
if (isset($_GET['weh_setup']) && current_user_can('manage_options')) {
	wehp_initialize_site_structure();
	echo '<div class="notice notice-success"><p>网站结构初始化完成！</p></div>';
}


