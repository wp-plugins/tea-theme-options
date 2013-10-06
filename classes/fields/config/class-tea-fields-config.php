<?php
/**
 * Tea Theme Options Config field
 * 
 * @package TakeaTea
 * @subpackage Tea Fields Config
 * @since Tea Theme Options 1.4.9.4
 *
 */

if (!defined('ABSPATH')) {
    die('You are not authorized to directly access to this page');
}


//---------------------------------------------------------------------------------------------------------//

//Require master Class
require_once(TTO_PATH . 'classes/class-tea-fields.php');

//---------------------------------------------------------------------------------------------------------//

/**
 * Tea Fields Config
 *
 * To get its own Fields
 *
 * @since Tea Theme Options 1.4.9.4
 *
 */
class Tea_Fields_Config extends Tea_Fields
{
    //Define protected vars
    private $currentpage;

    /**
     * Constructor.
     *
     * @since Tea Theme Options 1.4.9
     */
    public function __construct(){}


    //--------------------------------------------------------------------------//

    /**
     * MAIN FUNCTIONS
     **/

    /**
     * Build HTML component to display in the Tea T.O. config.
     *
     * @param number $number Define the position of the input
     * @param array $content Contains all data
     *
     * @since Tea Theme Options 1.4.9
     */
    public function templateDashboard($number = '__NUM__', $content = array())
    {
        //Do nothing
        return false;
    }

    /**
     * Build HTML component to display in all the Tea T.O. defined pages.
     *
     * @param array $content Contains all data
     *
     * @since Tea Theme Options 1.4.9
     */
    public function templatePages($content, $post = array())
    {
        //Define what to do: display pages or cpts configs
        if (isset($content['content']) && 'cpts' == $content['content'])
        {
            $this->templatePagesCpts($content);
        }
        else
        {
            $this->templatePagesDefaults($content);
        }
    }

    /**
     * Build HTML component to display in all the Tea T.O. defined pages.
     *
     * @param array $content Contains all data
     *
     * @since Tea Theme Options 1.4.9.4
     */
    public function templatePagesDefaults($content)
    {
        //Default variables
        $title = isset($content['title']) ? $content['title'] : __('Tea pages configuration', TTO_I18N);
        $description = isset($content['description']) ? $content['description'] : '';
        $page = $this->getCurrentPage();
        $includes = $this->getIncludes();
        $contents = array();

        //Get pages and contents
        $pages = _get_option('tea_config_pages', array());

        //Get lists
        $fonts = $this->getDefaults('fonts');
        $typesgood = $this->getDefaults('types');

        //Work on fonts
        $linkstylesheet = '';
        $gfontstyle = '';

        //Iterate on them
        foreach ($fonts as $ft)
        {
            if (empty($ft[0]) || 'sansserif' == $ft[0])
            {
                continue;
            }
            $linkstylesheet .= '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' . $ft[0] . ':' . $ft[2] . '" />' . "\n";
            $gfontstyle .= '.gfont_' . str_replace(' ', '_', $ft[1]) . ' {font-family:\'' . $ft[1] . '\',sans-serif;}' . "\n";
        }

        //Define ajax vars
        $action = TTO_ACTION;
        $nonce = esc_js(wp_create_nonce(TTO_NONCE));
        $ajax = admin_url() . 'admin-ajax.php';

        //Count pages and default pages
        $count_page = count($pages);

        //Work on contents
        foreach ($pages as $pg)
        {
            if (!isset($pg['contents']))
            {
                continue;
            }

            foreach ($pg['contents'] as $cont)
            {
                if (!isset($includes[$cont['type']]))
                {
                    $this->setIncludes($cont['type']);
                    require_once(TTO_PATH . 'classes/fields/' . $cont['type'] . '/class-tea-fields-' . $cont['type'] . '.php');
                }
            }
        }

        //Get template
        include('in_pages_header.tpl.php');
        include('in_pages_menu_pages.tpl.php');
        include('in_pages_content_pages.tpl.php');
        include('in_pages_footer.tpl.php');
    }

