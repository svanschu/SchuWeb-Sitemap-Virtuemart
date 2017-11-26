<?php
/**
 * @version          $Id$
 * @copyright        Copyright (C) 2017 - 2018 Schultschik Websolutions. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @author           Sven Schultschik (extensions.schultschik.com)
 */

namespace Joomla\Component\Schuweb_Sitemap\Administrator\Controller;

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Component Controller
 *
 * @package     SchuWeb Sitemap
 * @subpackage  com_schuweb_sitemap
 *
 * @since 2.0
 */
class DisplayController extends BaseController
{

//    function __construct()
//    {
//        parent::__construct();
//
//        $this->registerTask('navigator-links', 'navigatorLinks');
//    }

    /**
     * The default view.
     *
     * @var    string
     * @since  1.6
     */
    protected $default_view = 'sitemaps';

    /**
     * Display the view
     *
     * @param   boolean  $cachable   If true, the view output will be cached
     * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return  BaseController|bool  This object to support chaining.
     *
     * @since   1.5
     */
    public function display($cachable = false, $urlparams = array())
    {
//        require_once JPATH_COMPONENT . '/helpers/schuweb_sitemap.php';
//
//        // Get the document object.
//        $document = \JFactory::getDocument();
//
//        $jinput = \JFactory::$application->input;

//        // Set the default view name and format from the Request.
//        $vName = $jinput->getWord('view', 'sitemaps');
//        $vFormat = $document->getType();
//        $lName = $jinput->getWord('layout', 'default');

        // Get and render the view.
//        if ($view = $this->getView($vName, $vFormat)) {
//            // Get the model for the view.
//            $model = $this->getModel($vName);
//
//            // Push the model into the view (as default).
//            $view->setModel($model, true);
//            $view->setLayout($lName);
//
//            // Push document object into the view.
//            $view->document = &$document;
//
//            $view->display();
//
//        }

        $view   = $this->input->get('view', 'sitemaps');
        $layout = $this->input->get('layout', 'sitemaps');
        $id     = $this->input->getInt('id');

        // Check for edit form.
        if ($view == 'sitemap' && $layout == 'edit' && !$this->checkEditId('com_schuweb_sitemap.edit.sitemap', $id))
        {
            // Somehow the person just went to the form - we don't allow that.
            $this->setMessage(\JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id), 'error');
            $this->setRedirect(\JRoute::_('index.php?option=com_schuweb_sitemap', false));

            return false;
        }

        return parent::display();
    }

//    function navigator()
//    {
//        $document = JFactory::getDocument();
//        $app = JFactory::getApplication('administrator');
//        $jinput = $app->input;
//
//        $id = $jinput->getInt('sitemap', 0);
//        if (!$id) {
//            $id = $this->getDefaultSitemapId();
//        }
//
//        if (!$id) {
//            $app->enqueueMessage(JText::_('SCHUWEB_SITEMAP_Not_Sitemap_Selected'), 'warning');
//            return false;
//        }
//
//        $app->setUserState('com_schuweb_sitemap.edit.sitemap.id', $id);
//
//        $view = $this->getView('sitemap', $document->getType());
//        $model = $this->getModel('Sitemap');
//        $view->setLayout('navigator');
//        $view->setModel($model, true);
//
//        // Push document object into the view.
//        $view->document = &$document;
//
//        $view->navigator();
//    }
//
//    function navigatorLinks()
//    {
//        $document = JFactory::getDocument();
//        $app = JFactory::getApplication('administrator');
//        $jinput = $app->input;
//
//        $id = $jinput->getInt('sitemap', 0);
//        if (!$id) {
//            $id = $this->getDefaultSitemapId();
//        }
//
//        if (!$id) {
//            $app->enqueueMessage(JText::_('SCHUWEB_SITEMAP_Not_Sitemap_Selected'), 'warning');
//            return false;
//        }
//
//        $app->setUserState('com_schuweb_sitemap.edit.sitemap.id', $id);
//
//        $view = $this->getView('sitemap', $document->getType());
//        $model = $this->getModel('Sitemap');
//        $view->setLayout('navigator');
//        $view->setModel($model, true);
//
//        // Push document object into the view.
//        $view->document = &$document;
//
//        $view->navigatorLinks();
//    }
//
//    private function getDefaultSitemapId()
//    {
//        $db = JFactory::getDBO();
//        $query = $db->getQuery(true);
//        $query->select('id');
//        $query->from($db->quoteName('#__schuweb_sitemap'));
//        $query->where('is_default=1');
//        $db->setQuery($query);
//        return $db->loadResult();
//    }

}