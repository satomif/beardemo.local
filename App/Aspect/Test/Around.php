<?php
/**
 * App
 *
 * @category   BEAR
 * @package    bear.demo
 * @subpackage Aspect
 * @author     $Author:$ <username@example.com>
 * @license    @license@ http://@license_url@
 * @version    Release: @package_version@ $Id:$
 * @link       http://@link_url@
 */

/**
 * Advice
 *
 * @category   BEAR
 * @package    bear.demo
 * @subpackage Aspect
 * @author     $Author:$ <username@example.com>
 * @license    @license@ http://@license_url@
 * @version    Release: @package_version@ $Id:$
 * @link       http://@link_url@
 */
class App_Aspect_Test_Around implements BEAR_Aspect_Around_Interface
{

    /**
     * Timer aroudアドバイス
     *
     * 処理時間をtimerプロパティとして実行結果に付加します。
     *
     * @param array                 $values
     * @param BEAR_Aspect_JoinPoint $joinPoint ジョインポイント
     *
     * @return array
     */
    public function around(array $values, BEAR_Aspect_JoinPoint $joinPoint)
    {
        // 前処理
        $time = microtime();
        // ターゲットメソッド実行
        $result = $joinPoint->proceed($values);
        // 後処理
        $obj = $joinPoint->getObject();
        $timer = microtime() - $time;
        $result['sec'] = $timer * 1000;
        return $result;
    }
}