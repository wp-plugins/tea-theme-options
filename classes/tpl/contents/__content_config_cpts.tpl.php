<?php
//Build data
$titles = array(
    'title' => __('Tea Custom post types', TTO_I18N),
    'name' => __('Tea Post types', TTO_I18N),
    'slug' => '_cpts',
    'submit' => false
);
$details = array(
    array(
        'type' => 'config',
        'title' => __('You said "CTP"? Don\'t worry, it\'s quite easy ;)', TTO_I18N),
        'description' => __('In this panel you can easily create Wordpress custom post types ("CPT") which can help you to organize your contents efficiently.<br/>As you can see, 2 CPTs are already registered: <b>post</b> and <b>page</b> which are the two default Wordpress post types. So, create a CPT, add fields into it and see the magic happens =)<br/>Do not forget the Tea T.O. <b><u>CAN NOT</u></b> display automatically your new CPT in widgets or other blocks! You have to modify your PHP template files to retrieve contents.</p><ul><li><b>Note</b> if you don\'t see a CPT in your left Wordpress admin menu that means you forgot to enable it!</li></ul><p>'),
        'content' => 'cpts'
    )
);