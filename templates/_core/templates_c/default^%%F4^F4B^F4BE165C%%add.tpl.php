<?php /* Smarty version 2.6.26, created on 2016-09-11 14:58:17
         compiled from _controller/admin/contestphotogroup/add.tpl */ ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
</h2>
<div class="content-box"><!-- Start Content Box -->
    <form action="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphotogroup/add" method="post" name="manage">
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyControllerGroupContainer'])."notification.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <fieldset>
                    <p>
                        <label><?php echo $this->_tpl_vars['lang']['controller']['group_parent']; ?>
 <span class="star_require">*</span> : </label>
                        <select id="groupParent" name="groupParent">
                           <option value="0">-----------</option>
                           <?php echo $this->_tpl_vars['data']; ?>

                        </select>
                    </p>
                    <p>
                        <label><?php echo $this->_tpl_vars['lang']['controller']['group_name']; ?>
 <span class="star_require">*</span> : </label>
                        <input type="text" name="groupName" id="groupName" size="40" value="<?php echo $this->_tpl_vars['info']->name; ?>
" class="text-input">
                    </p>
                    <p>
                        <label><?php echo $this->_tpl_vars['lang']['controller']['group_limit']; ?>
 <span class="star_require">*</span> : </label>
                        <input type="text" name="groupLimit" id="groupLimit" size="40" value="<?php echo $this->_tpl_vars['info']->limit; ?>
" class="text-input">
                    </p>
                    <p>
                        <label><?php echo $this->_tpl_vars['lang']['controller']['group_order']; ?>
 <span class="star_require">*</span> : </label>
                        <input type="text" name="groupOrder" id="groupOrder" value="<?php echo $this->_tpl_vars['info']->order; ?>
" size="40" class="text-input">
                    </p>
	                <p>
		                <label><?php echo $this->_tpl_vars['lang']['controller']['group_isGroup']; ?>
 <span class="star_require">*</span> : </label>
		                <input type="checkbox" name="isGroup" id="isGroup" <?php if (( $this->_tpl_vars['info']->isGroup === 1 )): ?>checked="checked"<?php endif; ?> class="text-input">
	                </p>
                    <p>
                        <label><?php echo $this->_tpl_vars['lang']['controller']['group_status']; ?>
 <span class="star_require">*</span>  : </label>
                        <select id="groupStatus" name="groupStatus">
                            <option value="1" <?php if (( $this->_tpl_vars['info']->status === 1 )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['yes']; ?>
</option>
                            <option value="0" <?php if (( $this->_tpl_vars['info']->status === 0 )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['no']; ?>
</option>
                        </select>
                    </p>
					<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['info']->id; ?>
"/>
                </fieldset>
		</div>
	</div>
    <div class="content-box-content-alt">
        <fieldset>
            <p>
                <input type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['formAddSubmit']; ?>
" class="button buttonbig">
                <br /><small><span class="star_require">*</span> : <?php echo $this->_tpl_vars['lang']['controllergroup']['formRequiredLabel']; ?>
</small>
            </p>
        </fieldset>
    </div>
    </form>
</div>