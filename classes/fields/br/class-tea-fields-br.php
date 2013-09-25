<?php
/**
 * Tea Theme Options Br field
 * 
 * @package TakeaTea
 * @subpackage Tea Fields Br
 * @since Tea Theme Options 1.4.9
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
 * Tea Fields Br
 *
 * To get its own Fields
 *
 * @since Tea Theme Options 1.4.9
 *
 */
class Tea_Fields_Br extends Tea_Fields
{
    //Define protected vars

    /**
     * Constructor.
     *
     * @since Tea Theme Options 1.4.0
     */
    public function __construct(){}


    //--------------------------------------------------------------------------//

    /**
     * MAIN FUNCTIONS
     **/

    /**
     * Build HTML component to display in the Tea T.O. dashboard.
     *
     * @param number $number Define the position of the input
     * @param array $content Contains all data
     *
     * @since Tea Theme Options 1.4.0
     */
    public function templateDashboard($number = '__NUM__', $content = array())
    {
        //Get template
        include('in_dashboard.tpl.php');
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
        //Get template
        include('in_pages.tpl.php');
    }
}
