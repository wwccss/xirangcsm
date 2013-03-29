<?php
/**
 * The control file of request module of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen<congzhi@cnezsoft.com>
 * @package     request 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class request extends control
{
    public function __construct()
    {
        parent::__construct(); 
        $this->loadModel('user');
        $this->loadModel('action');
        $this->loadModel('faq');
        $this->loadModel('category');
        $this->loadModel('product');
    }

    /**
     * browse 
     * 
     * @param  string $type 
     * @param  string $param 
     * @access public
     * @return void
     */
    public function browse($type = 'assignedToMe', $param = '', $orderBy = 'id_asc', $recTotal = 0, $recPerPage = 20, $pageID = 1, $userID =0)
    {
        if(RUN_MODE == 'front' and $type == 'assignedToMe')  $type = 'all';
        if($userID)
        {
            $this->app->user = $this->user->getByID($userID); 
        }
        $this->session->set('type', $type);
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
        $this->view->dbPager = $pager;
        if(RUN_MODE == 'admin')
        {
            $this->view->requests = $this->request->getRequestesByType($type, $param, $orderBy, $pager);
        }
        else
        {
            $this->view->requests = $this->request->getRequestesByType($type, $param, $orderBy, $pager, $this->app->user->id);
        }
        /* Build the search form. */
        $this->config->request->search['actionURL'] = $this->createLink('request', 'browse', "type=search&queryID=myQueryID&orderBy=$orderBy&recTotal=$recTotal&recPerPage=$recPerPage&pageID=$pageID&userID=$userID");
        $this->config->request->search['queryID']   = (int)$param;
        $this->view->searchForm = $this->fetch('search', 'buildForm', $this->config->request->search);

        $this->view->type       = $type;
        $this->view->param      = $param;
        $this->view->orderBy    = $orderBy;
        $this->view->recTotal   = $pager->recTotal;
        $this->view->recPerPage = $pager->recPerPage;
        $this->view->userID     = $userID;

        $this->display();
    }

    /**
     * view 
     * 
     * @param int $requestID 
     * @param int $editReplyID 
     * @access public
     * @return void
     */
    public function view($requestID, $editReplyID = 0, $viewType = 'view', $faqID = 0, $comment = 0)
    {
        $request = $this->request->getRequestByID($requestID);
        if(RUN_MODE == 'front' and $request->customer != $this->app->user->id)
        {
            die(js::locate(inlink('browse'))); 
        }
        if($request->status == 'wait' and RUN_MODE == 'admin') 
        {
            $this->dao->update(TABLE_REQUEST)->set('status')->eq('viewed')->where('id')->eq($request->id)->exec();
            if(dao::isError()) die(js::error(dao::getError()));
        }
        if($request->status == 'closed')
        {
            if($valuateResult = $this->request->getRatingResult($requestID)) 
            {
                $this->view->rated      = true;
                $this->view->rate       = $valuateResult->comment;
                $this->view->valuation  = $valuateResult->comment;
            }
            else
            {
                $this->view->rated      = false; 
            }
        }
        else
        {
            $this->view->rated      = false; 
        }
        $doubts = $this->request->getDoubts($requestID);
        $this->view->paramString = helper::safe64Encode("editReplyID=$editReplyID&viewType=$viewType&faqID=$faqID&comment=0");
        $this->view->doubts      = $doubts;
        $this->view->request     = $request;
        $this->view->actions     = $this->request->getActions($requestID);
        $this->view->editReplyID = $editReplyID;
        $this->view->viewType    = $viewType;
        $this->view->comment     = $comment;
        $this->view->faqID       = $faqID;

        $this->view->faq = '';
        $faqList = array();
        if($faqID != 0) $this->view->faq = $this->faq->getByID($faqID);
        $faqList      = $this->faq->getListByCategoryID($request->product, $request->category);
        $faqList['0'] = $this->lang->request->pleaseSelect;
        $this->view->faqList = $faqList;
        $this->view->request = $request;
        $this->display();
    }

    /**
     * valuate
     * 
     * @param int $requestID 
     * @access public
     * @return void
     */
    public function valuate($requestID = 0) 
    {
        if(!empty($_POST))
        {
            $requestID = $this->post->requestID;
            if(!$this->post->valuate)
            {
                die(js::confirm($this->lang->request->emptyValuate, inlink('view', "requestID=$requestID"))); 
            }

            $request = $this->request->getRequestByID($requestID);
            if($request->customer != $this->app->user->id)
            {
                die($this->locate(inlink('browse'))); 
            }
            $this->request->valuate($requestID); 
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate(inlink('view', "requestID=$requestID")));
        }
        die(js::locate(inlink('browse')));    
    }

    /**
     * close 
     * 
     * @param  int $requestID 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function close($requestID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            echo js::confirm($this->lang->request->confirmClose, inLink('close', "requestID=$requestID&confirm=yes"));
            die(js::locate($this->inLink('browse', "type={$this->session->type}")));
        }
        else
        {
            $this->request->close($requestID);
            die(js::locate($this->inLink('browse', "type={$this->session->type}")));
        }
    }

    /**
     * reply 
     * 
     * @param  int $requestID 
     * @access public
     * @return void
     */
    public function reply($requestID, $editReplyID)
    {
        if(!empty($_POST))
        {
            if($this->post->reply)
            {
                $actionID = $this->request->reply($requestID);
                $this->sendmail($requestID, $actionID);
                if(dao::isError()) die(js::error(dao::getError()));
                die(js::locate($this->inLink('view', "requestID=$requestID&editReplyID=$editReplyID"), 'parent'));
            }
            else
            {
                die(js::alert($this->lang->request->emptyWarning));
            }
        }
    }

    /**
     * Reply API 
     * 
     * @access public
     * @return void
     */
    public function replyAPI()
    {
        $reply = json_decode(urldecode($_POST['0']));
        $this->loadModel('action')->create('request', $reply->requestID, 'processed', $reply->comment, '', $reply->actor);
        $this->dao->update(TABLE_REQUEST)
            ->set('status')->eq('replied')
            ->set('assignedTo')->eq($reply->actorID)
            ->set('repliedDate')->eq(helper::now())
            ->set('lastEditedDate')->eq(helper::now())
            ->where('id')->eq($reply->requestID)
            ->exec();
    }

    /**
     * Edit reply 
     * 
     * @param  int $requestID 
     * @param  int $replyID 
     * @access public
     * @return void
     */
    public function editReply($requestID, $replyID)
    {
        if(!empty($_POST))
        {
            if($this->post->comment)
            {
                $this->request->updateReply($requestID, $replyID);
                if(dao::isError()) die(js::error(dao::getError()));
                die(js::locate($this->inLink('view', "requestID=$requestID")));
            }
            else 
            {
                echo js::alert($this->lang->request->emptyWarning);
                die(js::reload('parent'));
 
            }
        }
    }

    /**
     * Create a request
     *
     * @param int $productID
     * @access public
     * @return void
     */
    public function create($productID = 0)
    {  
        if($_POST)
        {
            $requestID = $this->request->createRequest();
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate(inlink('browse', 'type=wait&mode=front'), 'parent'));
        }
        if($productID == 0) 
        {
            $this->view->categories = ''; 
        }
        else
        {
            $categories = $this->category->getByProductID($productID);
            $tmpArray = array();
            foreach($categories as $category)
            {
                $tmpArray[$category->id] = $category->name;
            }
            $this->view->categories = $tmpArray;
        }
        $this->loadModel('product');
        $productList = $this->product->getProductService();
        $productList['0'] = $this->lang->product->selectAProduct;
        $this->view->productList = $productList;

        $this->view->productID = $productID;
        $this->display(); 
    }

    /**
     * edit 
     * 
     * @param  int $requestID 
     * @access public
     * @return void
     */
    public function edit($requestID, $productID = 0)
    {
        if(!empty($_POST))
        {
            $requestID = intval($this->post->requestID);
            $request   = $this->request->getRequestByID($requestID);
            if($this->app->user->id != $request->customer)
            {
                die(js::locate($this->createLink('user', 'login')));
            }
            $this->request->editRequest($requestID);
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate(inlink('view', "id=$requestID"), 'parent'));
        }
        $request   = $this->request->getRequestByID($requestID);
        if($this->app->user->id != $request->customer)
        {
            die(js::locate($this->createLink('user', 'login')));
        }
        $products = $this->loadModel('product')->getPairs();
        $request = $this->request->getRequestByID($requestID);
        if($productID == 0)
        {
            $categories = $this->category->getByProductID($request->product);
            $product    = $request->product;
        }
        else
        {
            $categories = $this->category->getByProductID($productID);
            $product    = $productID;
        }
        $arrayCategories =array();
        foreach($categories as $key => $category)
        {
           $arrayCategories[$category->id] = $category->name; 
        }
        $this->view->product    = $product;  
        $this->view->products   = $products;
        $this->view->category   = $request->category;  
        $this->view->categories = $arrayCategories;
        $this->view->requestID  = $request->id;
        $this->view->request    = $request;
        $this->view->title      = $request->title; 
        $this->view->desc       = $request->desc;
        $this->display(); 
    }

    /**
     * doubt a request 
     * 
     * @param  string $requestID 
     * @access public
     * @return void
     */
    public function doubt()
    {
        if(!empty($_POST))
        {
            $requestID = $this->post->requestID;
            if(!$this->post->comment)
            {
                die(js::confirm($this->lang->request->emptyWarning, inlink('view', "requestID=$requestID"))); 
            }
            $actionID = $this->request->doubt($requestID);  
            $this->sendmail($requestID, $actionID);
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate(inlink('view', "requestID=$requestID")));
        }
    }

    /**
     * Update assignedTo of request
     * 
     * @param  int    $requestID 
     * @access public
     * @return void
     */
    public function assignedTo($requestID)
    {
        $oldRequest = $this->request->getById($requestID);
        if($oldRequest->assignedTo != $this->post->assignedTo)
        {
            $this->dao->update(TABLE_REQUEST)->set('assignedTo')->eq($this->post->assignedTo)->where('id')->eq($requestID)->exec();
            $actionID = $this->action->create('request', $requestID, 'assignedTo');
            $this->sendmail($requestID, $actionID);
        }
        die(js::locate($this->server->http_referer, 'parent'));
    }

    /**
     * Transfer a request
     * 
     * @param  int $requestID 
     * @access public
     * @return void
     */
    public function transfer($requestID)
    {
        $this->dao->update(TABLE_REQUEST)->set('status')->eq('transfered')->set('lastEditedDate')->eq(helper::now())->where('id')->eq($requestID)->exec();
        $this->action->create('request', $requestID, 'transfered');
        if(dao::isError()) die(js::error(dao::getError()));
        echo js::alert($this->lang->request->transferSuccess);
        die(js::locate(inLink('browse', "type={$this->session->type}")));
    }

    /**
     * Comment a servicer's reply 
     * 
     * @param  int $requestID 
     * @param  string $paramString 
     * @access public
     * @return void
     */
    public function comment($requestID, $paramString)
    {
        $paramString = helper::safe64Decode($paramString);
        $paramString = "requestID=$requestID&$paramString";
        $this->action->create('request', $requestID, 'commented', $this->post->comment);
        if(dao::isError()) die(js::error(dao::getError()));
        die(js::locate(inlink('view', $paramString), 'parent'));
    }
    
    /**
     * Change status of request
     * 
     * @param  int    $requestID 
     * @param  string $status 
     * @access public
     * @return void | bool
     */
    public function changeStatus($requestID, $status)
    {
        $this->request->changeStatus($requestID, $status); 
        $this->view->result = $return;
        $this->display();
    }

    /**
     * Send email.
     *
     * @param  int    $requestID
     * @param  int    $actionID
     * @access public
     * @return void
     */
    public function sendmail($requestID, $actionID)
    {
        /* Set toList and ccList. */
        $request     = $this->request->getById($requestID);
        $productName = $this->product->getById($request->product)->name;
        $users       = $this->loadModel('user')->getPairs('noletter');
        $toList      = $request->assignedTo;

        /* Get action info. */
        $action = $this->loadModel('action')->getById($actionID);

        /* Create the email content. */
        $this->view->request = $request;
        $this->view->action  = $action;
        $this->view->users   = $users;
        $this->clear();
        $mailContent = $this->parse($this->moduleName, 'sendmail');

        /* Send emails. */
        $this->loadModel('mail')->send($toList, $productName . ':' . 'REQUEST#' . $request->id . $this->lang->colon . $request->title, $mailContent);
        if($this->mail->isError()) echo js::error($this->mail->getError());
    }

}
