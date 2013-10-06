<?php
//Build data
$titles = array(
    'title' => __('Tea Pages', TTO_I18N),
    'name' => __('Tea Pages', TTO_I18N),
    'slug' => '_pages',
    'submit' => false
);
$details = array(
    array(
        'type' => 'config',
        'title' => __('Simple, easy to use and fully integrated Theme Options for Wordpress.', TTO_I18N),
        'description' => __('In this panel you can easily create simple configuration pages which can help you in your built-in template. So, create a page, add fields into it and see the magic happens =)<br/>Do not forget the Tea T.O. <b><u>CAN NOT</u></b> make the link between your template and the admin panel alone! You will have to use the <code>_get_option()</code> (or default <code>get_option()</code>) method in your PHP template files to get back your values.</p><ul><li><b>As a developer</b>, create all fields you need in your built-in template. You can organize them through different pages and retrieve them thanks to their IDs (in top-right corner)</li><li><b>As a webmaster</b>, use the created pages to set your wanted values. You can see how did your developer organized them</li></ul><p>'),
        'content' => 'pages'
    )
);