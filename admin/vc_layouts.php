<?php 

if(!( function_exists('web_home_personal_template') )){
function web_home_personal_template($data){
    $template               = array();
    $template['name']       = 'Web - Главная';
    $template['image_path'] = trailingslashit(get_template_directory_uri()) . 'style/img/chooser-images/personal.jpg';
    $template['custom_class'] = 'custom_template_for_vc_custom_template';
    $template['content']    = <<<CONTENT
	[vc_row full_width="stretch_row_content_no_spaces" content_placement="top" background_style="full" css=".vc_custom_1471870386717{background-color: #f9f9e3 !important;}"][vc_column][web_page_header layout="logo" image="1150" big="Создание сайтов" sub="Весь комплекс услуг: от карандашного наброска, разработки прототипа и дизайн-макета будущего сайта до верстки, интеграции на WordPress, последующего продвижения и сопровождения проекта."][/web_page_header][/vc_column][/vc_row][vc_row][vc_column][vc_row_inner][vc_column_inner][web_section_title title="Портфолио"][/web_section_title][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/4"][web_text title="Разработка сайтов WordPress" icon="icon_genius" lead="yes"][/web_text][/vc_column_inner][vc_column_inner width="1/4"][web_text title="Вёрстка макетов и шаблонов для WordPress" icon="icon_tools" lead="yes"][/web_text][/vc_column_inner][vc_column_inner width="1/4"][web_text title="Настройка кампании контекстной рекламы" icon="icon_like" lead="yes"][/web_text][/vc_column_inner][vc_column_inner width="1/4"][web_text title="Сопровождение и поддержка сайтов" icon="icon_tools" lead="yes"][/web_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" background_style="full" css=".vc_custom_1471415042537{background-color: #f9f9e3 !important;}"][vc_column][web_portfolio pppage="3" type="Fullwidth Portfolio"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'web_home_personal_template' );
}
