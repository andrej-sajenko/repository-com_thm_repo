<?php
/**
 * @category    Joomla component
 * @package     THM_Repo
 * @subpackage  com_thm_repo.admin
 * @author      Stefan Schneider, <stefan.schneider@mni.thm.de>
 * @copyright   2013 TH Mittelhessen
 * @license     GNU GPL v.2
 * @link        www.mni.thm.de
 */

// No direct access to this file
defined('_JEXEC') or die;

// Import Joomla view library
jimport('joomla.application.component.view');

/**
 * THM_RepoViewVersions class for component com_thm_repo
 *
 * @category  Joomla.Component.Admin
 * @package   com_thm_repo.admin
 * @link      www.mni.thm.de
 */
class THM_RepoViewVersions extends JViewLegacy
{
	/**
	 * Folders view display method
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = null)
	{
		// Get data from the model
		$items      = $this->get('Items');
		$pagination = $this->get('Pagination');
		$state      = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JFactory::getApplication()->enqueueMessage(implode('<br />', $errors), 'error');

			return false;
		}
		// Assign data to the view
		$this->items         = $items;
		$this->pagination    = $pagination;
		$this->sortDirection = $state->get('list.direction');
		$this->sortColumn    = $state->get('list.ordering');

		// Set the toolbar
		$this->addToolBar();

		if (version_compare(JVERSION, '3', '<'))
		{
			$tpl = 'j25';
		}
		// Display the template
		parent::display($tpl);
	}

	/**
	 * Setting the toolbar
	 *
	 * @return void
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_THM_REPO_MANAGER_VERSIONS'));
		JToolBarHelper::back('Back', 'index.php?option=com_thm_repo&view=files');
	}
}
