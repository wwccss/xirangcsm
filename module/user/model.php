<?php
/**
 * The model file of user module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
class userModel extends model
{
    /**
     * Get customers 
     * 
     * @param  object    $pager 
     * @access public
     * @return void
     */
    public function getCustomers($pager)
    {
        return $this->dao->select('*')->from(TABLE_USER)->where('role')->eq('customer')->orderBy('forbid asc')->page($pager)->fetchAll();
    }

    /**
     * Get inside account 
     * 
     * @param  object    $pager 
     * @access public
     * @return void
     */
    public function getInsideAccount($pager)
    {
        return $this->dao->select('*')->from(TABLE_USER)->where('role')->ne('customer')->orderBy('forbid asc')->page($pager)->fetchAll();
    }

    /**
     * Get user by ID 
     * 
     * @param  int    $userID 
     * @access public
     * @return void
     */
    public function getByID($userID)
    {
        return $this->dao->select('*')->from(TABLE_USER)->where('id')->eq($userID)->fetch();
    }

    /**
     * Get the account=>relaname pairs.
     *
     * @param  string $params   noletter|noempty|noclosed|nodeleted|withguest, can be sets of theme
     * @access public
     * @return array
     */
    public function getPairs($params = '')
    {
        $users = $this->dao->select('id, realname')->from(TABLE_USER)
            ->where('deleted')->eq(0)
            ->beginIF(strpos($params, 'customer') !== false)->andWhere('role')->eq('customer')->fi()
            ->beginIF(strpos($params, 'noCustomer') !== false)->andWhere('role')->ne('customer')->fi()
            ->orderBy('id')->fetchPairs();
        if(strpos($params, 'noempty')   === false) $users = array('' => '') + $users;
        if(strpos($params, 'noclosed')  === false) $users = $users + array('closed' => 'Closed');
        if(strpos($params, 'withguest') !== false) $users = $users + array('guest' => 'Guest');
        return $users;
    }

    /**
     * Get service products information of user.
     * 
     * @param  int    $userID 
     * @access public
     * @return void
     */
    public function getServiceProducts($userID)
    {
        return $this->dao->select('t1.id, t2.name, t1.serviceTime')
            ->from(TABLE_SERVICETIME)->alias('t1')
            ->leftJoin(TABLE_PRODUCT)->alias('t2')->on('t1.product = t2.id')
            ->where('user')->eq($userID)->fetchAll();
    }
    
    /**
     * Get service time 
     * 
     * @param  int    $userID 
     * @access public
     * @return void
     */
    public function getServiceTime($userID)
    {
        return $this->dao->select('product')->from(TABLE_SERVICETIME)->where('user')->eq($userID)->fetchAll();
    }

    /**
     * Create a user.
     * 
     * @access public
     * @return void
     */
    public function create($type)
    {
        if(!$this->checkPassword()) return;

        $user = fixer::input('post')
            ->setDefault('visits', 0)
            ->setDefault('birthday', '0000-00-00')
            ->setIF($this->post->password1 != false, 'password', md5($this->post->password1))
            ->setIF($this->post->password1 == false, 'password', '')
            ->setIF($type == 'customer', 'role', 'customer')
            ->remove('password1, password2')
            ->get();

        $this->dao->insert(TABLE_USER)->data($user)
            ->autoCheck()
            ->batchCheck($this->config->user->create->requiredFields, 'notempty')
            ->check('account', 'unique', '1=1', false)
            ->check('account', 'account')
            ->checkIF($this->post->email != false, 'email', 'email')
            ->exec();
    }

    /**
     * Update an account.
     * 
     * @param mixed $account 
     * @access public
     * @return void
     */
    public function update($userID)
    {
        $user = fixer::input('post')
            ->setIF($this->post->password1 != false, 'password', md5($this->post->password1))
            ->cleanInt('mobile,qq,zipcode')
            ->specialChars('account,company,address,phone,birthday')
            ->remove('password1, password2')
            ->get();

        $this->dao->update(TABLE_USER)->data($user)
            ->autoCheck()
            ->batchCheck($this->config->user->edit->requiredFields, 'notempty')
            ->check('account', 'unique', "id != $userID", false)
            ->check('account', 'account')
            ->checkIF($this->post->email != false, 'email', 'email')
            ->checkIF($this->post->msn != false, 'msn', 'email')
            ->checkIF($this->post->gtalk != false, 'gtalk', 'email')
            ->where('id')->eq($userID)
            ->exec();
    }

    /**
     * Check the password is valid or not.
     * 
     * @access public
     * @return bool
     */
    public function checkPassword()
    {
        if($this->post->password1 != false)
        {
            if($this->post->password1 != $this->post->password2) dao::$errors['password'][] = $this->lang->error->passwordsame;
            if(!validater::checkReg($this->post->password1, '|(.){6,}|')) dao::$errors['password'][] = $this->lang->error->passwordrule;
        }
        return !dao::isError();
    }
    
    /**
     * Identify a user.
     * 
     * @param   string $account     the account
     * @param   string $password    the password
     * @access  public
     * @return  object              if is valid user, return the user object.
     */
    public function identify($account, $password)
    {
        if(!$account or !$password) return false;

        /* Try account first. */
        $user = $this->dao->select('*')->from(TABLE_USER)
            ->where('account')->eq($account)
            ->andWhere('password')->eq(md5($password))
            ->fetch();

        /* Then try email. */
        if(!$user)
        {
            /* If there are two users using the same email, can't use email to identify. */
            $count = $this->dao->select("count(*) AS count")->from(TABLE_USER)->where('email')->eq($account)->fetch('count', false);
            if($count == 1)
            {
                $user = $this->dao->select('*')->from(TABLE_USER)
                    ->where('email')->eq($account)
                    ->andWhere('password')->eq(md5($password))
                    ->fetch('', false);
            }
        }

        if($user)
        {
            if($user->forbid)
            {
                die(js::alert($this->lang->user->alert));
            }

            $ip   = $_SERVER['REMOTE_ADDR'];
            $last = helper::now();
            $this->dao->update(TABLE_USER)->set('visits = visits + 1')->set('ip')->eq($ip)->set('last')->eq($last)->where('account')->eq($account)->exec(false);

            /* Judge is admin or not. */
            $user->isAdmin = false;
            if($user->role == 'admin') $user->isAdmin = true;

            $user->rights = array();
            $rights       = $this->dao->select('t2.module, t2.method')->from(TABLE_GROUP)->alias('t1')
                ->leftJoin(TABLE_GROUPPRIV)->alias('t2')->on('t1.id=t2.group')
                ->where('t1.name')->eq($user->role)
                ->fetchAll();

            foreach($rights as $right) $user->rights[strtolower($right->module)][strtolower($right->method)] = true;
        }
        return $user;
    }

    /**
     * Identify email to regain the forgotten password 
     *
     * @access  public
     * @param   string account
     * @param   string email
     * @return  object              if is valid user, return the user object.
     */
    public function checkEmail($account, $email)
    {
        if(!$account or !$email) return false;

        if(RUN_MODE == 'admin' and strpos($this->config->admin->users, ",$account,") === false) return false;

        $user = $this->dao->select('*')->from(TABLE_USER)
            ->where('account')->eq($account)
            ->andWhere('email')->eq($email)
            ->fetch();
        return $user;
    } 

    /**
     * Authorize a user.
     * 
     * @param   string $account   the account
     * @access  public
     * @return  array             the priviledges.
     */
    public function authorize($account)
    {
        $account = filter_var($account, FILTER_SANITIZE_STRING);
        if(!$account) return false;

        $rights = array();
        if($account == 'guest')
        {
            $sql = $this->dao->select('module, method')->from(TABLE_GROUP)->alias('t1')->leftJoin(TABLE_GROUPPRIV)->alias('t2')
                ->on('t1.id = t2.group')->where('t1.name')->eq('guest');
        }
        else
        {
            $sql = $this->dao->select('module, method')->from(TABLE_USERGROUP)->alias('t1')->leftJoin(TABLE_GROUPPRIV)->alias('t2')
                ->on('t1.group = t2.group')
                ->where('t1.account')->eq($account);
        }
        $stmt = $sql->query();
        if(!$stmt) return $rights;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $rights[strtolower($row['module'])][strtolower($row['method'])] = true;
        }
        return $rights;
    }

    /**
     * Juage a user is logon or not.
     * 
     * @access public
     * @return bool
     */
    public function isLogon()
    {
        return (isset($_SESSION['user']) and !empty($_SESSION['user']) and $_SESSION['user']->account != 'guest');
    }

    /**
     * Get users List 
     *
     * @param object  $pager
     * @param string  $userName
     * @access public
     * @return object 
     */
    public function getUsers($pager, $userName = '')
    {
        return $this->dao->select('*')->from(TABLE_USER)
            ->onCaseOf($userName != '')->where('account')->like("%$userName%")->endCase()
            ->orderBy('id_asc')->page($pager)->fetchAll();
    }

    /**
     * Forbid the user
     *
     * @param int $customerID
     * @access public
     * @return void
     */
    public function forbid($customerID)
    {
        $this->dao->update(TABLE_USER)->set('forbid')->eq(1)->where('id')->eq($customerID)->exec();
    }

    /**
     * Allow the user
     *
     * @param int $customerID
     * @access public
     * @return void
     */
    public function allow($customerID)
    {
        $this->dao->update(TABLE_USER)->set('forbid')->eq(0)->where('id')->eq($customerID)->exec();
    }
    /**
     * Get user list with email and real name.
     * 
     * @param  string|array $users 
     * @access public
     * @return array
     */
    public function getRealNameAndEmails($users)
    {
        $users = $this->dao->select('id, account, email, realname')->from(TABLE_USER)->where('id')->in($users)->fetchAll('id');
        if(!$users) return array();
        foreach($users as $id => $user) if($user->realname == '') $user->realname = $user->account;
        return $users;
    }

    /**
     * update the resetKey.
     * 
     * @param  string   $resetKey 
     * @param  time     $resetedTime 
     * @access public
     * @return void
     */
    public function resetKey($account, $resetKey, $time)
    {
        $this->dao->update(TABLE_USER)->set('resetKey')->eq($resetKey)->set('resetedTime')->eq($time)->where('account')->eq($account)->exec();
    }

    /**
     * Check the resetKey.
     * 
     * @param  string   $resetKey 
     * @param  time     $resetedTime 
     * @access public
     * @return void
     */
    public function checkResetKey($resetKey)
    {
        $user = $this->dao->select('*')->from(TABLE_USER)
            ->where('resetKey')->eq($resetKey)
            ->fetch();
        return $user;
    }

    /**
     * Reset the forgotten password.
     * 
     * @param  string   $resetKey 
     * @param  time     $resetedTime 
     * @access public
     * @return void
     */
    public function resetPassword($resetKey, $password)
    {
        $this->dao->update(TABLE_USER)->set('password')->eq(md5($password))->set('resetKey')->eq('')->set('resetedTime')->eq('')->where('resetKey')->eq($resetKey)->exec();
    }

    /**
     * Save product service 
     * 
     * @param  int    $userID 
     * @access public
     * @return void
     */
    public function saveProductService($userID)
    {
        $data = fixer::input('post')
            ->add('user', $userID)
            ->get();

        $this->dao->insert(TABLE_SERVICETIME)->data($data)
            ->autoCheck()
            ->batchCheck($this->config->user->addproductservice->requiredFields, 'notempty')
            ->exec();
    }

    /**
     * Save user 
     * 
     * @access public
     * @return object
     */
    public function saveUser()
    {
        $users = json_decode(urldecode($_POST[0]));
        $insertError      = '';
        $return->result   = 'success';
        if(empty($users))
        {
            $return->result = 'fail';
            $return->error  = $this->lang->user->sync->noPostData;
            return $return;
        }

        $allUsers = $this->dao->select('id,account,zentaoID')->from(TABLE_USER)->where('deleted')->eq(0)->fetchAll();
        foreach($users as $user)
        {
            if($user->id < 100000 and isset($allUsers[$user->account]) and $allUsers[$user->account]->zentaoID >= 100000) continue;
            if($user->id >= 100000 and isset($allUsers[$user->account]) and $allUsers[$user->account]->zentaoID != $user->id) continue;
            $userData = new stdclass();
            if($user->id < 100000) $userData->id = $user->id;
            $userData->dept     = $user->dept;
            $userData->role     = $user->role;
            $userData->account  = $user->account;
            $userData->password = $user->password;
            $userData->realname = $user->realname;
            $userData->avatar   = $user->avatar;
            $userData->birthday = $user->birthday;
            $userData->gender   = $user->gender;
            $userData->company  = $user->company;
            $userData->email    = $user->email;
            $userData->qq       = $user->qq;
            $userData->yahoo    = $user->yahoo;
            $userData->gtalk    = $user->gtalk;
            $userData->wangwang = $user->wangwang;
            $userData->mobile   = $user->mobile;
            $userData->phone    = $user->phone;
            $userData->address  = $user->address;
            $userData->zipcode  = $user->zipcode;
            $userData->join     = $user->join;
            $userData->zentaoID = $user->id;

            $this->dao->replace(TABLE_USER)->data($userData)->exec();
            if(dao::isError()) $insertError .= dao::getError();
            $zentaoasmUser = $this->getByID($user->id);
            if(empty($zentaoasmUser)) $return->unSyncID[] = $user->id;
        }

        if($insertError)
        {
            $return->result = 'fail';
            $return->error  = $insertError;
        }
        return $return;
    }
}
