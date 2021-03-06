<?php
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
 * エントリーフォーム
 *
 * @category   BEAR
 * @package    bear.demo
 * @subpackage Form
 * @author     $Author:$ <username@example.com>
 * @license    @license@ http://@license_url@
 * @version    Release: @package_version@ $Id:$
 * @link       http://@link_url@
 */
class App_Form_Blog_Entry extends BEAR_Base
{
    /**
     * Form config
     *
     * @var array
     */
    private $_form = array('formName' => 'form');

    /**
     * Form attribute
     *
     * @var array
     */
    private $_attr = array('title' => 'size="30" maxlength="30"', 'body' => 'rows="8" cols="40"');

    /**
     * Build form
     *
     * @return void
     */
    public function build()
    {
        $form = BEAR::factory('BEAR_Form', $this->_form);
        // ヘッダー
        $form->addElement('header', 'main', $this->_config['label']['main']);
        // フィールド
        $form->addElement('text', 'title', $this->_config['label']['title'], $this->_attr['title']);
        $form->addElement('textarea', 'body', $this->_config['label']['body'],  $this->_attr['body']);
        $form->addElement('submit', '_submit', $this->_config['label']['submit'], '');
        // フィルタと検証ルール
        $form->applyFilter('__ALL__', 'trim');
        $form->applyFilter('__ALL__', 'strip_tags');
        $form->addRule('title', $this->_config['error']['title_required'], 'required', null, 'client');
    }
}