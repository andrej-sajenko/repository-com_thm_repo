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

// Import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Createdby Form Field class for the THM Repo component
 *
 * @category  Joomla.Component.Admin
 * @package   com_thm_repo.admin
 */
class JFormFieldCreatedby extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 */
	protected $type = 'createdby';

	/**
	 * Method to get the field input markup.
	 *
	 * @return    string    The field input markup.
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		// Load user
		$user_id = $this->value;
		if ($user_id)
		{
			$user = JFactory::getUser($user_id);
		}
		else
		{
			$user = JFactory::getUser();

		}

		$html[] = '<input type="hidden" name="' . $this->name . '" value="' . $user->id . '" />';
		$html[] = '<input type="text" value="' . $user->name . ' (' . $user->username . ')" readonly />';

		return implode($html);
	}
}
