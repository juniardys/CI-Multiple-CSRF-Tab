<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Multiple CSRF Tab Library
 *
 * Work with remote servers via cURL much easier than using the native PHP bindings.
 *
 * @package        	CodeIgniter-Multiple-CSRF-Tab
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Juniardy Setiowidayoga
 */

/**
 * Class Csrf
 */
class Csrf {
	/**
	 * Csrf Name Stored in Session
	 *
	 * @var string
	 **/
	var $name = 'csrf_token';

	/**
	 * Csrf Expired time
	 *
	 * @var int
	 **/
	var $expired = 3600;

	/**
	 * CI
	 *
	 * @var object
	 **/
	var $CI;

	/**
	 * __construct
	 *
	 * @author Juniardy Setiowidayoga
	 */
	public function __construct(array $config = array())
	{
		foreach ($config as $key => $value) {
			$this->key = $value;
		}
		$this->CI =& get_instance();
		if(!function_exists('set_cookie')) $this->CI->load->helper('cookie');
		$this->refresh_token();
	}

	/**
	 * Set name to set name of session csrf stored
	 *
	 * @param string $name
	 *
	 * @author Juniardy Setiowidayoga
	 */
	public function set_name(string $name)
	{
		$this->name = $name;
	}

	/**
	 * Set expired to set time of csrf expired in seconds
	 *
	 * @param int $expired
	 *
	 * @author Juniardy Setiowidayoga
	 */
	public function set_expired(int $expired)
	{
		$this->expired = $expired;
	}

	/**
	 * Refresh token to refresh expired token (delete expired token from session
	 *
	 * @author Juniardy Setiowidayoga
	 */
	public function refresh_token()
	{
		$ses = $this->CI->session->userdata($this->name);
		if(empty($ses)) $ses = array();
		foreach ($ses as $key => $row) {
			if($row['expired'] < time()){
				unset($ses[$key]);
				continue;
			}
		}
		$new_ses = $ses;
		$this->CI->session->unset_userdata($this->name);
		$this->CI->session->set_userdata($this->name, $new_ses);
	}

	/**
	 * Generate Token to generate csrf token
	 *
	 *
	 * @return string
	 * @author Juniardy Setiowidayoga
	 */
	public function gen_token()
	{
		$this->CI->load->helper('string');
		$value = random_string('alnum', 20);
		$ses = $this->CI->session->userdata($this->name);
		$ses[] = array('value' => $value, 'expired' => time()+$this->expired);
		$this->CI->session->unset_userdata($this->name);
		$this->CI->session->set_userdata($this->name, $ses);
		return $value;
	}

	/**
	 * Validation Token to check token is valid or not
	 *
	 * @param string $value
	 *
	 * @return bool
	 * @author Juniardy Setiowidayoga
	 */
	public function valid_token($value = null)
	{
		if(empty($value)) return false;
		$ses = $this->CI->session->userdata($this->name);
		foreach (@$ses as $key => $row) {
			if($row['expired'] < time()){
				unset($ses[$key]);
				continue;
			}
			if($value === $row['value']){
				$new_ses = $ses;
				unset($new_ses[$key]);
				sort($new_ses);
				$this->CI->session->unset_userdata($this->name);
				$this->CI->session->set_userdata($this->name, $new_ses);
				return true;
			}
		}
		return false;
	}

	/**
	 * Delete Token to remove csrf token from session
	 *
	 * @param string $value
	 *
	 * @author Juniardy Setiowidayoga
	 */
	public function delete_token($value = null)
	{
		if (empty($value)) {
			$this->CI->session->unset_userdata($this->name);
		} else {
			$ses = $this->CI->session->userdata($this->name);
			foreach (@$ses as $key => $row) {
				if($row['expired'] < time()){
					unset($ses[$key]);
					continue;
				}
				if($value === $row['value']){
					$new_ses = $ses;
					unset($new_ses[$key]);
					sort($new_ses);
					$this->CI->session->unset_userdata($this->name);
					$this->CI->session->set_userdata($this->name, $new_ses);
				}
			}
		}
	}
}
