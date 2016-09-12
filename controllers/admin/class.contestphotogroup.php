<?php

Class Controller_Admin_ContestPhotoGroup Extends Controller_Admin_Base
{
	public $recordPerPage = 20;
	
	public function indexAction()
	{
		$error 			= array();
		$success 		= array();
		$warning 		= array();

        $group = Core_ContestPhotoGroup::getList();
        $data = Helper::displayPhotoGroup($group);
		$this->registry->smarty->assign(array(	'data'	 	=> $data,
												'success'		=> $success,
												'error'			=> $error,
												'warning'		=> $warning,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');

		$this->registry->smarty->assign(array(	'menu'		=> 'contestphotogroup',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));

		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}

	public function addAction()
    {
        $error 			= array();
        $success 		= array();
        $warning 		= array();

        $id = (int)$this->registry->router->getArg('id');
        $info = new Core_ContestPhotoGroup($id);

        if($_POST['fsubmit']) {
            $formData = $_POST;
            $group = new Core_ContestPhotoGroup();
            $group->name = $formData['groupName'];
            $group->parent = $formData['groupParent'];
            $group->order = $formData['groupOrder'];
            $group->limit = $formData['groupLimit'];
            $group->status = (int)$formData['groupStatus'];
            $group->isGroup = ($formData['isGroup']==='on') ? 1 : 0;
            $group->isSection = (int)$formData['groupSection'];
            $id = $formData['id'];
            if(!$id) {
                $result = $group->addData();
            } else {
                $group->id = $id;
                $result= $group->updateData();
            }


            if ($result) {
                header('location: '.$this->registry->conf['rooturl'].'admin/contestphotogroup');
            }
        }

        $group = Core_ContestPhotoGroup::getList();
        $data = Helper::displaySelectionPhotoGroup($group, $space, true, $info->parent);
        $this->registry->smarty->assign(
            array(
                'data'	 	=> $data,
                'info'      => $info,
                'success'	=> $success,
                'error'		=> $error,
                'warning'	=> $warning,
        ));
        $contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');

        $this->registry->smarty->assign(array(	'menu'		=> 'contestphotogroup',
            'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
            'contents' 	=> $contents));

        $this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
    }
}

?>