<?php
/**
 * @version     $Id$
 * @copyright   Copyright (C) 2007 - 2009 Joomla! Vargas. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Guillermo Vargas (guille@vargas.co.cr)
 */

namespace Joomla\Component\Schuweb_Sitemap\Administrator\Helper;

// No direct access
defined('_JEXEC') or die;

/**
 * SchuWeb Sitemap Helper
 *
 * @since       2.0
 */
class SitemapHelper
{
    /**
     * Configure the Linkbar.
     *
     * @param    string  The name of the active view.
     *
     * @since   1.6
     */
    public static function addSubmenu($vName)
    {
        \JHtmlSidebar::addEntry(
            \JText::_('SCHUWEB_SITEMAP_Submenu_Sitemaps'),
            'index.php?option=com_schuweb_sitemap',
            $vName == 'sitemaps'
        );
        \JHtmlSidebar::addEntry(
            \JText::_('SCHUWEB_SITEMAP_Submenu_Extensions'),
            'index.php?option=com_plugins&view=plugins&filter_folder=schuweb_sitemap',
            $vName == 'extensions');
    }
}
