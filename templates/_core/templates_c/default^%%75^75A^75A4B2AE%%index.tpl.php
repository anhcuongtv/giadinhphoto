<?php /* Smarty version 2.6.26, created on 2012-08-11 08:36:33
         compiled from _controller/admin/log/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/log/index.tpl', 31, false),array('modifier', 'date_format', '_controller/admin/log/index.tpl', 71, false),array('modifier', 'htmlspecialchars', '_controller/admin/log/index.tpl', 102, false),array('function', 'paginate', '_controller/admin/log/index.tpl', 58, false),array('function', 'html_options', '_controller/admin/log/index.tpl', 110, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_list']; ?>
</h2>
<div id="page-intro"><?php echo $this->_tpl_vars['lang']['controller']['intro_list']; ?>
</div>




<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_list']; ?>
 <?php if ($this->_tpl_vars['formData']['search'] != ''): ?>| <?php echo $this->_tpl_vars['lang']['controller']['title_listSearch']; ?>
 <?php endif; ?>(<?php echo $this->_tpl_vars['total']; ?>
)</h3>
		<ul class="content-box-link">
			<li><a href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log/clear/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
?token=<?php echo $_SESSION['securityToken']; ?>
');"><?php echo $this->_tpl_vars['lang']['controller']['clearLabel']; ?>
</a></li>
		</ul>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['tableTabLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2"><?php echo $this->_tpl_vars['lang']['controllergroup']['filterLabel']; ?>
</a></li>
		</ul>
		<?php if ($this->_tpl_vars['formData']['search'] != ''): ?>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log"><?php echo $this->_tpl_vars['lang']['controllergroup']['formViewAll']; ?>
</a></li>
		</ul>
		<?php endif; ?>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyControllerGroupContainer'])."notification.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<table class="grid">
					
				<?php if (count($this->_tpl_vars['logs']) > 0): ?>
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30"><?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
</th>
							<th><?php echo $this->_tpl_vars['lang']['controller']['formDatecreatedLabel']; ?>
</th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formUsernameLabel']; ?>
</th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formGroupLabel']; ?>
</th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formTypeLabel']; ?>
</th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formIpLabel']; ?>
</th>
							<th width="70"></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="8">
								<div class="bulk-actions align-left">
									<select name="fbulkaction">
										<option value=""><?php echo $this->_tpl_vars['lang']['controllergroup']['bulkActionSelectLabel']; ?>
</option>
										<option value="delete"><?php echo $this->_tpl_vars['lang']['controllergroup']['bulkActionDeletetLabel']; ?>
</option>
									</select>
									<input type="submit" name="fsubmitbulk" class="button" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['bulkActionSubmit']; ?>
" />
								</div>
								
								<div class="pagination">
								   <?php $this->assign('pageurl', "page/::PAGE::"); ?>
									<?php echo smarty_function_paginate(array('count' => $this->_tpl_vars['totalPage'],'curr' => $this->_tpl_vars['curPage'],'lang' => $this->_tpl_vars['paginateLang'],'max' => 10,'url' => ($this->_tpl_vars['paginateurl']).($this->_tpl_vars['pageurl'])), $this);?>

								</div> <!-- End .pagination -->
		
								<div class="clear"></div>
							</td>
						</tr>
					</tfoot>
					<tbody>
				<?php $_from = $this->_tpl_vars['logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['log']):
?>
					
						<tr>
							<td align="center"><input type="checkbox" name="fbulkid[]" value="<?php echo $this->_tpl_vars['log']->id; ?>
" <?php if (in_array ( $this->_tpl_vars['log']->id , $this->_tpl_vars['formData']['fbulkid'] )): ?>checked="checked"<?php endif; ?>/></td>
							<td align="center"><?php echo $this->_tpl_vars['log']->id; ?>
</td>
							<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['log']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty'])); ?>
</td>
							<td align="left"><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log/index/uid/<?php echo $this->_tpl_vars['log']->uid; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['log']->username; ?>
</a></td>
							<td><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log/index/group/<?php echo $this->_tpl_vars['log']->groupid; ?>
"><?php echo $this->_tpl_vars['log']->groupname; ?>
</a></td>
							<td><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log/index/type/<?php echo $this->_tpl_vars['log']->type; ?>
"><?php echo $this->_tpl_vars['log']->type; ?>
</a></td>
							<td><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log/index/ip/<?php echo $this->_tpl_vars['log']->ip; ?>
"><?php echo $this->_tpl_vars['log']->ip; ?>
</a></td>
						
							<td align="center"><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDetailTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log/detail/id/<?php echo $this->_tpl_vars['log']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/detail.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formDetailLabel']; ?>
" width="16"/></a> &nbsp;
								<a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log/delete/id/<?php echo $this->_tpl_vars['log']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
?token=<?php echo $_SESSION['securityToken']; ?>
');"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/cross.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formDeleteLabel']; ?>
" width="16"/></a>
							</td>
						</tr>
					
				<?php endforeach; endif; unset($_from); ?>
					</tbody>
				
					
				  
				<?php else: ?>
					<tr>
						<td colspan="10"><?php echo $this->_tpl_vars['lang']['controllergroup']['notfound']; ?>
</td>
					</tr>
				<?php endif; ?>
				
				</table>
			</form>
	 </div>
	 
	<div class="tab-content" id="tab2">

		<form action="" method="post" style="padding:0px;margin:0px;" onsubmit="return false;">
	
			<?php echo $this->_tpl_vars['lang']['controller']['formUsernameLabel']; ?>
:
			<input type="text" name="fusername" id="fusername" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fusername']); ?>
" class="text-input" /> -
			
			<?php echo $this->_tpl_vars['lang']['controller']['formTypeLabel']; ?>
:
			<input type="text" name="ftype" id="ftype" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['ftype']); ?>
" class="text-input" /> -
			
			<?php echo $this->_tpl_vars['lang']['controller']['formGroupLabel']; ?>
:
				<select name="fgroup" id="fgroup" size="1">
					<option value="">- - - - - - - - - - - - - - - - </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['usergroups'],'selected' => $this->_tpl_vars['formData']['fgroup']), $this);?>

				</select> -
			<?php echo $this->_tpl_vars['lang']['controller']['formIpLabel']; ?>
:
			<input type="text" name="fip" id="fip" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fip']); ?>
" class="text-input" /> -
			
			<input type="button" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['filterSubmit']; ?>
" class="button" onclick="gosearch();"  />
	
		</form>
	</div>
	
	</div>

    	
</div>



<?php echo '
<script type="text/javascript">
	function gosearch()
	{
		var path = rooturl_admin + "log/index";
		
		
		var keyword = $("#fusername").val();
		if(keyword.length > 0)
		{
			path += "/username/" + keyword;
		}
		
		var type = $("#ftype").val();
		if(type.length > 0)
		{
			path += "/type/" + type;
		}
		
		
		
		var group = $("#fgroup").val();
		if(group > 0)
		{
			path += "/group/" + group;
		}
		
		var ip = $("#fip").val();
		if(ip.length > 0)
		{
			path += "/ip/" + ip;
		}
		
		
		
		
		document.location.href= path;
	}
</script>
'; ?>