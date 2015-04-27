<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\acp;

class highlightunreadposts_module
{
	/** @var string The currenct action */
	public $u_action;

	/** @var \phpbb\config\config */
	public $new_config;

	/** @var string form key */
	public $form_key;
	
	/** @var array<string> list of errors that may have occured */
	public $error;

	/** @var string name of template */
	public $tpl_name;

	/** @var string page title */
	public $page_title;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/**
	 * Initialize needed service objects from container
	 * (This is cause dependency injection is not working in modules)
	 */
	public function init()
	{
		global $phpbb_container;

		$this->config		= $phpbb_container->get('config');
		$this->db			= $phpbb_container->get('dbal.conn');
		$this->user			= $phpbb_container->get('user');
		$this->template		= $phpbb_container->get('template');
		$this->request		= $phpbb_container->get('request');
		$this->error		= array();
	}

	/**
	 * Main function when module is executed
	 * @param int $id The ID of this module
	 * @param string $mode Current Mode
	 */
	public function main($id, $mode)
	{
		$this->init();

		$submit = ($this->request->is_set_post('submit')) ? true : false;

		$this->form_key = 'acp_highlightunreadposts';
		add_form_key($this->form_key);

		$display_vars = array(
			'title' => 'HUP_TITLE_ACP',
			'vars'	=> array(
				'legend1'										=> 'HUP_SETTINGS',
				'wolfsblvt.highlightunreadposts.color'			=> array('lang' => 'HUP_COLOR',		'validate' => 'color',		'type' => 'text:7:15',		'explain' => true),
				'legend2'										=> 'ACP_SUBMIT_CHANGES'
			),
		);

		// I form was submitted, we check this
		if ($submit)
		{
			$submit = $this->do_submit_stuff($display_vars);

			// If the submit was valid, we show success message
			if ($submit)
			{
				trigger_error($this->user->lang('CONFIG_UPDATED') . adm_back_link($this->u_action), E_USER_NOTICE);
			}
		}

		$this->generate_stuff_for_cfg_template($display_vars);

		// Output page template file
		$this->tpl_name = 'acp_highlightunreadposts';
		$this->page_title = $this->user->lang($display_vars['title']);
	}

	/**
	 * Abstracted method to do the submit part of the acp. Checks values, saves them
	 * and displays the message.
	 * If error happens, Error is shown and config not saved. (so this method quits and returns false)
	 *
	 * @param array<string,mixed> $display_vars The display vars for this acp site
	 * @param false|array<string,func> $special_functions Assoziative Array with config values where special functions should run on submit instead of simply save the config value. Array should contain 'config_value' => function ($this) { function code here }, or 'config_value' => null if no function should run.
	 * @return bool Submit valid or not.
	 */
	protected function do_submit_stuff($display_vars, $special_functions = false)
	{
		$this->new_config = $this->config;
		$cfg_array = ($this->request->is_set('config')) ? $this->request->variable('config', array('' => '')) : $this->new_config;

		validate_config_vars($display_vars['vars'], $cfg_array, $this->error);

		if (!check_form_key($this->form_key))
		{
			$this->error[] = $this->user->lang['FORM_INVALID'];
		}

		// Do not write values if there is one or more errors
		if (sizeof($this->error))
		{
			return false;
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || substr($config_name, 0, 6) === 'legend')
			{
				continue;
			}

			// We want to skip that, or run the function
			if (is_array($special_functions) && array_key_exists($config_name, $special_functions))
			{
				$func = $special_functions[$config_name];
				if (isset($func) && is_callable($func))
				{
					$func();
				}

				continue;
			}

			// Sets the config value
			$this->new_config[$config_name] = $cfg_array[$config_name];
			$this->config->set($config_name, $cfg_array[$config_name]);
		}

		return true;
	}

	/**
	 * Abstracted method to generate acp configuration pages out of a list of display vars, using
	 * the function build_cfg_template().
	 * Build configuration template for acp configuration pages
	 *
	 * @param array $display_vars The display vars for this acp site
	 */
	protected function generate_stuff_for_cfg_template($display_vars)
	{
		$this->new_config = $this->config;
		$cfg_array = ($this->request->is_set('config')) ? $this->request->variable('config', array('' => '')) : $this->new_config;

		validate_config_vars($display_vars['vars'], $cfg_array, $this->error);

		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$this->template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($this->user->lang[$vars])) ? $this->user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($this->user->lang[$vars['lang_explain']])) ? $this->user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($this->user->lang[$vars['lang'] . '_EXPLAIN'])) ? $this->user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$this->template->assign_block_vars('options', array(
				'KEY'				=> $config_key,
				'TITLE'				=> (isset($this->user->lang[$vars['lang']])) ? $this->user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'			=> $vars['explain'],
				'TITLE_EXPLAIN'		=> $l_explain,
				'CONTENT'			=> $content,
			));
		}

		$this->template->assign_vars(array(
			'S_ERROR'			=> (sizeof($this->error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $this->error),

			'U_ACTION'			=> $this->u_action)
		);
	}
}
