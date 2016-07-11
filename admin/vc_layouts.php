<?php 

if(!( function_exists('web_home_personal_template') )){
function web_home_personal_template($data){
    $template               = array();
    $template['name']       = 'Web - Главная';
    $template['image_path'] = trailingslashit(get_template_directory_uri()) . 'style/img/chooser-images/personal.jpg';
    $template['custom_class'] = 'custom_template_for_vc_custom_template';
    $template['content']    = <<<CONTENT
        [vc_row background_style="full"][vc_column][web_page_header layout="logo" image="1150" big="Создание сайтов" sub="Весь комплекс услуг: от карандашного наброска, разработки прототипа и дизайн-макета будущего сайта до верстки, интеграции на WordPress, последующего продвижения и сопровождения проекта."][/web_page_header][web_section_title title="Title" subtitle="Subtitle"]Content[/web_section_title][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'web_home_personal_template' );
}
