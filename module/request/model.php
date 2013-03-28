<?php
/**
 * The model file of request module of zentaoASM
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi <congzhi@cnezsoft.com>
 * @package     request 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
class requestModel extends model
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('action');
    }

    public function getById($requestID)
    {
        return $this->dao->select('*')->from(TABLE_REQUEST)->where('id')->eq($requestID)->fetch();
    }


    /**
     * getRequestesByType 
     * 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function getRequestesByType($type, $param, $orderBy = 'id', $pager = null, $user = 'all')
    {
        $requests = array();
        if($type == 'assignedToMe')
        {
            $requests = $this->dao->select('*')->from(TABLE_REQUEST)->where('assignedTo')->eq($this->app->user->id)->orderBy($orderBy)->page($pager)->fetchAll();
        }
        elseif($type == 'repliedByMe')
        {
            $ids = array();
            $accountID = $this->dao->select('*')->from(TABLE_USER)->where('account')->eq($this->app->user->account)->fetch()->id;
            $action    = $this->dao->select('objectID')->from(TABLE_ACTION)
                ->where('actor')->eq($this->app->user->account)
                ->andWhere('objectType')->eq('request')
                ->andWhere('action')->eq('replied')
                ->orWhere('action')->eq('processed')
                ->fetchAll('objectID');
            foreach($action as $key => $value)
            {
                $ids[$key] = $value->objectID;
            }
            $requests  = $this->dao->select('*')->from(TABLE_REQUEST)->where('id')->in($ids)->orderBy($orderBy)->page($pager)->fetchAll();
        }
        elseif($type == 'unReplied')
        {
            $requests = $this->dao->select('*')->from(TABLE_REQUEST)
                ->where('status')->in('wait,viewed')
                ->beginIF($user != 'all')->andWhere('customer')->eq($this->app->user->id)->fi()
                ->orderBy($orderBy)
                ->page($pager)->fetchAll();
        }
        elseif($type == 'allowedClosed')
        {
            $repliedDates = $this->dao->select('id, repliedDate')->from(TABLE_REQUEST)
                ->where('status')->ne('closed')
                ->beginIF($user != 'all')->andWhere('customer')->eq($this->app->user->id)->fi()
                ->fetchAll();
            $allowedClosedRequests = array();
            foreach($repliedDates as $id => $repliedDate)
            {
                if(strtotime($repliedDate->repliedDate) < strtotime("-2 week") && strtotime($repliedDate->repliedDate) != 0) $allowedClosedRequests[] = $repliedDate->id;
            }
            $requests = $this->dao->select('*')->from(TABLE_REQUEST)->where('id')->in($allowedClosedRequests)
                ->beginIF($user != 'all')->andWhere('customer')->eq($this->app->user->id)->fi()
                ->orderBy($orderBy)
                ->page($pager)->fetchAll();
            foreach($requests as $request) $request->isAllowedClosed = 1;
        }
        elseif($type == 'search')
        {
            $queryID = (int)$param;
            if($queryID)
            {
                $query = $this->loadModel('search')->getQuery($queryID);
                if($query)
                {
                    $this->session->set('requestQuery', $query->sql);
                    $this->session->set('requestForm', $query->form);
                }
                else
                {
                    $this->session->set('requestQuery', ' 1 = 1');
                }
            }
            else
            {
                if($this->session->requestQuery == false) $this->session->set('requestQuery', ' 1 = 1');
            }
            $requestQuery = $this->session->requestQuery;
            $requests = $this->dao->select('*')->from(TABLE_REQUEST)
                ->where($requestQuery)
                ->beginIF($user != 'all')->andWhere('customer')->eq($this->app->user->id)->fi()
                ->orderBy($orderBy)
                ->page($pager)->fetchAll();
        }
        else
        {
            $requests = $this->dao->select('*')->from(TABLE_REQUEST)
                ->where('1')->eq('1')
                ->beginIF($type != 'all')->andWhere('status')->eq($type)->fi()
                ->beginIF($user != 'all')->andWhere('customer')->eq($this->session->user->id)->fi()
                ->orderBy($orderBy)
                ->page($pager)->fetchAll();
        }

        if($requests)
        {
            foreach($requests as $requestID => $request)
            {
                $categorys[]   = $request->category;
                $customers[]   = $request->customer;
                $assignedTos[] = $request->assignedTo;
                $products[]    = $request->product;
            }
            $categorys   = $this->dao->select('*')->from(TABLE_CATEGORY)->where('id')->in($categorys)->fetchAll('id');
            $customers   = $this->dao->select('*')->from(TABLE_USER)->where('id')->in($customers)->fetchAll('id');
            $assignedTos = $this->dao->select('*')->from(TABLE_USER)->where('id')->in($assignedTos)->fetchAll('id');
            $products    = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->in($products)->fetchAll('id');

            foreach($requests as $requestID => $request)
            {
                if($type != 'allowedClosed')
                {
                    if(strtotime($request->repliedDate) < strtotime("-2 week") && strtotime($request->repliedDate) != 0)
                        $request->isAllowedClosed = 1;
                    else 
                        $request->isAllowedClosed = 0;

                    if($request->status == 'storied' || $request->status == 'buged')
                        $request->isAllowedClosed = 1;
                }

                $request->assignedToID = $request->assignedTo;
                $request->category     = isset($categorys[$request->category])     ? $categorys[$request->category]->name : '';
                $request->customer     = isset($customers[$request->customer])     ? $customers[$request->customer]->realname : '';
                $request->assignedTo   = isset($assignedTos[$request->assignedTo]) ? $assignedTos[$request->assignedTo]->realname : '';
                $request->productName  = isset($products[$request->product])       ? $products[$request->product]->name : '';
            }
        }
        return $requests;
    }

    /**
     * getActions 
     * 
     * @param  string $requestID 
     * @access public
     * @return void
     */
    public function getActions($requestID)
    {
        return $this->dao->select('t1.*, t2.realname, t2.id as number')
            ->from(TABLE_ACTION)->alias('t1')
            ->leftJoin(TABLE_USER)->alias('t2')
            ->on('t1.actor = t2.account')
            ->where('t1.objectType')->eq('request')
            ->andWhere('t1.objectID')->eq($requestID)
            ->andWhere('t1.action')->in('created, replied, doubted, commented, processed, transfered, valuated')
            ->orderBy('t1.date')
            ->fetchAll();
    }

    /**
     * getRequestByID 
     * 
     * @param  string $requestID 
     * @access public
     * @return void
     */
    public function getRequestByID($requestID)
    {
        $this->loadModel('user');
        $this->loadModel('category');
        $this->loadModel('product');
        $request = $this->dao->select('*')->from(TABLE_REQUEST)->where('id')->eq($requestID)->fetch();

        $customerAccount   = $this->user->getByID($request->customer);
        $assignedToAccount = $this->user->getByID($request->assignedTo);
        $product           = $this->product->getByID($request->product);
        $category          = $this->category->getByID($request->category);

        $request->customerAccount   = $customerAccount   ? $customerAccount->realname : '';
        $request->assignedToAccount = $assignedToAccount ? $assignedToAccount->realname : '';
        $request->productName       = $product           ? $product->name : '';
        $request->categoryName      = $category          ? $category->name : '';
        $request->files             = $this->loadModel('file')->getByObject('request', $requestID);

        return $request;
    }


    /**
     * Update a reply 
     * 
     * @param  string $requestID 
     * @param  string $replyID 
     * @access public
     * @return void
     */
    public function updateReply($requestID, $replyID)
    {
        $this->dao->update(TABLE_REQUEST)->set('repliedDate')->eq(helper::now())->set('lastEditedDate')->eq(helper::now())->where('id')->eq($requestID)->exec();
        $this->action->create('reply', $requestID, 'edited', $this->post->comment);
    }

    /**
     * close 
     * 
     * @param  string $requestID 
     * @access public
     * @return void
     */
    public function close($requestID)
    {
        $this->dao->update(TABLE_REQUEST)
            ->set('status')->eq('closed')
            ->set('closedDate')->eq(helper::now())
            ->set('closedBy')->eq($this->app->user->account)
            ->where('id')->eq($requestID)
            ->exec();
    }

     /**
     * Create a request.
     * 
     * @access public
     * @return void
     */
    public function createRequest()
    {
        if($this->post->product == '0')
        {
            die(js::error($this->app->loadLang('product')->product->selectAProduct));  
        }
        $request = fixer::input('post')
            ->specialChars('title')
            ->add('customer', $this->app->user->id)
            ->add('addedDate', helper::now())
            ->add('status', 'wait')
            ->remove('files, labels')
            ->get();
        $this->dao->insert(TABLE_REQUEST)->data($request, false)
            ->autoCheck()
            ->batchCheck('title,desc,category', 'notempty')
            ->exec();
        if(!dao::isError())
        {
            $requestID = $this->dao->lastInsertID();
            $this->loadModel('file')->saveUpload('request', $requestID);
        }
        $this->loadModel('action')->create('request', $requestID, 'created', '');

        return $requestID;
    }

    /**
     * reply 
     * 
     * @param  string $requestID 
     * @access public
     * @return void
     */
    public function reply($requestID)
    {
        $actionID = $this->loadModel('action')->create('request', $requestID, 'replied', $this->post->reply);

        $this->dao->update(TABLE_REQUEST)
            ->set('status')->eq('replied')
            ->set('assignedTo = customer')
            ->set('repliedBy')->eq($this->app->user->id)
            ->set('repliedDate')->eq(helper::now())
            ->set('lastEditedDate')->eq(helper::now())
            ->where('id')->eq($requestID)
            ->exec();
        return $actionID;
    }

    /**
     * Edit a request 
     * 
     * @param  int $requestID 
     * @access public
     * @return void
     */
    public function editRequest($requestID)
    {
        $this->dao->update(TABLE_REQUEST)
            ->set('title')->eq($this->post->title)
            ->set('`desc`')->eq($this->post->desc)
            ->set('category')->eq(intval($this->post->category))
            ->set('lastEditedDate')->eq(helper::now())
            ->where('id')->eq($requestID)
            ->exec();
        if(!dao::isError())
        {
            $this->loadModel('file')->saveUpload('request', $requestID);
        }
    }

    /**
     * valuate 
     * 
     * @param  string $faqID 
     * @access public
     * @return int actionID 
     */
    public function valuate($requestID)
    {
        if($this->post->comment)
        {
            $comment = $this->lang->request->valuateContent . $this->post->comment;
        }
        else
        {
            $comment = ''; 
        }
        $this->action->create('request', $requestID, 'valuated', $comment, $this->post->valuate);

        $actionID = $this->dao->lastInsertID();
        $this->dao->update(TABLE_REQUEST)
            ->set('status')->eq('closed')
            ->set('closedDate')->eq(helper::now())
            ->set('closedBy')->eq($this->app->user->id)
            ->where('id')->eq($requestID)
            ->limit(1)
            ->exec();
        return $actionID;

    }

    /**
     * Get valuate result 
     * 
     * @param  string $requestID 
     * @access public
     * @return object $valuateResult
     */
    public function getRatingResult($requestID) 
    {
        $valuate = $this->dao->select('*')->from(TABLE_ACTION)
            ->where('action')->eq('valuated')
            ->andWhere('objectType')->eq('request')
            ->andWhere('objectID')->eq($requestID)
            ->fetch();
        return $valuate;
    }

    /**
     * Get doubts 
     * 
     * @param  string $requestID 
     * @access public
     * @return object $doubts
     */
    public function getDoubts($requestID) 
    {
        $doubts = $this->dao->select('*')->from(TABLE_ACTION)
            ->where('action')->eq('doubted')
            ->andWhere('objectType')->eq('request')
            ->andWhere('objectID')->eq($requestID)
            ->fetchAll();
        return $doubts;
    }

    /**
     * doubt a requeat 
     * 
     * @param  int $requestID 
     * @access public
     * @return int $doubtID 
     */
    public function doubt($requestID)
    {
        $actionID = $this->action->create('request', $requestID, 'doubted', $this->post->comment);

         $this->dao->update(TABLE_REQUEST)->set('status')->eq('doubted')->set('assignedTo = repliedBy')
             ->where('id')->eq($requestID)
             ->exec();
        return $actionID;
    }


    /**
     * Change status of request  
     * 
     * @param  int    $requestID 
     * @param  string $status 
     * @access public
     * @return bool
     */
    public function changeStatus($requestID, $status)
    {
        return $this->dao->update(TABLE_REQUEST)
                   ->set('status')->eq($status)
                   ->where('id')->eq($requestID)->exec(); 
    }
}
