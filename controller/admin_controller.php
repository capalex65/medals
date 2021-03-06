<?php

/**
*
* @package phpBB Extension - Medals
* @copyright (c) 2016 Gabriel
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace gabriel\medals\controller;

/**
* Admin controller
*/

class admin_controller
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;
	/** @var \phpbb\request\request */
	protected $request;
	/** @var \phpbb\template\template */
	protected $template;
	/** @var \phpbb\user */
	protected $user;
	/** @var string phpBB root path */
	protected $root_path;
	/** @var string phpEx */
	protected $php_ext;
	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver_interface		$db					Database object
	* @param \phpbb\request\request					$request			Request object
	* @param \phpbb\template\template				$template			Template object
	* @param \phpbb\user							$user				User object
	* @param string							 		$root_path			phpBB root path
	* @param string							 		$php_ext			phpEx
	* @return \gabriel\medals\controller\admin_controller
	* @access public
	*/
	public function __construct(
			\phpbb\db\driver\driver_interface $db,
			\phpbb\request\request $request,
			\phpbb\template\template $template,
			\phpbb\user $user,
			$root_path,
			$php_ext)
	{
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public function edit_medals()
	{
		$this->template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'S_FIND_USER'		=> true,
			'U_FIND_USERNAME'	=> append_sid("{$this->root_path}memberlist.{$this->php_ext}", 'mode=searchuser&amp;form=select_user&amp;field=username&amp;select_single=true'),
		));

		if($this->request->is_set_post('submit-user'))
		{
			$username = $this->request->variable('username', '', true);

			$sql = 'SELECT *
				FROM ' . USERS_TABLE . "
				WHERE username_clean = '" . $this->db->sql_escape(utf8_clean_string($username)) . "'";
			$result = $this->db->sql_query($sql);
			$user = $this->db->sql_fetchrow($result);

			$this->db->sql_freeresult($result);

			if (!$user['user_id'])
			{
				trigger_error($this->user->lang['NO_USER'] . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$sql = 'SELECT *
					FROM ' . RANKS_TABLE . '
					WHERE rank_special = 1
					ORDER BY rank_title';
			$result = $this->db->sql_query($sql);

			$s_medal_one_options = '<option value="0"' . ((!$user['medal_one']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_two_options = '<option value="0"' . ((!$user['medal_two']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_three_options = '<option value="0"' . ((!$user['medal_three']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_four_options = '<option value="0"' . ((!$user['medal_four']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_five_options = '<option value="0"' . ((!$user['medal_five']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_six_options = '<option value="0"' . ((!$user['medal_six']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_seven_options = '<option value="0"' . ((!$user['medal_seven']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_eight_options = '<option value="0"' . ((!$user['medal_eight']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_nine_options = '<option value="0"' . ((!$user['medal_nine']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';
			$s_medal_ten_options = '<option value="0"' . ((!$user['medal_ten']) ? ' selected="selected"' : '') . '>' . $this->user->lang['ACP_NO_MEDAL'] . '</option>';

			while ($row = $this->db->sql_fetchrow($result))
			{
				$selected1 = ($user['medal_one'] && $row['rank_id'] == $user['medal_one']) ? ' selected="selected"' : '';
				$s_medal_one_options .= '<option value="' . $row['rank_id'] . '"' . $selected1 . '>' . $row['rank_title'] . '</option>';

				$selected2 = ($user['medal_two'] && $row['rank_id'] == $user['medal_two']) ? ' selected="selected"' : '';
				$s_medal_two_options .= '<option value="' . $row['rank_id'] . '"' . $selected2 . '>' . $row['rank_title'] . '</option>';

				$selected3 = ($user['medal_three'] && $row['rank_id'] == $user['medal_three']) ? ' selected="selected"' : '';
				$s_medal_three_options .= '<option value="' . $row['rank_id'] . '"' . $selected3 . '>' . $row['rank_title'] . '</option>';

				$selected4 = ($user['medal_four'] && $row['rank_id'] == $user['medal_four']) ? ' selected="selected"' : '';
				$s_medal_four_options .= '<option value="' . $row['rank_id'] . '"' . $selected4 . '>' . $row['rank_title'] . '</option>';

				$selected5 = ($user['medal_five'] && $row['rank_id'] == $user['medal_five']) ? ' selected="selected"' : '';
				$s_medal_five_options .= '<option value="' . $row['rank_id'] . '"' . $selected5 . '>' . $row['rank_title'] . '</option>';

				$selected6 = ($user['medal_six'] && $row['rank_id'] == $user['medal_six']) ? ' selected="selected"' : '';
				$s_medal_six_options .= '<option value="' . $row['rank_id'] . '"' . $selected6 . '>' . $row['rank_title'] . '</option>';

				$selected7 = ($user['medal_seven'] && $row['rank_id'] == $user['medal_seven']) ? ' selected="selected"' : '';
				$s_medal_seven_options .= '<option value="' . $row['rank_id'] . '"' . $selected7 . '>' . $row['rank_title'] . '</option>';

				$selected8 = ($user['medal_eight'] && $row['rank_id'] == $user['medal_eight']) ? ' selected="selected"' : '';
				$s_medal_eight_options .= '<option value="' . $row['rank_id'] . '"' . $selected8 . '>' . $row['rank_title'] . '</option>';

				$selected9 = ($user['medal_nine'] && $row['rank_id'] == $user['medal_nine']) ? ' selected="selected"' : '';
				$s_medal_nine_options .= '<option value="' . $row['rank_id'] . '"' . $selected9 . '>' . $row['rank_title'] . '</option>';

				$selected10 = ($user['medal_ten'] && $row['rank_id'] == $user['medal_ten']) ? ' selected="selected"' : '';
				$s_medal_ten_options .= '<option value="' . $row['rank_id'] . '"' . $selected10 . '>' . $row['rank_title'] . '</option>';
			}
			$this->db->sql_freeresult($result);

			$this->template->assign_vars(array(
				'ACP_MDLS_USER'			=> sprintf($this->user->lang['ACP_EDIT_MEDALS'], $user['username']),

				'S_EDIT_MEDALS'			=> true,
				'S_FIND_USER'			=> false,
				'S_MEDAL_ONE_OPTIONS'	=> $s_medal_one_options,
				'S_MEDAL_TWO_OPTIONS'	=> $s_medal_two_options,
				'S_MEDAL_THREE_OPTIONS'	=> $s_medal_three_options,
				'S_MEDAL_FOUR_OPTIONS'	=> $s_medal_four_options,
				'S_MEDAL_FIVE_OPTIONS'	=> $s_medal_five_options,
				'S_MEDAL_SIX_OPTIONS'	=> $s_medal_six_options,
				'S_MEDAL_SEVEN_OPTIONS'	=> $s_medal_seven_options,
				'S_MEDAL_EIGHT_OPTIONS'	=> $s_medal_eight_options,
				'S_MEDAL_NINE_OPTIONS'	=> $s_medal_nine_options,
				'S_MEDAL_TEN_OPTIONS'	=> $s_medal_ten_options,

				'HIDDEN_MEDAL_USER_ID'	=> (int) $user['user_id'],
			));
		}

		add_form_key('submit-medal-key');
		if($this->request->is_set_post('submit-medal'))
		{
			if (check_form_key('submit-medal-key'))
			{
				$medal_one = (int) $this->request->variable('user_medal_one', 0);
				$medal_two = (int) $this->request->variable('user_medal_two', 0);
				$medal_three = (int) $this->request->variable('user_medal_three', 0);
				$medal_four = (int) $this->request->variable('user_medal_four', 0);
				$medal_five = (int) $this->request->variable('user_medal_five', 0);
				$medal_six = (int) $this->request->variable('user_medal_six', 0);
				$medal_seven = (int) $this->request->variable('user_medal_seven', 0);
				$medal_eight = (int) $this->request->variable('user_medal_eight', 0);
				$medal_nine = (int) $this->request->variable('user_medal_nine', 0);
				$medal_ten = (int) $this->request->variable('user_medal_ten', 0);
				$upd_user_id = (int) $this->request->variable('hidden_user_id', 0);

				$upd_sql = 'UPDATE ' . USERS_TABLE . '
							SET medal_one = ' . $medal_one . ',
								medal_two = ' . $medal_two . ',
								medal_three = ' . $medal_three . ',
								medal_four = ' . $medal_four . ',
								medal_five = ' . $medal_five . ',
								medal_six = ' . $medal_six . ',
								medal_seven = ' . $medal_seven . ',
								medal_eight = ' . $medal_eight . ',
								medal_nine = ' . $medal_nine . ',
								medal_ten = ' . $medal_ten . '
							WHERE user_id = ' . $upd_user_id;
				$this->db->sql_query($upd_sql);

				trigger_error($this->user->lang('ACP_MDLS_SAVED') . adm_back_link($this->u_action) . '<br/>' . $medal_one . $medal_two . $medal_three . $medal_four . $medal_five . $medal_six . $medal_seven . $medal_eight . $medal_nine . $medal_ten . $upd_user_id);
			}
		}
	}

	/**
	 * Set page url
	 *
	 * @param string $u_action Custom form action
	 * @return null
	 * @access public
	 */
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
