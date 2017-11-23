<?php
/**
 * @version     $Id$
 * @copyright   Copyright (C) 2007 - 2009 Joomla! Vargas. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Guillermo Vargas (guille@vargas.co.cr)
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * @package     SchuWeb Sitemap
 * @subpackage  com_schuweb_sitemap
 * @since       2.0
 */
class SchuWeb_SitemapViewSitemaps extends JViewLegacy
{
    protected $state;
    protected $items;
    protected $pagination;

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        if ($this->getLayout() !== 'modal') {
            SchuWeb_SitemapHelper::addSubmenu('sitemaps');
        }

        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        $message = $this->get('ExtensionsMessage');
        if ($message) {
            JFactory::getApplication()->enqueueMessage($message);
        }

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JFactory::$application->enqueueMessage(implode("\n", $errors), 'error');
            return false;
        }

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal') {
            $this->addToolbar();
        }

        parent::display($tpl);
    }

    /**
     * Display the toolbar
     *
     * @access      private
     */
    protected function addToolbar()
    {
        $state = $this->get('State');
        $doc = \JFactory::getDocument();

        \JToolBarHelper::addNew('sitemap.add');
        \JToolBarHelper::custom('sitemap.edit', 'edit.png', 'edit_f2.png', 'JTOOLBAR_EDIT', true);

        $doc->addStyleDeclaration('.icon-48-sitemap {background-image: url(components/com_schuweb_sitemap/images/sitemap-icon.png);}');
        \JToolBarHelper::title(JText::_('SCHUWEB_SITEMAP_SITEMAPS_TITLE'), 'sitemap.png');
        \JToolBarHelper::custom('sitemaps.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_Publish', true);
        \JToolBarHelper::custom('sitemaps.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);

        \JToolBarHelper::custom('sitemaps.setdefault', 'featured.png', 'featured_f2.png', 'SCHUWEB_SITEMAP_TOOLBAR_SET_DEFAULT', true);

        if ($state->get('filter.published') == -2) {
            \JToolBarHelper::deleteList('', 'sitemaps.delete', 'JTOOLBAR_DELETE');
        } else {
            \JToolBarHelper::trash('sitemaps.trash', 'JTOOLBAR_TRASH');
        }
        \JToolBarHelper::divider();


        if (class_exists('JHtmlSidebar')){
            if (version_compare("4", JVERSION,'ge')) {
                JHtmlSidebar::addFilter(
                    \JText::_('JOPTION_SELECT_PUBLISHED'),
                    'filter_published',
                    JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
                );

                JHtmlSidebar::addFilter(
                    \JText::_('JOPTION_SELECT_ACCESS'),
                    'filter_access',
                    JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'))
                );
            }

            $this->sidebar = JHtmlSidebar::render();
        }
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   3.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => \JText::_('JGRID_HEADING_ORDERING'),
            'a.state'        => \JText::_('JSTATUS'),
            'a.title'        => \JText::_('JGLOBAL_TITLE'),
            'category_title' => \JText::_('JCATEGORY'),
            'access_level'   => \JText::_('JGRID_HEADING_ACCESS'),
            'a.created_by'   => \JText::_('JAUTHOR'),
            'language'       => \JText::_('JGRID_HEADING_LANGUAGE'),
            'a.created'      => \JText::_('JDATE'),
            'a.id'           => \JText::_('JGRID_HEADING_ID'),
            'a.featured'     => \JText::_('JFEATURED')
        );
    }
}
