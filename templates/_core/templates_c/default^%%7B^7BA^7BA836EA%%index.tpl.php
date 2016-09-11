<?php /* Smarty version 2.6.26, created on 2016-09-10 15:44:14
         compiled from _controller/admin/contestphotogroup/index.tpl */ ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_list']; ?>
</h2>
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyControllerGroupContainer'])."notification.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<form action="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphotogroup/add" method="get" name="manage">
                <?php echo $this->_tpl_vars['data']; ?>

                <div class="submit">
                    <input type="submit" value="Thêm Thể Loại" />
                </div>
			</form>
		</div>
	</div>
</div>