    /**
     * Build HTML component to display in all the Tea T.O. defined CPTs.
     *
     * @param array $content Contains all data
     *
     * @since Tea Theme Options 1.4.9.4
     */
    public function templatePagesCpts($content)
    {
        //Default variables
        $title = isset($content['title']) ? $content['title'] : __('Tea CPTs configurations', TTO_I18N);
        $description = isset($content['description']) ? $content['description'] : '';
        $page = $this->getCurrentPage();
        $includes = $this->getIncludes();
        $contents = array();

        //Get pages and contents
        $cpts = _get_option('tea_config_cpts', array());

        //Treat CPTS
        if (!in_array('page', $cpts))
        {
            $fkpage = array('page' => array('title' => __('Pages', TTO_I18N), 'slug' => 'page'));
            $cpts = array_merge($fkpage, $cpts);

            //Insert pages in DB
            _set_option('tea_config_cpts', $cpts);
        }
        if (!in_array('post', $cpts))
        {
            $fkpost = array('post' => array('title' => __('Posts', TTO_I18N), 'slug' => 'post'));
            $cpts = array_merge($fkpost, $cpts);

            //Insert pages in DB
            _set_option('tea_config_cpts', $cpts);
        }

        //Get lists
        $fonts = $this->getDefaults('fonts');
        $typesgood = $this->getDefaults('typescpts');

        //Work on fonts
        $linkstylesheet = '';
        $gfontstyle = '';

        //Iterate on them
        foreach ($fonts as $ft)
        {
            if (empty($ft[0]) || 'sansserif' == $ft[0])
            {
                continue;
            }
            $linkstylesheet .= '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' . $ft[0] . ':' . $ft[2] . '" />' . "\n";
            $gfontstyle .= '.gfont_' . str_replace(' ', '_', $ft[1]) . ' {font-family:\'' . $ft[1] . '\',sans-serif;}' . "\n";
        }

        //Define ajax vars
        $action = TTO_ACTION;
        $nonce = esc_js(wp_create_nonce(TTO_NONCE));
        $ajax = admin_url() . 'admin-ajax.php';

        //Count pages and default pages
        $count_cpt = count($cpts);

        //Work on contents
        foreach ($cpts as $cp)
        {
            if (!isset($cp['contents']))
            {
                continue;
            }

            foreach ($cp['contents'] as $cont)
            {
                if (!isset($includes[$cont['type']]))
                {
                    $this->setIncludes($cont['type']);
                    require_once(TTO_PATH . 'classes/fields/' . $cont['type'] . '/class-tea-fields-' . $cont['type'] . '.php');
                }
            }
        }

        //Get template
        include('in_pages_header.tpl.php');
        include('in_pages_menu_cpts.tpl.php');
        include('in_pages_content_cpts.tpl.php');
        include('in_pages_footer.tpl.php');
    }

    /**
     * Build action method.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9
     */
    public function actionConfig($request)
    {
        //Add page
        if (isset($request['add_page']))
        {
            $this->addPage($request);
        }
        //Edit page
        if (isset($request['edit_page']))
        {
            $this->editPage($request);
        }
        //Save page content
        else if (isset($request['save_page']))
        {
            $this->savePage($request);
        }
        //Delete page
        else if (isset($request['delete_page']))
        {
            $this->deletePage($request);
        }

        //Add custom post type
        else if (isset($request['add_cpt']))
        {
            $this->addCustomPostType($request);
        }
        //Edit custom post type
        else if (isset($request['edit_cpt']))
        {
            $this->editCustomPostType($request);
        }
        //Save cutsom post type content
        else if (isset($request['save_cpt']))
        {
            $this->saveCustomPostType($request);
        }
        //Delete cutsom post type
        else if (isset($request['delete_cpt']))
        {
            $this->deleteCustomPostType($request);
        }
    }

