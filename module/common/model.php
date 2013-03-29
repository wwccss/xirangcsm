<?php
/**
 * The model file of common module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     common
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class commonModel extends model
{
    /**
     * Start the session.
     * 
     * @access public
     * @return void
     */
    public function startSession()
    {
        $sessionName = RUN_MODE == 'front' ? 'frontsid' : 'adminsid';
        session_name($sessionName);
        session_start();
    }

    /**
     * Set the encoding of mb_string extension.
     * 
     * @access public
     * @return void
     */
    public function setEncodeing()
    {
        mb_internal_encoding('utf-8');
    }
    
    /**
     * Set the header info.
     * 
     * @access public
     * @return void
     */
    public function sendHeader()
    {
        header("Content-Type: text/html; Language={$this->config->encoding}");
        header("Cache-control: private");
    }

    /**
     * Set the user info.
     * 
     * @access public
     * @return void
     */
    public function setUser()
    {
        if($this->session->user) return $this->app->user = $this->session->user;

        /* Create a guest account. */
        $user           = new stdClass();
        $user->id       = 0;
        $user->account  = 'guest';
        $user->realname = 'guest';
        $user->isAdmin  = false;
        $user->isSuper  = false;

        if(RUN_MODE == 'cli')
        {
            $user->isSuper = true;
            $user->isAdmin = true;
        }

        $this->session->set('user', $user);
        $this->app->user = $this->session->user;
    }

    /**
     * Set config 
     * 
     * @access public
     * @return void
     */
    public function setConfig()
    {
        $config = $this->loadModel('setting')->getApiConfig();

        $this->config->api->openSync = $config->openSync;
        $this->config->api->key      = $config->key;
        $this->config->api->ip       = $config->ip;
    }

    /**
     * Get the run info.
     * 
     * @param mixed $startTime  the start time of this execution
     * @access public
     * @return array    the run info array.
     */
    public function getRunInfo($startTime)
    {
        $info['timeUsed'] = round(getTime() - $startTime, 4) * 1000;
        $info['memory']   = round(memory_get_peak_usage() / 1024, 1);
        $info['querys']   = count(dao::$querys);
        return $info;
    }

    /**
     * Get the full url of the system.
     * 
     * @access public
     * @return string
     */
    public function getSysURL()
    {
        global $config;
        $httpType = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on' ? 'https' : 'http';
        $httpHost = $_SERVER['HTTP_HOST'];
        return "$httpType://$httpHost";
    }

    /**
     * Check current user has priviledge to the module's method or not.
     * 
     * @todo add group priviledges.
     * @param mixed $module     the module
     * @param mixed $method     the method
     * @static
     * @access public
     * @return bool
     */
    public function hasPriv($module, $method)
    {
        if($this->app->user->role == 'admin')
        {
            return true;
        }
        else
        {
            $priv = $this->dao->select('t1.id')->from(TABLE_GROUP)->alias('t1')
                ->leftJoin(TABLE_GROUPPRIV)->alias('t2')->on('t1.id=t2.group')
                ->where('t1.name')->eq($this->app->user->role)
                ->andWhere('t2.module')->eq($module)
                ->andWhere('t2.method')->eq($method)
                ->fetchAll();
            if($priv) return true;
            return false;
        }
    }

    /**
     * check API 
     * 
     * @access public
     * @return bool
     */
    public function checkAPI()
    {
        $return = new stdclass();
        $return->result = 'fail';
        $return->error  = $this->lang->error->syncConfig;

        $jsonReturn = new stdclass();
        $jsonReturn->return = $return;

        $jsonView = new stdclass();
        $jsonView->status = 'success';
        $jsonView->data = json_encode($jsonReturn);
        $jsonView->md5  = md5($jsonView->data);
        $jsonView = json_encode($jsonView);

        if(!$this->config->api->openSync) die($jsonView);

        $key = '';
        if($this->get->apiKey)  $key = $this->get->apiKey;
        if($key != $this->config->api->key) die($jsonView);
        if(!empty($this->config->api->ip) and $this->server->remote_addr != $this->config->api->ip) die($jsonView);
    }

    /**
     * Check the priviledge of front.
     * 
     * @access public
     * @return void
     */
    public function checkFront()
    {
        $module = $this->app->getModuleName();
        $method = $this->app->getMethodName();

        /* The login, logout and deny page needn't check. */
        if($module == 'user' and strpos(',login|logout|deny|reset|check', $method)) return true;
        if($method == 'showfaq') return true;

        /* If no $app->user yet, go to the login pae. */
        if($this->app->user->account == 'guest')
        {
            $referer  = helper::safe64Encode($this->app->getURI(true));
            die(js::locate(helper::createLink('user', 'login', "referer=$referer")));
        }
        if(!$this->hasPriv($module, $method)) $this->deny($module, $method);
    }

    /**
     * Check the priviledge of admin.
     * 
     * @access public
     * @return void
     */
    public function checkAdmin()
    {
        $module = $this->app->getModuleName();
        $method = $this->app->getMethodName();

        /* The login, logout and deny page needn't check. */
        if($module == 'user' and strpos(',login|logout|deny|reset|check', $method)) return true;
        if(isset($_GET['apiKey']))
        {
            $this->checkAPI();
            return true;
            //if(($module == 'request' and $method == 'browse') or $method == 'replyapi' or $method == 'apisyncuser' or $method == 'changestatus' or ($module == 'product' and $method == 'getallproducts') or $method == 'syncproduct') return true;
        }

        /* If the suer not login, try login use the PHP_AUTH_USER. */
        if($this->app->user->account == 'guest' and $this->server->php_auth_user and $this->server->php_auth_pw)
        {
            $account  = $this->server->php_auth_user;
            $password = $this->server->php_auth_pw;
            $user = $this->loadModel('user')->identify($account, $password);

            /* If identify passed, authorize the user and register it to app and session .*/
            if($user)
            {
                $this->session->set('user', $user);
                $this->app->user = $user;
            }
        }

        /* If no $app->user yet, go to the login pae. */
        if($this->app->user->account == 'guest')
        {
            $referer  = helper::safe64Encode($this->app->getURI(true));
            die(js::locate(helper::createLink('user', 'login', "referer=$referer&from=zentao"), 'top'));
        }

        /* Check the priviledge. */
        if(!$this->hasPriv($module, $method)) $this->deny($module, $method);
    }

    /**
     * Show the deny info.
     * 
     * @param mixed $module     the module
     * @param mixed $method     the method
     * @access private
     * @return void
     */
    private function deny($module, $method)
    {
        $vars = "module=$module&method=$method";
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $referer  = helper::safe64Encode($_SERVER['HTTP_REFERER']);
            $vars .= "&referer=$referer";
        }
        $denyLink = helper::createLink('user', 'deny', $vars);
        die(js::locate($denyLink));
    }
}
