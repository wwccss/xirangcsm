<?php
/**
 * The model file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     company
 * @version     $Id: model.php 4488 2013-02-27 02:54:49Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class companyModel extends model
{

    /**
     * Get the first company.
     * 
     * @access public
     * @return void
     */
    public function getFirst()
    {
        return $this->dao->select('*')->from(TABLE_COMPANY)->orderBy('id')->limit(1)->fetch();
    }

    /**
     * Update a company.
     * 
     * @access public
     * @return void
     */
    public function update()
    {
        $company   = fixer::input('post')->stripTags('name')->get();        
        $this->dao->update(TABLE_COMPANY)
            ->data($company)
            ->autoCheck()
            ->batchCheck($this->config->company->edit->requiredFields, 'notempty')
            ->exec();
    }
}
