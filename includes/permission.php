<?php

	$groupPriority[GROUPID_ADMIN] = 1;
	$groupPriority[GROUPID_MODERATOR] = 2;
	$groupPriority[GROUPID_JUDGE] = 3;
	$groupPriority[GROUPID_MEMBER] = 5;
	$groupPriority[GROUPID_GUEST] = 100;

	//format: $p[groupid] = array('{controllerGroup}' => array ('{controller}_{action}'));

		
	$groupPermisson[GROUPID_GUEST] = array(
		'site'		=>	array(
			'index_index',
			'login_index',
			#'register_index',
			'contact_index',
			'captcha_index',
			'notfound_index',
			'notpermission_index',
			'page_*',
			'photo_*',
			#'memberarea_index',
			#'user_*',
			'news_*',
			'statuslist_*',
			#'forgotpass_*',
		),
		
	);
	
	$groupPermisson[GROUPID_MEMBER] = array(
		'site'		=>	array(
			'index_index',
			'logout_index',
			#'profile_index',
			'contact_index',
			'captcha_index',
			'notfound_index',
			'notpermission_index',
			'page_*',
			#'memberarea_*',
			'photo_*',
			#'user_*',
			'news_*',
			'checkout_*',
			'statuslist_*',
			#'forgotpass_*',
			#'judge_*',
		),
		
	);
	
	$groupPermisson[GROUPID_JUDGE] = array(
		'site'		=>	array(
			'index_index',
			'logout_index',
			'profile_index',
			'contact_index',
			'captcha_index',
			'notfound_index',
			'notpermission_index',
			'page_*',
			'memberarea_*',
			'photo_*',
			'user_*',
			'news_*',
			'checkout_*',
			'statuslist_*',
			'forgotpass_*',
			'judge_*',
		),
		'admin'		=>	array(
			'index_index',
			'notfound_index',
			'notpermission_index',
		),
		
		
		
	);
	
	$groupPermisson[GROUPID_MODERATOR] = array(
		'site'		=>	array(
			'index_index',
			'logout_index',
			'profile_index',
			'contact_index',
			'captcha_index',
			'notfound_index',
			'notpermission_index',
			'page_*',
			'memberarea_*',
			'photo_*',
			'user_*',
			'news_*',
			'checkout_*',
			'statuslist_*',
			'forgotpass_*',
			'judge_*',
		),
		'admin'		=>	array(
			'index_index',
			'notfound_index',
			'notpermission_index',
			'contact_*',
			'user_*',
			'page_*',
			'news_*',
			'round_*',
			'judger_*',
			'language_*',
		),
		
		
		
	);
	
	$groupPermisson[GROUPID_ADMIN] = array(
		'site'		=>	array(
			'index_index',
			'logout_index',
			'profile_index',
			'contact_index',
			'captcha_index',
			'notfound_index',
			'notpermission_index',
			'page_*',
			'memberarea_*',
			'photo_*',
			'user_*',
			'news_*',
			'checkout_*',
			'statuslist_*',
			'forgotpass_*',
			'judge_*',
		),
		'admin'		=>	array(
			'index_index',
			'notfound_index',
			'notpermission_index',
			'contact_*',
			'user_*',
			'log_*',
			'page_*',
			'banner_*',
			'bannerposition_*',
			'news_*',
			'newscategory_*',
			'contestphoto_*',
			'product_*',
			'order_*',
			'round_*',
			'judger_*',
			'contestphotoready_*',
			'contestaward_*',
			'language_*',
		),
		
		
		
	);
?>