<?php
/**
 * The control file of misc of XiRangCSM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     misc
 * @version     $Id: control.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
class misc extends control
{
    /**
     * Ping the server every 5 minutes to keep the session.
     * 
     * @access public
     * @return void
     */
    public function ping()
    {
        die("<html><head><meta http-equiv='refresh' content='300' /></head><body></body></html>");
    }

    /**
     * Show php info.
     * 
     * @access public
     * @return void
     */
    public function phpinfo()
    {
        die(phpinfo());
    }

    /**
     * Show about info of zentao.
     * 
     * @access public
     * @return void
     */
    public function about()
    {
        die($this->display());
    }
}
