<?php
/**
 * @version     $Id$
 * @copyright   Copyright (C) 2007 - 2009 Joomla! Vargas. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Guillermo Vargas (guille@vargas.co.cr)
 */

namespace Joomla\Component\SchuWebSitemap\Administrator\Controller;

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Controller\AdminController;

/**
 * @package     SchuWeb Sitemap
 * @subpackage  com_schuweb_sitemap
 * @since       2.0
 */
class SitemapsController extends AdminController
{

    protected $text_prefix = 'com_schuweb_sitemap_SITEMAPS';

    /**
     * Constructor
     *
     * @param   array                $config   An optional associative array of configuration settings.
     * Recognized key values include 'name', 'default_task', 'model_path', and
     * 'view_path' (this list is not meant to be comprehensive).
     * @param   MVCFactoryInterface  $factory  The factory.
     * @param   CmsApplication       $app      The JApplication for the dispatcher
     * @param   \JInput              $input    Input
     *
     * @since   3.0
     */
    public function __construct($config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null)
    {
        parent::__construct($config, $factory, $app, $input);

        $this->registerTask('unpublish',    'publish');
        $this->registerTask('trash',        'publish');
        $this->registerTask('unfeatured',   'featured');
    }


    /**
     * Method to toggle the default sitemap.
     *
     * @return      void
     * @since       2.0
     */
    function setDefault()
    {
        $app = JFactory::$application;
        $input = $app->input;
        // Check for request forgeries
        $input->checkToken() or die('Invalid Token');

        // Get items to publish from the request.
        $cid = $input->getVar('cid', 0, '', 'array');
        $id  = @$cid[0];

        if (!$id) {
            $app->enqueueMessage(JText::_('Select an item to set as default'), 'warning');
        }
        else
        {
            // Get the model.
            $model = $this->getModel();

            // Publish the items.
            if (!$model->setDefault($id)) {
                $app->enqueueMessage($model->getError(), 'warning');
            }
        }

        $this->setRedirect('index.php?option=com_schuweb_sitemap&view=sitemaps');
    }

    /**
     * Proxy for getModel.
     *
     * @param    string    $name    The name of the model.
     * @param    string    $prefix    The prefix for the PHP class name.
     * @param   array   $config  The array of possible config values. Optional.
     *
     * @return  \Joomla\CMS\MVC\Model\BaseDatabaseModel
     *
     * @since    2.0
     */
    public function getModel($name = 'Sitemap', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}