<?php
/**
 * The model file of upgrade module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $Id: model.php 4609 2013-03-18 01:29:18Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class upgradeModel extends model
{
    static $errors = array();

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('setting');
    }

    /**
     * The execute method. According to the $fromVersion call related methods.
     * 
     * @param  string $fromVersion 
     * @access public
     * @return void
     */
    public function execute($fromVersion)
    {
        switch($fromVersion)
        {
            case '1_1':
                $this->execSQL($this->getUpgradeFile('1.1'));
                $this->changeConfigTable();

            default: if(!$this->isError()) $this->setting->updateVersion($this->config->version);
        }
    }

    /**
     * Create the confirm contents.
     * 
     * @param  string $fromVersion 
     * @access public
     * @return string
     */
    public function getConfirm($fromVersion)
    {
        $confirmContent = '';
        switch($fromVersion)
        {
            case '1_1': $confirmContent .= file_get_contents($this->getUpgradeFile('1.1'));
        }
        return str_replace('zt_', $this->config->db->prefix, $confirmContent);
    }

    /**
     * Get the upgrade sql file.
     * 
     * @param  string $version 
     * @access public
     * @return string
     */
    public function getUpgradeFile($version)
    {
        return $this->app->getAppRoot() . 'db' . $this->app->getPathFix() . 'update' . $version . '.sql';
    }

    /**
     * Execute a sql.
     * 
     * @param  string  $sqlFile 
     * @access public
     * @return void
     */
    public function execSQL($sqlFile)
    {
        $mysqlVersion = $this->loadModel('install')->getMysqlVersion();

        /* Read the sql file to lines, remove the comment lines, then join theme by ';'. */
        $sqls = explode("\n", file_get_contents($sqlFile));
        foreach($sqls as $key => $line) 
        {
            $line       = trim($line);
            $sqls[$key] = $line;
            if(strpos($line, '--') !== false or empty($line)) unset($sqls[$key]);
        }
        $sqls = explode(';', join("\n", $sqls));

        foreach($sqls as $sql)
        {
            $sql = trim($sql);
            if(empty($sql)) continue;

            if($mysqlVersion <= 4.1)
            {
                $sql = str_replace('DEFAULT CHARSET=utf8', '', $sql);
                $sql = str_replace('CHARACTER SET utf8 COLLATE utf8_general_ci', '', $sql);
            }

            $sql = str_replace('zt_', $this->config->db->prefix, $sql);
            try
            {
                $this->dbh->exec($sql);
            }
            catch (PDOException $e) 
            {
                self::$errors[] = $e->getMessage() . "<p>The sql is: $sql</p>";
            }
        }
    }

    /**
     * Judge any error occers.
     * 
     * @access public
     * @return bool
     */
    public function isError()
    {
        return !empty(self::$errors);
    }

    /**
     * Get errors during the upgrading.
     * 
     * @access public
     * @return array
     */
    public function getError()
    {
        $errors = self::$errors;
        self::$errors = array();
        return $errors;
    }

    public function changeConfigTable()
    {
        $config = $this->dao->select('*')->from(TABLE_CONFIG)->fetch();

        $sql  = "DROP TABLE `zt_config`";
        $sql = str_replace('zt_', $this->config->db->prefix, $sql);
        $this->dbh->exec($sql);
        $sql = "CREATE TABLE IF NOT EXISTS `zt_config` (
            `id` mediumint(8) unsigned NOT NULL auto_increment,
            `owner` char(30) NOT NULL default '',
            `module` varchar(30) NOT NULL,
            `section` char(30) NOT NULL default '',
            `key` char(30) NOT NULL default '',
            `value` text NOT NULL,
            PRIMARY KEY  (`id`),
            UNIQUE KEY `unique` (`owner`,`module`,`section`,`key`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
        $sql = str_replace('zt_', $this->config->db->prefix, $sql);
        $this->dbh->exec($sql);

        $this->setting->setItem('system.api.openSync', $config->openSync);
        $this->setting->setItem('system.api.key', $config->key);
        $this->setting->setItem('system.api.ip', $config->ip);
    }
}
