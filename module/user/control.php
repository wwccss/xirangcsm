<?php
/**
 * The control file of user module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class user extends control
{
    /**
     * The referer
     * 
     * @var string
     * @access private
     */
    private $referer;

    public function index()
    {
        $this->locate($this->createLink('request', 'browse'));
        $this->display();
    }

    /**
     * Create customer 
     * 
     * @access public
     * @return void
     */
    public function create($type)
    {
        if($this->config->api->openSync and $type != 'customer') 
        {
            echo js::error($this->lang->user->cannotCreate);
            die(js::locate('back'));
        }
        if(!empty($_POST))
        {
            $this->user->create($type);
            if(dao::isError()) die(js::error(dao::getError()));

            if($type == 'customer')
            {
                echo js::alert($this->lang->user->customer->created);
            }
            else
            {
                echo js::alert($this->lang->user->inside->created);
            }
            die(js::locate($this->createLink('user', 'browse', "type=$type"), 'parent'));
        }

        $this->view->type = $type;
        $this->display();
    }

    /**
     * Login.
     * 
     * @param string $referer 
     * @access public
     * @return void
     */
    public function login($referer = '')
    {
        $this->setReferer($referer);

        $loginLink = $this->createLink('user', 'login');
        $denyLink  = $this->createLink('user', 'deny');
        $regLink   = $this->createLink('user', 'register');

        /* If the suer logon already, goto the pre page. */
        if($this->user->isLogon())
        {
            if(strpos($this->referer, $loginLink) === false and 
               strpos($this->referer, $denyLink)  === false and 
               strpos($this->referer, $regLink)   === false 
            )
            {
                $this->locate($this->referer);
            }
            else
            {
                $this->locate($this->createLink($this->config->default->module, $this->config->default->method));
            }
        }

        /* If the user sumbit post, check the user and then authorize him. */
        if(!empty($_POST))
        {
            $user = $this->user->identify($this->post->account, $this->post->password);
            if($user)
            {
                if(RUN_MODE == 'admin' and $user->role == 'customer') 
                {
                    die(js::alert($this->lang->user->customerNotLoginAdmin));
                }
                if(RUN_MODE == 'front' and $user->role != 'customer') 
                {
                    die(js::alert($this->lang->user->insideNotLoginFront));
                }

                /* Register the session. */
                $this->session->set('user', $user);
                $this->app->user = $this->session->user;

                /* Admin mode, goto the default module directly. */
                //if(RUN_MODE == 'admin') die(js::locate($this->createLink($this->config->default->module, $this->config->default->method), 'parent'));

                /* Goto the referer or to the default module */
                if($this->post->referer != false and 
                   strpos($this->post->referer, $loginLink) === false and 
                   strpos($this->post->referer, $denyLink)  === false and 
                   strpos($this->post->referer, $regLink)   === false
                )
                {
                    die(js::locate(urldecode($_POST['referer']), 'parent'));
                }
                else
                {
                    die(js::locate($this->createLink('request', 'browse'), 'parent'));
                }
            }
            else
            {
                die(js::error($this->lang->user->loginFailed));
            }
        }

        $this->view->header->title = $this->lang->user->login->common;
        $this->view->referer       = $this->referer;
        $this->display();
    }

    /**
     * logout 
     * 
     * @param int $referer 
     * @access public
     * @return void
     */
    public function logout($referer = 0)
    {
        session_destroy();
        $vars = !empty($referer) ? "referer=$referer" : '';
        $this->locate($this->createLink('user', 'login', $vars));
    }

    /**
     * The deny page.
     * 
     * @param mixed $module             the denied module
     * @param mixed $method             the deinied method
     * @param string $refererBeforeDeny the referer of the denied page.
     * @access public
     * @return void
     */
    public function deny($module, $method, $refererBeforeDeny = '')
    {
        $this->app->loadLang($module);

        $this->setReferer();

        $this->view->header->title     = $this->lang->user->deny;
        $this->view->module            = $module;
        $this->view->method            = $method;
        $this->view->denyPage          = $this->referer;
        $this->view->refererBeforeDeny = $refererBeforeDeny;

        die($this->display());
    }

    /**
     * Browse customer's serviceTime of product
     *
     * @access public
     * @return void
     */
    public function myService()
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        $this->view->serviceProducts = $this->user->getServiceProducts($this->app->user->id);
        $this->display();
    }
    
    /**
     * Browse customers or inside accounts 
     * 
     * @param  string $type 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function browse($type, $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        if($type == 'customer')
        {
            $this->view->users = $this->user->getCustomers($pager);
        }
        else
        {
            $this->view->users = $this->user->getInsideAccount($pager);
        }

        $this->view->type  = $type;
        $this->view->pager = $pager;
        $this->display();
    }

    /**
     * View current user's profile.
     * 
     * @access public
     * @return void
     */
    public function profile( $userID = '', $type = 'customer')
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        $userID = empty($userID) ? $this->app->user->id : $userID;
        $this->view->user = $this->user->getByID($userID);
        $this->view->type = $type;
        $this->display();
    }

    /**
     * Edit a user. 
     * 
     * @access public
     * @return void
     */
    public function edit($userID = 0, $type = 'customer')
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        if($userID == 0)
        {
            $user = $this->user->getByID($this->app->user->id);
            $userID = $user->id;
        }
        else
        {
            $currentUser = $this->user->getByID($this->app->user->id);
            if($currentUser->role == 'customer' and $userID != $currentUser->id)
            {
                echo js::alert($this->lang->user->modifySelf);
                die(js::locate($this->createLink('request', 'browse'), 'parent'));
            }
            $user = $this->user->getByID($userID);
        }

        if(!empty($_POST))
        {
            $this->user->update($userID);
            if(dao::isError()) die(js::error(dao::getError()));
            if(RUN_MODE == 'admin')
            {
                die(js::locate(inlink('browse', "type=$type"), 'parent'));
            }
            elseif(RUN_MODE == 'front')
            {
                die(js::locate($this->createLink('user', 'profile'), 'parent'));
            }
        }

        $this->view->type = $type;
        $this->view->user = $user;
        $this->display();
    }

    /**
     * Modify password 
     * 
     * @access public
     * @return void
     */
    public function modifyPassword()
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        if(!empty($_POST))
        {
            if($this->post->password != $this->post->password2)
            {
                echo js::alert($this->lang->user->diffPassword);
                die(js::locate(inlink('modifyPassword'), 'parent'));
            }
            $user = $this->dao->select('password')->from(TABLE_USER)->where('id')->eq($this->app->user->id)->fetch(); 
            if($user->password != md5($this->post->oldpassword))
            {
                echo js::alert($this->lang->user->oldPasswordIsWrong);
                die(js::locate(inlink('modifyPassword'), 'parent'));
            }
            $this->dao->update(TABLE_USER)->set('password')->eq(md5($this->post->password))->where('id')->eq($this->app->user->id)->exec();
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate($this->createLink('request', 'browse'), 'parent'));
        }
        $this->display();
    }

    /**
     * Add product service 
     * 
     * @param  int    $userID 
     * @access public
     * @return void
     */
    public function addProductService($userID)
    {
        if($_POST)
        {
            $this->user->saveProductService($userID);
            if(dao::isError())die(js::error(dao::getError()));
            die(js::locate(inlink('manageServiceTime', "userID=$userID"), 'parent'));
        }

        $products = $this->loadModel('product')->getPairs();
        $products = array(0 => '') + $products;
        $serviceTimes = $this->user->getServiceTime($userID);
        if($serviceTimes)
        {
            foreach($serviceTimes as $serviceTime)
            {
                unset($products[$serviceTime->product]);
            }
        }

        $this->view->products = $products; 
        $this->display();
    }

    /**
     * Manage service time 
     * 
     * @param  int    $userID 
     * @access public
     * @return void
     */
    public function manageServiceTime($userID)
    {
        $this->view->user = $this->user->getByID($userID);
        $this->view->serviceProducts = $this->user->getServiceProducts($userID);
        $this->display();
    }

    /**
     * Add service time
     * 
     * @param  int    $date 
     * @param  int    $customerID 
     * @access public
     * @return void
     */
    public function extendServiceTime($date, $userID, $serviceProductID)
    {
        $customer = $this->dao->select('serviceTime')->from(TABLE_SERVICETIME)->where('id')->eq($serviceProductID)->fetch();
        $olddate = strtotime($customer->serviceTime);
        switch($date)
        {
            case "onemonth" :     $intdate = strtotime("+1 month", $olddate);break;
            case "twomonthes" :   $intdate = strtotime("+2 month", $olddate);break;
            case "threemonthes" : $intdate = strtotime("+3 month", $olddate);break;
            case "sixmonthes" :   $intdate = strtotime("+6 month", $olddate);break;
            case "oneyear"  :     $intdate = strtotime("+1 year", $olddate);break;
        }
        $format = 'Y-m-d';

        $date = date($format,$intdate);
        $this->dao->update(TABLE_SERVICETIME)->set("serviceTime")->eq($date)->where('id')->eq($serviceProductID)->exec();
        $this->locate($this->createLink('user', 'manageServiceTime', "userID=$userID"));
    }

    /**
     * Forbid users
     *
     * @param int    $userID
     * @param int    $recTotal
     * @param int    $recPerPage
     * @param int    $pagerID
     * @access public
     * @return void
     */
    public function forbid($userID = 0, $type, $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        $this->user->forbid($userID);
        $this->locate($this->createLink('user', 'browse', "type=$type"));
    }

    /**
     * Allow users
     *
     * @param int    $customerID
     * @param int    $recTotal
     * @param int    $recPerPage
     * @param int    $pagerID
     * @access public
     * @return void
     */
    public function allow($userID = 0, $type, $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        $this->user->allow($userID);
        $this->locate($this->createLink('user', 'browse', "type=$type"));
    }

    /**
     * set the referer 
     * 
     * @param  string $referer 
     * @access private
     * @return void
     */
    private function setReferer($referer = '')
    {
        if(!empty($referer))
        {
            $this->referer = helper::safe64Decode($referer);
        }
        else
        {
            $this->referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        }
    }
    /**
     * get the forgotten password
     *
     * @access public
     * @return void
     */
    public function reset()
    {
        if(!empty($_POST))
        {
            $user = $this->user->checkEmail($this->post->account, $this->post->email);
            if($user)
            {
                $account   = $this->post->account;
                $safeMail  = $user->email;
                $resetKey  = md5(str_shuffle(md5($account . mt_rand(0, 99999999) . microtime())) . microtime());
                $resetURL  = "http://". $_SERVER['HTTP_HOST'] . $this->inlink('check', "key=$resetKey");
                $notice    = $this->lang->user->resetmail->notice;
                $this->user->resetKey($account, $resetKey, helper::now());
                $this->loadModel('mail')->send($account, $this->lang->user->resetmail->subject, str_replace(array("%account%", "%safeMail%", "%resetURL%", "%resetKey%", "%notice%"), array($account, $safeMail, $resetURL, $resetKey, $notice), $this->lang->user->resetmail->content)); 
                if($this->mail->isError()) 
                {
                    echo js::error($this->mail->getError());
                }
                else
                {
                    die(js::confirm($this->lang->user->resetsuccess, inlink('login'),'','parent'));
                }
            }
            else
            {
                echo die(js::error($this->lang->user->resetfailed));
            }
        }
        $this->display();         
    }

    /**
     * check the resetKey and reset password 
     *
     * @access public
     * @return void
     */
    public function check($resetKey)
    {
        if(!empty($_POST))
        {
            $this->user->resetPassword($this->post->resetKey, $this->post->password1); 
            echo js::alert("密码已修改");
            die(js::locate($this->createLink('request', 'browse'), 'parent'));
        }
        if(!$this->user->checkResetKey($resetKey))
        {
            die(js::error("error")); 
        }
        else
        {
            $this->view->resetKey = $resetKey;
            $this->display();
        }
    }

    /**
     * Get user for ajax 
     * 
     * @param  string $requestID 
     * @param  string $assignedTo 
     * @access public
     * @return void
     */
    public function ajaxGetUser($requestID = '', $assignedTo = '')
    {
        $users = $this->user->getPairs('noCustomer, noclosed');
        $html = "<form method='post' target='hiddenwin' class='mb-zero form-horizontal' action='" . $this->createLink('request', 'assignedTo', "requestID=$requestID") . "'>";
        $html .= html::select('assignedTo', $users, $assignedTo, "class='select-2'");
        $html .= html::submitButton();
        $html .= '</form>';
        echo $html;
    }

    /**
     * Api sync user 
     * 
     * @access public
     * @return void
     */
    public function apiSyncUser()
    {
        $return = $this->user->saveUser();
        $this->view->return = $return;
        die($this->display());
    }
}