    /**
     * Add page.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9.4
     */
    protected function addPage($request)
    {
        //Check if a title has been defined
        if (!isset($request['tea_add_page_title']) || empty($request['tea_add_page_title']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no title is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Get vars
        $title = $request['tea_add_page_title'];
        $slug = sanitize_title_with_dashes($title);
        $slug = str_replace('-', '_', $slug);
        $description = isset($request['tea_add_page_description']) ? $request['tea_add_page_description'] : '';
        $submit = isset($request['tea_add_page_submit']) ? $request['tea_add_page_submit'] : '1';
        $submit = '1' == $submit ? true : false;

        //Get all pages
        $pages = _get_option('tea_config_pages', array());
        $pages = false === $pages || empty($pages) ? array() : $pages;

        //Check if slug is already in
        if (array_key_exists($slug, $pages))
        {
            $this->setAdminMessage(__('Something went wrong in your form: a page with your title already exists. Please, try another one.', TTO_I18N));
            return false;
        }

        $pages[$slug] = array(
            'title' => $title,
            'name' => $title,
            'description' => $description,
            'submit' => $submit,
            'slug' => $slug
        );

        //Insert pages in DB
        _set_option('tea_config_pages', $pages);
    }

    /**
     * Edit page.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9
     */
    protected function editPage($request)
    {
        //Check if a page has been defined
        if (!isset($request['tea_page']) || empty($request['tea_page']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no page is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Check if the user want to edit a page
        if (!isset($request['edit_page']))
        {
            $this->setAdminMessage(__('Something went wrong in your form. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Get all pages
        $pages = _get_option('tea_config_pages', array());
        $pages = false === $pages || empty($pages) ? array() : $pages;
        $slug = $request['tea_page'];

        //Check if the defined page exists properly
        if (!array_key_exists($slug, $pages))
        {
            $this->setAdminMessage(__('Something went wrong in your form: the defined page does not exist. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Check if a title has been defined
        if (!isset($request['tea_edit_page_title']) || empty($request['tea_edit_page_title']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no title is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Get vars
        $title = $request['tea_edit_page_title'];
        $description = isset($request['tea_edit_page_description']) ? $request['tea_edit_page_description'] : '';
        $contents = isset($pages[$slug]['contents']) ? $pages[$slug]['contents'] : array();
        $submit = isset($request['tea_edit_page_submit']) ? $request['tea_edit_page_submit'] : '1';
        $submit = '1' == $submit ? true : false;

        //Edit slug from pages
        $pages[$slug] = array(
            'title' => $title,
            'name' => $title,
            'description' => $description,
            'submit' => $submit,
            'slug' => $slug,
            'contents' => $contents
        );

        //Insert pages in DB
        _set_option('tea_config_pages', $pages);
    }

    /**
     * Save page content.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9.4
     */
    protected function savePage($request)
    {
        //Check if a page has been defined
        if (!isset($request['tea_page']) || empty($request['tea_page']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no page is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Check if the user want to save a page
        if (!isset($request['save_page']))
        {
            $this->setAdminMessage(__('Something went wrong in your form. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Get all pages
        $pages = _get_option('tea_config_pages', array());
        $pages = false === $pages || empty($pages) ? array() : $pages;
        $slug = $request['tea_page'];

        //Check if the defined page exists properly
        if (!array_key_exists($slug, $pages))
        {
            $this->setAdminMessage(__('Something went wrong in your form: the defined page does not exist. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Get vars
        $do_not_have_ids = $this->getDefaults('withoutids');
        $includes = $this->getIncludes();
        $currents = array();
        $adminmessage = '';

        //Iterate on each content
        if (isset($request['tea_add_contents']))
        {
            foreach ($request['tea_add_contents'] as $key => $ctn)
            {
                //Check if our type needs an id
                $needid = !in_array($ctn['type'], $do_not_have_ids) ? true : false;

                //Check if a title has been defined for all fields without IDs
                if ($needid && (!isset($ctn['title']) || empty($ctn['title'])))
                {
                    $adminmessage .= '<li>&bull; ' . sprintf(__('No title defined for your <b>%s</b> field.', TTO_I18N), $ctn['type']) . '</li>';
                    continue;
                }

                //Check if an id is required
                if ($needid)
                {
                    //Get the old ID if it was defined
                    $old_id = isset($pages[$slug]['contents'][$key]['id']) && !empty($pages[$slug]['contents'][$key]['id']) ? $pages[$slug]['contents'][$key]['id'] : '';

                    //Make the new ID
                    $sanittitle = sanitize_title_with_dashes($ctn['title']);
                    $sanittitle = str_replace('-', '_', $sanittitle);
                    $ctn['id'] = !empty($old_id) ? $old_id : $slug . '_' . $sanittitle;
                }

                //Include class field
                if (!isset($includes[$ctn['type']]))
                {
                    //Set the include
                    $this->setIncludes($ctn['type']);

                    //Require file
                    require_once(TTO_PATH . 'classes/fields/' . $ctn['type'] . '/class-tea-fields-' . $ctn['type'] . '.php');
                }

                //Make the magic and add content
                $class = 'Tea_Fields_' . ucfirst($ctn['type']);
                $treated_content = $class::saveContent($ctn);
                $currents[] = !empty($treated_content) ? $treated_content : $ctn;
            }
        }

        //Check if contents are already defined, so unset it
        if (isset($pages[$slug]['contents']) && !empty($pages[$slug]['contents']))
        {
            unset($pages[$slug]['contents']);
        }

        //Assign options to the current page
        $pages[$slug]['contents'] = $currents;

        //Insert contents in DB
        _set_option('tea_config_pages', $pages);

        //Check error messages without disturbing actions
        if (!empty($adminmessage))
        {
            $this->setAdminMessage('<p>' . __('Something went wrong in your form:', TTO_I18N) . '</p><ul>' . $adminmessage . '</ul><p>' . __('Please, try again by filling properly the form.', TTO_I18N) . '</p>');
            return false;
        }
    }

    /**
     * Delete page.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9
     */
    protected function deletePage($request)
    {
        //Check if a page has been defined
        if (!isset($request['tea_page']) || empty($request['tea_page']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no page is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Check if the user want to delete a page
        if (!isset($request['delete_page']))
        {
            $this->setAdminMessage(__('Something went wrong in your form. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Get all pages
        $pages = _get_option('tea_config_pages', array());
        $pages = false === $pages || empty($pages) ? array() : $pages;
        $slug = $request['tea_page'];

        //Check if the defined page exists properly
        if (!array_key_exists($slug, $pages))
        {
            $this->setAdminMessage(__('Something went wrong in your form: the defined page does not exist. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Delete slug from pages
        unset($pages[$slug]);

        //Insert pages in DB
        _set_option('tea_config_pages', $pages);
    }

    /**
     * Add Custom Post Type.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9.4
     */
    protected function addCustomPostType($request)
    {
        //Check if a title has been defined
        if (!isset($request['tea_add_cpt_title']) || empty($request['tea_add_cpt_title']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no title is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Get vars
        $title = $request['tea_add_cpt_title'];
        $slug = sanitize_title_with_dashes($title);
        $slug = str_replace('-', '_', $slug);

        //Get all pages
        $cpts = _get_option('tea_config_cpts', array());
        $cpts = false === $cpts || empty($cpts) ? array() : $cpts;

        //Check if slug is already in
        if (array_key_exists($slug, $cpts))
        {
            $this->setAdminMessage(__('Something went wrong in your form: a custom post type with your title already exists. Please, try another one.', TTO_I18N));
            return false;
        }

        $cpts[$slug] = array(
            'title' => $title,
            'slug' => $slug
        );

        //Insert pages in DB
        _set_option('tea_config_cpts', $cpts);
    }

    /**
     * Edit Custom Post Type.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9.4
     */
    protected function editCustomPostType($request)
    {
        //Check if a cpt has been defined
        if (!isset($request['tea_cpt']) || empty($request['tea_cpt']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no custom post type is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Check if the user want to edit a cpt
        if (!isset($request['edit_cpt']) || !isset($request['tea_add_cptcontent']))
        {
            $this->setAdminMessage(__('Something went wrong in your form. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Check if a title has been defined for all fields without IDs
        if (!isset($request['tea_add_cptcontent']['title']) || empty($request['tea_add_cptcontent']['title']))
        {
            $adminmessage = sprintf(__('Something went wrong in your form: no title defined for your <b>%s</b> Custom post type. Please, try again by filling properly the form.', TTO_I18N), $request['tea_cpt']);
            return false;
        }

        //Get all pages
        $cpts = _get_option('tea_config_cpts', array());
        $cpts = false === $cpts || empty($cpts) ? array() : $cpts;
        $slug = $request['tea_cpt'];

        //Check if the defined page exists properly
        if (!array_key_exists($slug, $cpts))
        {
            $this->setAdminMessage(__('Something went wrong in your form: the defined custom post type does not exist. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Add content
        $tac = $request['tea_add_cptcontent'];

        //Treat arrays
        $sups = isset($tac['supports']) && !empty($tac['supports']) ? array_keys($tac['supports']) : array();
        $taxs = isset($tac['taxonomies']) && !empty($tac['taxonomies']) ? array_keys($tac['taxonomies']) : array();

        //Get all
        $cpts[$slug]['singular_name'] = isset($tac['singular']) ? $tac['singular'] : '';
        $cpts[$slug]['menu_name'] = isset($tac['menu_name']) ? $tac['menu_name'] : '';
        $cpts[$slug]['all_items'] = isset($tac['all_items']) ? $tac['all_items'] : '';
        $cpts[$slug]['add_new'] = isset($tac['add_new']) ? $tac['add_new'] : '';
        $cpts[$slug]['add_new_item'] = isset($tac['add_new_item']) ? $tac['add_new_item'] : '';
        $cpts[$slug]['edit'] = isset($tac['edit']) ? $tac['edit'] : '';
        $cpts[$slug]['edit_item'] = isset($tac['edit_item']) ? $tac['edit_item'] : '';
        $cpts[$slug]['new_item'] = isset($tac['new_item']) ? $tac['new_item'] : '';
        $cpts[$slug]['view'] = isset($tac['view']) ? $tac['view'] : '';
        $cpts[$slug]['view_item'] = isset($tac['view_item']) ? $tac['view_item'] : '';
        $cpts[$slug]['search_items'] = isset($tac['search_items']) ? $tac['search_items'] : '';
        $cpts[$slug]['not_found'] = isset($tac['not_found']) ? $tac['not_found'] : '';
        $cpts[$slug]['not_found_in_trash'] = isset($tac['not_found_in_trash']) ? $tac['not_found_in_trash'] : '';
        $cpts[$slug]['parent_item_colon'] = isset($tac['parent_item_colon']) ? $tac['parent_item_colon'] : '';
        $cpts[$slug]['menu_icon'] = isset($tac['menu_icon']) ? $tac['menu_icon'] : '';

        //Taxonomies
        unset($cpts[$slug]['taxonomies']);
        $cpts[$slug]['taxonomies'] = $taxs;

        //Supports
        unset($cpts[$slug]['supports']);
        $cpts[$slug]['supports'] = $sups;

        //Options
        unset($cpts[$slug]['options']);
        $cpts[$slug]['options']['hierarchical'] = isset($tac['options']['hierarchical']) && $tac['options']['hierarchical'] ? true : false;
        $cpts[$slug]['options']['query_var'] = isset($tac['options']['query_var']) && $tac['options']['query_var'] ? true : false;
        $cpts[$slug]['options']['can_export'] = isset($tac['options']['can_export']) && $tac['options']['can_export'] ? true : false;

        //Insert contents in DB
        _set_option('tea_config_cpts', $cpts);
    }

    /**
     * Save Custom Post Type content.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9.4
     */
    protected function saveCustomPostType($request)
    {
        //Check if a cpt has been defined
        if (!isset($request['tea_cpt']) || empty($request['tea_cpt']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no custom post type is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Check if the user want to save a cpt
        if (!isset($request['save_cpt']))
        {
            $this->setAdminMessage(__('Something went wrong in your form. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Get all pages
        $cpts = _get_option('tea_config_cpts', array());
        $cpts = false === $cpts || empty($cpts) ? array() : $cpts;
        $slug = $request['tea_cpt'];

        //Check if the defined page exists properly
        if (!array_key_exists($slug, $cpts))
        {
            $this->setAdminMessage(__('Something went wrong in your form: the defined custom post type does not exist. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Get vars
        $do_not_have_ids = $this->getDefaults('withoutids');
        $includes = $this->getIncludes();
        $currents = array();
        $adminmessage = '';

        //Iterate on each content
        if (isset($request['tea_add_contents']))
        {
            foreach ($request['tea_add_contents'] as $key => $ctn)
            {
                //Check if our type needs an id
                $needid = !in_array($ctn['type'], $do_not_have_ids) ? true : false;

                //Check if a title has been defined for all fields without IDs
                if ($needid && (!isset($ctn['title']) || empty($ctn['title'])))
                {
                    $adminmessage .= '<li>&bull; ' . sprintf(__('No title defined for your <b>%s</b> field.', TTO_I18N), $ctn['type']) . '</li>';
                    continue;
                }

                //Check if an id is required
                if ($needid)
                {
                    //Get the old ID if it was defined
                    $old_id = isset($cpts[$slug]['contents'][$key]['id']) && !empty($cpts[$slug]['contents'][$key]['id']) ? $cpts[$slug]['contents'][$key]['id'] : '';

                    //Make the new ID
                    $sanittitle = sanitize_title_with_dashes($ctn['title']);
                    $sanittitle = str_replace('-', '_', $sanittitle);
                    $ctn['id'] = !empty($old_id) ? $old_id : $slug . '_' . $sanittitle;
                }

                //Include class field
                if (!isset($includes[$ctn['type']]))
                {
                    //Set the include
                    $this->setIncludes($ctn['type']);

                    //Require file
                    require_once(TTO_PATH . 'classes/fields/' . $ctn['type'] . '/class-tea-fields-' . $ctn['type'] . '.php');
                }

                //Make the magic and add content
                $class = 'Tea_Fields_' . ucfirst($ctn['type']);
                $treated_content = $class::saveContent($ctn);
                $currents[] = !empty($treated_content) ? $treated_content : $ctn;
            }
        }

        //Check if contents are already defined, so unset it
        if (isset($cpts[$slug]['contents']) && !empty($cpts[$slug]['contents']))
        {
            unset($cpts[$slug]['contents']);
        }

        //Assign options to the current page
        $cpts[$slug]['description'] = isset($request['tea_add_cptcontent']['description']) ? $request['tea_add_cptcontent']['description'] : '';
        $cpts[$slug]['singular'] = isset($request['tea_add_cptcontent']['singular']) ? $request['tea_add_cptcontent']['singular'] : '';
        $cpts[$slug]['contents'] = $currents;
        $cpts[$slug]['options']['public'] = isset($request['tea_add_cptcontent']['options']['public']) && $request['tea_add_cptcontent']['options']['public'] ? true : false;

        //Insert contents in DB
        _set_option('tea_config_cpts', $cpts);

        //Check error messages without disturbing actions
        if (!empty($adminmessage))
        {
            $this->setAdminMessage('<p>' . __('Something went wrong in your form:', TTO_I18N) . '</p><ul>' . $adminmessage . '</ul><p>' . __('Please, try again by filling properly the form.', TTO_I18N) . '</p>');
            return false;
        }
    }

    /**
     * Delete Custom Post Type.
     *
     * @param array $request Contains all data sent in $_REQUEST method
     *
     * @since Tea Theme Options 1.4.9
     */
    protected function deleteCustomPostType($request)
    {
        //Check if a cpt has been defined
        if (!isset($request['tea_cpt']) || empty($request['tea_cpt']))
        {
            $this->setAdminMessage(__('Something went wrong in your form: no custom post type is defined. Please, try again by filling properly the form.', TTO_I18N));
            return false;
        }

        //Check if the user want to delete a cpt
        if (!isset($request['delete_cpt']))
        {
            $this->setAdminMessage(__('Something went wrong in your form. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Get all pages
        $cpts = _get_option('tea_config_cpts', array());
        $cpts = false === $cpts || empty($cpts) ? array() : $cpts;
        $slug = $request['tea_cpt'];

        //Check if the defined page exists properly
        if (!array_key_exists($slug, $cpts))
        {
            $this->setAdminMessage(__('Something went wrong in your form: the defined custom post type does not exist. Please, try again by using the form properly.', TTO_I18N));
            return false;
        }

        //Delete slug from cpts
        unset($cpts[$slug]);

        //Iterate to delete wrong oldies
        foreach ($cpts as $key => $cpt)
        {
            if (!isset($cpt['slug']) || empty($cpt['slug']))
            {
                unset($cpts[$key]);
            }
        }

        //Insert pages in DB
        _set_option('tea_config_cpts', $cpts);
    }

    /**
     * ACCESSORS
     **/

    /**
     * Retrieve the $currentpage value
     *
     * @return string $currentpage Get the current page
     *
     * @since Tea Theme Options 1.4.9
     */
    protected function getCurrentPage()
    {
        //Return value
        return $this->currentpage;
    }

    /**
     * Define the $currentpage value
     *
     * @param string $currentpage Get the current page
     *
     * @since Tea Theme Options 1.4.9
     */
    public function setCurrentPage($currentpage = '')
    {
        $this->currentpage = $currentpage;
    }
}
