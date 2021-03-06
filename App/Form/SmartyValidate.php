<?php

require _BEAR_APP_HOME . '/App/vendors/SmartyValidate.class.php';

/**
 * App
 *
 * @category   BEAR
 * @package    bear.demo
 * @subpackage Form
 * @author     $Author:$ <username@example.com>
 * @license    @license@ http://@license_url@
 * @version    Release: @package_version@ $Id:$
 * @link       http://@link_url@
 */

/**
 * SmartyValidateフォーム
 *
 * SmartyValidateを使ったフォーム例です。QuickFormを使用していません。
 *
 * @category   BEAR
 * @package    bear.demo
 * @subpackage Form
 * @author     $Author:$ <username@example.com>
 * @license    @license@ http://@license_url@
 * @version    Release: @package_version@ $Id:$
 * @link       http://@link_url@
 */
class App_Form_SmartyValidate extends BEAR_Base implements App_Form_Interface
{
    /**
     * Inject
     *
     * @return void
     */
    public function onInject()
    {
        $this->_smarty = BEAR::dependency('BEAR_Smarty');
        $this->_post = $_POST;
    }


    /**
     * Set rules
     *
     * @return void
     */
    public function build()
    {
        if ($this->_post) {
            return;
        }
        // new form, we (re)set the session data
        SmartyValidate::connect($this->_smarty, true);
        // register our validators
        SmartyValidate::register_validator('fullname', 'FullName', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('phone', 'Phone', 'isNumber', true, false, 'trim');
        SmartyValidate::register_validator('expdate', 'CCExpDate', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('email', 'Email', 'isEmail', false,  false, 'trim');
        SmartyValidate::register_validator('date', 'Date', 'isDate', true, false, 'trim');
        SmartyValidate::register_validator('password', 'password:password2', 'isEqual');
    }

    /**
     * Is valid ?
     *
     * @return boolean
     */
    public function validate()
    {
        if (!$this->_post) {
            return false;
        }
        SmartyValidate::connect($this->_smarty);
        $isValid = SmartyValidate::is_valid($this->_post);
        if($isValid === true) {
            // no errors, done with SmartyValidate
            SmartyValidate::disconnect();
        } else {
            // error, redraw the form
            $this->_smarty->assign($this->_post);
        }
        return $isValid;
    }

    /**
     * Export only registered values
     *
     * @return array
     */
    public function exportValues()
    {
        $values = array('fullname' => $this->_post['FullName'],
                        'phone' => $this->_post['Phone'],
                        'expdate' => $this->_post['CCExpDate'],
                        'email' => $this->_post['Email'],
                        'date' => $this->_post['Date'],
                        'password' => $this->_post['password']);
        return $values;
    }
}