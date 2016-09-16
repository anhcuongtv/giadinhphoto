<?php /* Smarty version 2.6.26, created on 2016-09-16 09:59:50
         compiled from _controller/admin/language/view.tpl */ ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_list']; ?>
</h2>
<div id="page-intro"><?php echo $this->_tpl_vars['lang']['controller']['intro_list']; ?>
</div>




<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_list']; ?>
</h3>
		
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<?php $_from = $this->_tpl_vars['langPacks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
			<div class="langfolder">
				<div class="langfolder_langpack">
					<?php echo $this->_tpl_vars['language']['folder']; ?>

				</div>
				<ul>
					<?php $_from = $this->_tpl_vars['language']['controllergroup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupname'] => $this->_tpl_vars['groupfiles']):
?>
						<li class="langfolder_folder">
							<?php echo $this->_tpl_vars['groupname']; ?>

							<ul>
								<?php $_from = $this->_tpl_vars['groupfiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['langfile']):
?>
									<li class="langfolder_file">
										<a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
language/edit/folder/<?php echo $this->_tpl_vars['language']['folder']; ?>
/subfolder/<?php echo $this->_tpl_vars['groupname']; ?>
/file/<?php echo $this->_tpl_vars['langfile']; ?>
"><?php echo $this->_tpl_vars['langfile']; ?>
</a>
									</li>
								<?php endforeach; endif; unset($_from); ?>
							</ul>
						</li>
					<?php endforeach; endif; unset($_from); ?>
					
					<?php $_from = $this->_tpl_vars['language']['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['langfile']):
?>
						<li class="langfolder_file">
							<a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
language/edit/folder/<?php echo $this->_tpl_vars['language']['folder']; ?>
/file/<?php echo $this->_tpl_vars['langfile']; ?>
"><?php echo $this->_tpl_vars['langfile']; ?>
</a>
						</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
				
			</div>
		<?php endforeach; endif; unset($_from); ?>
	
		<div class="clear">&nbsp;</div>
	</div>
	
	
	
	

    	
</div>


