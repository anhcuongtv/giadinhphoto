<?php /* Smarty version 2.6.26, created on 2014-08-25 19:31:17
         compiled from _controller/admin/user/export.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', '_controller/admin/user/export.tpl', 90, false),)), $this); ?>
<h2>Export User</h2>

<?php if ($this->_tpl_vars['formData']['fsubmit'] != ''): ?>
<form action="" method="post" name="myform">
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>Build Exporter</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['formFormLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user"><?php echo $this->_tpl_vars['lang']['controllergroup']['formBackLabel']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		Final Query: 
			<textarea class="text-input mceNoEditor"  rows="5" name="fcompletequery" id="fcompletequery"><?php echo $this->_tpl_vars['formData']['fcompletequery']; ?>
</textarea>
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="Export" class="button buttonbig">
			
		</p>
		</fieldset>
	</div>
</div>
</form>
<?php endif; ?>
	
	
<form action="" method="post" name="myform">
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>Build Exporter</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['formFormLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user"><?php echo $this->_tpl_vars['lang']['controllergroup']['formBackLabel']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<h2>SELECT</h2>
				<fieldset>
				<p>
					
					<select id="fselectfield" name="fselectfield[]" multiple="multiple" size="20">
						<?php $_from = $this->_tpl_vars['formData']['userfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldname']):
?>
							<option value="<?php echo $this->_tpl_vars['fieldname']; ?>
"  <?php if (in_array ( $this->_tpl_vars['fieldname'] , $this->_tpl_vars['formData']['fselectfield'] )): ?>checked="checked"<?php endif; ?>><?php echo $this->_tpl_vars['fieldname']; ?>
</option>
							
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</p>
				<h2>WHERE</h2>
				<textarea class="text-input mceNoEditor"  rows="5" name="fwhere" id="fwhere"><?php echo $this->_tpl_vars['formData']['fwhere']; ?>
</textarea>
				<small>WHERE help: <br />
				- Using Operators: =(equal), &gt;(greater than), &gt;=(greater than or equal), &lt;(less than), &lt;=(less than or equal), &lt;&gt;(not equal), LIKE(Format: LIKE %nam%)
				<br />
				- Using AND, OR, "(",")" to group conditional by logical. Ex: u.u_id > 0 OR (u.u_id = 5 AND up_country = 'vn')
				</small>
				
				
				<br /><br />
				<h2>ORDER BY</h2>
				<p>
				<select name="forderfield">
					<?php $_from = $this->_tpl_vars['formData']['userfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldname']):
?>
						<option value="<?php echo $this->_tpl_vars['fieldname']; ?>
" <?php if ($this->_tpl_vars['fieldname'] == $this->_tpl_vars['formData']['forderfield']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['fieldname']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				
				<select name="forderby">
					<option value="asc">ASC</option>
					<option value="desc" <?php if ($this->_tpl_vars['formData']['forderby'] == 'desc'): ?>selected="selected"<?php endif; ?>>DESC</option>
				</select>
				</p>
				
				<br /><br />
				<h2>LIMIT</h2>
				<p>
					<input type="text" name="flimit" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['formData']['flimit'])) ? $this->_run_mod_handler('default', true, $_tmp, 10000) : smarty_modifier_default($_tmp, 10000)); ?>
" class="text-input" />
				</p>
								
				
				</fieldset>
			
		</div>
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="Build SQL Query" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : <?php echo $this->_tpl_vars['lang']['controllergroup']['formRequiredLabel']; ?>
</small>
		</p>
		</fieldset>
	</div>
	
	

    	
</div>
</form>

<?php echo '
	<script type="text/javascript">
	
		function moreWhere()
		{
			var html = \'<div class="wherebox">\' + $(\'.wherebox:last\').html() + \'</div>\';
			$(\'.wherebox:last\').after(html);
		}
	
	</script>
	


'; ?>
