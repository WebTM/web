<?php 

if(!( function_exists('web_home_personal_template') )){
function web_home_personal_template($data){
    $template               = array();
    $template['name']       = 'Web - Home Personal';
    $template['image_path'] = trailingslashit(get_template_directory_uri()) . 'style/img/chooser-images/personal.jpg';
    $template['custom_class'] = 'custom_template_for_vc_custom_template';
    $template['content']    = <<<CONTENT
        [vc_row background_style="full"][vc_column width="1/1"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'web_home_personal_template' );
}
