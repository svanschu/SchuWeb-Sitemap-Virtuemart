<?php
/**
 * @version     $Id$
 * @copyright   Copyright (C) 2007 - 2009 Joomla! Vargas. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Guillermo Vargas (guille@vargas.co.cr)
 */

namespace Joomla\Component\Schuweb_Sitemap\Administrator\Controller;

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\MVC\Controller\FormController;

/**
 * @package     SchuWeb Sitemap
 * @subpackage  com_schuweb_sitemap
 * @since       2.0
 */
class SitemapController extends FormController
{
    /**
     * Method override to check if the user can edit an existing record.
     *
     * @param    array    An array of input data.
     * @param    string   The name of the key for the primary key.
     *
     * @return   boolean
     */
    protected function _allowEdit($data = array(), $key = 'id')
    {
        // Initialise variables.
        $recordId = (int) isset($data[$key]) ? $data[$key] : 0;
        $user = \JFactory::getUser();

        // Assets are being tracked, so no need to look into the category.
        return $user->authorise('core.edit', 'com_schuweb_sitemap.sitemap.'.$recordId);
    }
}