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

// Import Joomla controlleradmin library
jimport('joomla.application.component.controllerform');

/**
 * Folders Controller
 *
 * @category  Joomla.Component.Admin
 * @package   thm_repo
 *
 */
class THM_RepoControllerFolders extends JControllerForm
{
	/**
	 * Call delete function
	 *
	 * @return void
	 */
	public function delete()
	{
		$cid   = JRequest::getVar('cid', array(), 'post', 'array');
		$model = $this->getModel('folder');
		if ($model->delete($cid))
		{
			$msg = JText::_('COM_THM_REPO_DELETE_SUCCESSFUL');
		}
		else
		{
			$msg = JText::_('COM_THM_REPO_DELETE_ERROR');
		}

		$this->setRedirect('index.php?option=com_thm_repo&view=folders', $msg);
	}

	/**
	 * Order up
	 *
	 * @return void
	 */
	public function orderup()
	{
		$model = $this->getModel('folders');

		if ($model->reorder(-1))
		{
			$msg = JText::_('COM_THM_REPO_ORDER_SUCCESSFUL');
		}
		else
		{
			$msg = JText::_('COM_THM_REPO_ORDER_ERROR');
		}

		$this->setRedirect('index.php?option=com_thm_repo&view=folders', $msg);
	}

	/**
	 * Order down
	 *
	 * @return void
	 */
	public function orderdown()
	{
		$model = $this->getModel('folders');

		if ($model->reorder(1))
		{
			$msg = JText::_('COM_THM_REPO_ORDER_SUCCESSFUL');
		}
		else
		{
			$msg = JText::_('COM_THM_REPO_ORDER_ERROR');
		}

		$this->setRedirect('index.php?option=com_thm_repo&view=folders', $msg);
	}

	/**
	 * Publish folder
	 *
	 * @return void
	 */
	public function publish()
	{
		global $option;
		$cid = JRequest::getVar('cid', array(), 'request', 'array');
		JTable::addIncludePath(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_thm_repo' . DS . 'tables');
		$row =& JTable::getInstance('folder', 'THM_RepoTable');

		if ($this->getTask() == 'publish')
		{
			$publish = 1;
		}

		$row->publish($cid, $publish);
		$msg = JText::_('COM_THM_REPO_N_ITEMS_PUBLISHED');

		$this->setRedirect('index.php?option=com_thm_repo&view=folders', $msg);
	}

	/**
	 * Unpublish folder
	 *
	 * @return void
	 */
	public function unpublish()
	{
		global $option;
		$cid = JRequest::getVar('cid', array(), 'request', 'array');
		JTable::addIncludePath(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_thm_repo' . DS . 'tables');
		$row =& JTable::getInstance('folder', 'THM_RepoTable');

		if ($this->getTask() == 'unpublish')
		{
			$publish = 0;
		}

		$row->publish($cid, $publish);
		$msg = JText::_('COM_THM_REPO_N_ITEMS_PUBLISHED');


		$this->setRedirect('index.php?option=com_thm_repo&view=folders', $msg);
	}
}
