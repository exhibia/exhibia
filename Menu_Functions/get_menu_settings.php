<?php



function get_menu_settings($menu_id){
global $template;
switch($menu_id){
	
    case('design_menu'):

	  	$m_settings = array('header_tag' => array('h2'),
				   'menu_class' => array('menu', 'first'),
				  'table' => array('navigation', 'page_areas', 'page_areas_components',
				  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
  
	  	  break;
		    
				    case('user_menu1'):
						$m_settings = array(
								  'header_tag' => array('h3'),
								  'menu_class' => array('user_menu1'),
								  'table' => array('navigation', 'page_areas', 'page_areas_components',
								  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
				    break;
					case('user_menu2'):
						$m_settings = array(
								  'header_tag' => array('h5'),
								  'menu_class' => array('user_menu2'),
								  'table' => array('navigation', 'page_areas', 'page_areas_components',
								  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
				    break;
					case('user_menu3'):
						$m_settings = array(
								  'header_tag' => array('h5'),
								  'menu_class' => array('user_menu3'),
								  'table' => array('navigation', 'page_areas', 'page_areas_components',
								  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
				    break;
					case('user_menu4'):
						$m_settings = array(
								  'header_tag' => array('h5'),
								  'menu_class' => array('user_menu4'),
								  'table' => array('navigation', 'page_areas', 'page_areas_components',
								  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
				    break;
		      
    case('top_menu'):
	  	$m_settings = array(
				   'header_tag' => array('h2'),
				   'menu_class' => array('top_menu'),
				  'table' => array('navigation', 'page_areas', 'page_areas_components',
				  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
				  if($template == 'quibids-2.0'){
				  
				      $m_settings['menu_class'] = array('mainnav', 'top_menu');
				  }
    break;
    case('bidpack_menu'):
		$m_settings = array('header_tag' => array('h5'),
				  'menu_class' => '',
				  'table' => array('navigation', 'page_areas', 'page_areas_components',
				  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
    break;
    case('footer_menu'):
		$m_settings = array('header_tag' => array('h2'),
				  'menu_class' => array('footer_menu'),
				  'table' => array('navigation', 'page_areas', 'page_areas_components',
				  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
    break;
    case('help_menu'):
		$m_settings = array(
				  'header_tag' => array('h2'), 
				   'menu_class' => array('help_menu'),
				  'table' => array('navigation', 'page_areas', 'page_areas_components',
				  'select' => array('name', 'parent', 'menu_name', 'menu_index')));
  
    break;
    case('forums_menu'):
    break;

}

return $m_settings;

}


