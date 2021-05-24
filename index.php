<?php
$uri = isset($_GET['uri']) ? $_GET['uri'] : '';

// die("1".$uri."1");
// echo "$folder1/$folder2/$folder3/$file-$cat-$item";
require(__DIR__.'/smarty/libs/SmartyBC.class.php');
$root_dir = __DIR__;
$smarty = new SmartyBC;
//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;
// $smarty->cache_lifetime = 120;

$templates = array(
	1 => 'index.tpl', 2 => 'shop_menu/index.tpl', 21 => 'shop_menu/large_category.tpl', 22 => 'shop_menu/small_category.tpl', 23 => 'shop_menu/manufacturer.tpl', 24 => 'shop_menu/mounting_price.tpl', 25 => 'shop_menu/product_sales_price.tpl', 26 => 'shop_menu/store_introduction.tpl', 27 => 'shop_menu/factory_introduction.tpl', 28 => 'shop_menu/introduction_to_island.tpl', 29 => 'shop_menu/introduction.tpl', 3 => 'original_product/index.tpl', 31 => 'original_product/original_category.tpl', 32 => 'original_product/original_product_price.tpl', 30 => '', 4 => 'tire_wheel/index.tpl', 41 => 'tire_wheel/tire.tpl', 42 => 'tire_wheel/tire_maker.tpl', 43 => 'tire_wheel/tire_price.tpl', 44 => 'tire_wheel/wheel.tpl', 45 => 'tire_wheel/wheel_maker.tpl', 46 => 'tire_wheel/wheel_price.tpl', 5 => 'campaign/index.tpl', 50 => 'campaign/campaign.tpl', 6 => 'wholesale/index.tpl', 8 => 'company.tpl', 404 => '404.tpl'
);

$page = array(
	'uri' => $uri,
	'id_template' => 404,
	'meta_title' => 'Page Not Found',
	'meta_description' => 'Page Not Found',
	'meta_keywords' => '404',
	'content' => 'Page Not Found'
);

$file = __DIR__.'/db/db.csv';
$handle = fopen($file, "r");
$row = fgetcsv($handle, 0, ",");

while (($row = fgetcsv($handle, 0, ",")) !== false) 
{
    $page = array(
    	'uri' => (string) $row[0],
    	'id_template' => (int) $row[1],
    	'meta_title' => (string) $row[2],
    	'meta_description' => (string) $row[3],
    	'meta_keywords' => (string) $row[4],
    	'content' => (string) $row[5]
    );

    if((string)$page['uri'] == (string)$uri) break;
}

fclose($handle);



$js_custom_vars = array(
	'google_conversion_id' => 970727982,
	'google_custom_params' => 'window.google_tag_params',
	'google_remarketing_only' => true
);

$javascript = array(
	'head' => array(

		'external' => array(
			"https://code.jquery.com/jquery-3.3.1.slim.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js",
			"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js",
			"/assets/jcarousel/jquery.jcarousel.min.js",
			"/assets/jcarousel/jcarousel.responsive.js",
		),
		'inline' => array()
	),
	'bottom' => array(
		'external' => array(
			"/assets/js/header_blu.js",
		),
		'inline' => array()
	)
);

$stylesheets = array(

	'external' => array(
		"/assets/css/search.css",
		"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css",
		"/assets/css/header_blu.css",
		"/assets/css/mainbody_blu.css",
		"/assets/css/footer_blu.css",
		"/assets/jcarousel/jcarousel.responsive.css",
		"/assets/jcarousel/style.css",
		"https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap"
	),
	'inline' => array(
	)
);

$search_values = array(
	'manufacturer' => isset($_POST["manufacturer"]) ? $_POST["manufacturer"] : "",
	'type' => isset($_POST["type"]) ? $_POST["type"] : "",
	'model' => isset($_POST["model"]) ? $_POST["model"] : "",
	'pattern' => isset($_POST["pattern"]) ? $_POST["pattern"] : "",
);

$smarty->assign(array(
	'stylesheets' => $stylesheets,
	'javascript' => $javascript,
	'js_custom_vars' => $js_custom_vars,
	'page' => $page,
	'search_values' => $search_values,
	'base_url' => __DIR__
));

// $smarty->display($templates[(int) $page['id_template']]);
$smarty->display($templates[(int) 1]);
