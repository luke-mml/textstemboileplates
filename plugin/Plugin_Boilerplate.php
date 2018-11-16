<?php
/**
 * The boilerplate Textstem plugin .
 * 
 * All plugins should extend Textstem_Plugin (which implements the 
 * Textstem_Interface_Plugin interface). 
 *
 * 
 * @package		Textstem
 * @subpackage		Plugin
 * @author		MML
 * 
 */
class Plugin_Boilerplate extends Textstem_Plugin
{

    // common static props
    public static $VERSION = 6.0;
    public static $DESCRIPTION = "Sample Textstem6 plugin. Provides a Wrangler tag to display 'Hello WorLd'";

    // Constructor ------------------------------------------------------------

    /**
     * If the plugin is loaded 'normally', a reference to the textstem object
     * will be passed in as the first parameter.   Use this to register for 
     * events and to register tags (aka shortcodes)
     * @param type $textstem
     */
    public function __construct(&$textstem = null)
    {
        if ($textstem)
        {
            // register wrangler tags
            $textstem->registerTags(array('wrt_helloworld'), $this);
            // reguster for textstem events
            $textstem->registerEventListener('afterPageLoad', $this);
        }
    }

    // Wrangler tag ------------------------------------------------------------

    /**
     * Wrangler tag to display "Hello World"
     * 
     * Tags can return HTML to inject into a page. Any parameters are bundled into
     * an array. Its up to the plug-in to validate the parameters 
     * 
     * @param array $params
     * @return string
     */
    public function wrt_helloworld($params = array())
    {

        $helloStyle = (isset($params['style'])) ? $params['style'] : '';
        return $this->_renderHello($helloStyle);
    }

    // Event Handlers ----------------------------------------------------------

    /**
     * Called when the pages loads. We get this event because we registered for 
     * it in the constructor above. Possible events (in order that they usually 
     * occur) include
     * 
     *  beforePageLoad  (before page data is loaded)
     *  afterPageLoad   (after page data -  such as articles - have bene loaded)  
     *  cleanUp         (last event)
     * 
     * @param type $request 
     */
    public function afterPageLoad($page)
    {
        // do something to $page
    }

    // Admin Helpers -----------------------------------------------------------

    /**
     * The admin UI has a little popup tool to help insert wrangler tags. This
     * describe function is used to build the popup and should return a short 
     * description of the tag, and a list the parameters the tag accepts...  
     * 
     * @return array
     */
    public function describe_helloworld()
    {
        return array(
            'summary' => "Say hello with style",
            'params' => array(
                array(
                    'name' => 'helloStyle',
                    'controltype' => 'select',
                    'options' => array('bold', 'italics', 'plain'),
                    'description' => 'Style to display hello wolrd'
                )
            )
        );
    }

    // Private methods  --------------------------------------------------------

    private function _renderHello($helloStyle)
    {
        switch ($helloStyle)
        {
            case 'bold':
                return '<b>Hello world</b>';
            case 'italics':
                return '<i>Hello world<i>';
        }
        return 'Hello world' . $helloStyle;
    }

}
