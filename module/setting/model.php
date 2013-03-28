<?php
/**
 * The model file of setting module of ZenTaoASM.
 *
 * @copyright   Copyright 2009-2011 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     setting
 * @version     $Id: model.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class settingModel extends model
{
    /**
     * Get the version of current zentaoASM.
     * 
     * Since the version field not saved in db. So if empty, return 0.3 beta.
     * @access public
     * @return void
     */
    public function getVersion()
    {
        $version = $this->getItem('system', 'global', 'version');
        if($version) return $version;
        return '0.3 beta';
    }

    /**
     * Get value of an item.
     * 
     * @param  string    $owner 
     * @param  string    $section 
     * @param  string    $key 
     * @access public
     * @return misc
     */
    public function getItem($owner, $section, $key)
    {
        return $this->dao->select('`value`')->from(TABLE_CONFIG)
            ->where('company')->eq(0)
            ->andWhere('owner')->eq($owner)
            ->andWhere('section')->eq($section)
            ->andWhere('`key`')->eq($key)
            ->fetch('value', $autoCompany = false);
    }

    /**
     * Compute a SN. Use the server ip, and server software string as seed, and an rand number, two micro time
     * 
     * Note: this sn just to unique this zentaoASM. No any private info. 
     *
     * @access public
     * @return string
     */
    public function computeSN()
    {
        $seed = $this->server->SERVER_ADDR . $this->server->SERVER_SOFTWARE;
        $sn   = md5(str_shuffle(md5($seed . mt_rand(0, 99999999) . microtime())) . microtime());
        return $sn;
    }

    /**
     * Set the sn of current zentaoASM.
     * 
     * @access public
     * @return void
     */
    public function setSN()
    {
        $item = new stdclass();
        $item->company = 0;
        $item->owner   = 'system';
        $item->section = 'global';
        $item->key     = 'sn';
        $item->value   =  $this->computeSN();

        $config = $this->dao->select('id, value')->from(TABLE_CONFIG)
            ->where('company')->eq(0)
            ->andWhere('owner')->eq('system')
            ->andWhere('section')->eq('global')
            ->andWhere('`key`')->eq('sn')
            ->fetch('', $autoComapny = false);
        if(!$config)
        {
            $this->dao->insert(TABLE_CONFIG)->data($item)->exec($autoCompany = false);
        }
        elseif($config->value == '281602d8ff5ee7533eeafd26eda4e776' or $config->value == '9bed3108092c94a0db2b934a46268b4a')
        {
            $this->dao->update(TABLE_CONFIG)->data($item)->where('id')->eq($config->id)->exec($autoCompany = false);
        }
    }

    /**
     * Update version 
     * 
     * @param  string    $version 
     * @access public
     * @return void
     */
    public function updateVersion($version)
    {
        $item = new stdclass();
        $item->company = 0;
        $item->owner   = 'system';
        $item->section = 'global';
        $item->key     = 'version';
        $item->value   =  $version;

        $configID = $this->dao->select('id')->from(TABLE_CONFIG)
            ->where('company')->eq(0)
            ->andWhere('owner')->eq('system')
            ->andWhere('section')->eq('global')
            ->andWhere('`key`')->eq('version')
            ->fetch('id', $autoComapny = false);
        if($configID > 0)
        {
            $this->dao->update(TABLE_CONFIG)->data($item)->where('id')->eq($configID)->exec($autoCompany = false);
        }
        else
        {
            $this->dao->insert(TABLE_CONFIG)->data($item)->exec($autoCompany = false);
        }
    }

    /**
     * Get config 
     * 
     * @access public
     * @return array
     */
    public function getConfig()
    {
        return $this->dao->select('*')->from(TABLE_CONFIG)->fetch();
    }

    /**
     * save config 
     * 
     * @access public
     * @return void
     */
    public function saveConfig()
    {
        $config = fixer::input('post')
            ->setIF($this->post->noIP == 'on', "ip", '')
            ->remove('noIP')
            ->get();
        $this->dao->update(TABLE_CONFIG)->data($config)->exec();
    }
}