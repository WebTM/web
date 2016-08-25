<?php 

if(!( function_exists('web_home_personal_template') )){
function web_home_personal_template($data){
    $template               = array();
    $template['name']       = 'Web - Главная';
    $template['image_path'] = trailingslashit(get_template_directory_uri()) . 'style/img/chooser-images/personal.jpg';
    $template['custom_class'] = 'custom_template_for_vc_custom_template';
    $template['content']    = <<<CONTENT
	[vc_row full_width="stretch_row_content_no_spaces" content_placement="top" background_style="full" css=".vc_custom_1471870386717{background-color: #f9f9e3 !important;}"][vc_column][web_page_header layout="logo" image="1150" big="Создание сайтов" sub="Весь комплекс услуг: от карандашного наброска, разработки прототипа и дизайн-макета будущего сайта до верстки, интеграции на WordPress, последующего продвижения и сопровождения проекта."][/web_page_header][/vc_column][/vc_row][vc_row background_style="bg-primary" css=".vc_custom_1471352198947{background-color: #f9f9e3 !important;}"][vc_column width="1/3" style="Light Background" background_style="bg-primary"][web_text title="Веб-разработка на WordPress" icon="icon_genius" lead="yes"][/web_text][/vc_column][vc_column width="1/3"][web_text title="Вёрстка макетов и шаблонов для WordPress" icon="icon_tools" lead="yes"][/web_text][/vc_column][vc_column width="1/3"][web_text title="Сопровождение веб-проектов" icon="icon_tools" lead="yes"][/web_text][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" background_style="full" css=".vc_custom_1471415042537{background-color: #f9f9e3 !important;}"][vc_column][web_portfolio pppage="3" type="Fullwidth Portfolio"][/vc_column][/vc_row][vc_row css=".vc_custom_1471959441278{background-color: #ebf2f9 !important;}"][vc_column width="1/4"][web_text icon="icon_creditcard"][/web_text][/vc_column][vc_column width="1/4"][web_text][/web_text][/vc_column][vc_column width="1/4"][web_text][/web_text][/vc_column][vc_column width="1/4"][web_text][/web_text][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'web_home_personal_template' );
}
