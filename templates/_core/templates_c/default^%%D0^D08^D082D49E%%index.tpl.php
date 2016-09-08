<?php /* Smarty version 2.6.26, created on 2012-08-09 13:18:04
         compiled from _controller/admin/contact/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/contact/index.tpl', 25, false),array('modifier', 'upper', '_controller/admin/contact/index.tpl', 29, false),array('modifier', 'date_format', '_controller/admin/contact/index.tpl', 80, false),array('modifier', 'htmlspecialchars', '_controller/admin/contact/index.tpl', 106, false),array('function', 'paginate', '_controller/admin/contact/index.tpl', 53, false),)), $this); ?>
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
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['tableTabLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2"><?php echo $this->_tpl_vars['lang']['controllergroup']['filterLabel']; ?>
</a></li>
		</ul>
		<?php if ($this->_tpl_vars['formData']['search'] != ''): ?>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contact"><?php echo $this->_tpl_vars['lang']['controllergroup']['formViewAll']; ?>
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
					
				<?php if (count($this->_tpl_vars['contacts']) > 0): ?>
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/id/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'id'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
</a></th>
							<th width="150"><?php echo $this->_tpl_vars['lang']['controller']['formFullnameLabel']; ?>
</th>	
							<th width="100"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/reason/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'reason'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['formReasonLabel']; ?>
</a></th>	
							<th><?php echo $this->_tpl_vars['lang']['controller']['formMessageLabel']; ?>
</th>
							<th width="80"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/status/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'status'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['formStatusLabel']; ?>
</a></th>	
							<th width="100"><?php echo $this->_tpl_vars['lang']['controller']['formIpAddressLabel']; ?>
</th>
							<th width="100"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/id/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'id'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['formDateCreatedLabel']; ?>
</a></th>
							<th width="70"></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="9">
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
				<?php $_from = $this->_tpl_vars['contacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['contact']):
?>
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="<?php echo $this->_tpl_vars['contact']->id; ?>
" <?php if (in_array ( $this->_tpl_vars['contact']->id , $this->_tpl_vars['formData']['fbulkid'] )): ?>checked="checked"<?php endif; ?>/></td>
							<td style="font-weight:bold;"><?php echo $this->_tpl_vars['contact']->id; ?>
</td>
							<td><strong><?php echo $this->_tpl_vars['contact']->fullname; ?>
</strong><br />
								<div style="color:#888;">
									<small>
										<?php echo $this->_tpl_vars['lang']['controller']['formEmailLabel']; ?>
:<?php echo $this->_tpl_vars['contact']->email; ?>
<br />
										<?php echo $this->_tpl_vars['lang']['controller']['formPhoneLabel']; ?>
:<?php echo $this->_tpl_vars['contact']->phone; ?>
<br />
										<?php if ($this->_tpl_vars['contact']->username != ''): ?><?php echo $this->_tpl_vars['lang']['controller']['formUsernameLabel']; ?>
: <a target="_blank" href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['contact']->username; ?>
"><?php echo $this->_tpl_vars['contact']->username; ?>
</a><?php endif; ?>
									</small></div>
								</td>
							<td><?php echo $this->_tpl_vars['contact']->reason; ?>
</td>
							<td><?php echo $this->_tpl_vars['contact']->message; ?>
</td>
							<td><?php if ($this->_tpl_vars['contact']->status == 'completed'): ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/completed.png" title="Completed" alt="completed" /><?php elseif ($this->_tpl_vars['contact']->status == 'pending'): ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pending.png" title="Pending" alt="pending" /><?php else: ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/new.png" title="New" alt="new" /><?php endif; ?>
								<?php if ($this->_tpl_vars['contact']->note != ''): ?><div style="font-style:italic; font-size:11px;" title="<?php echo $this->_tpl_vars['contact']->note; ?>
"><small><?php echo $this->_tpl_vars['lang']['controller']['formNoteLabel']; ?>
: <?php echo $this->_tpl_vars['contact']->note; ?>
</small></div><?php endif; ?>
							</td>
							<td><?php echo $this->_tpl_vars['contact']->ipaddress; ?>
</td>
							<td title="<?php echo ((is_array($_tmp=$this->_tpl_vars['contact']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%H:%M, %B %e, %Y")); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['contact']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%H:%M, %B %e, %Y")); ?>
</td>
							<td><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contact/edit/id/<?php echo $this->_tpl_vars['contact']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pencil.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
" width="16"/></a> &nbsp;
							<a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contact/delete/id/<?php echo $this->_tpl_vars['contact']->id; ?>
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
						<td colspan="9"> <?php echo $this->_tpl_vars['lang']['controllergroup']['notfound']; ?>
</td>
					</tr>
				<?php endif; ?>
				
				</table>
			</form>
	
		</div>
		
		<div class="tab-content" id="tab2">
			<form action="" method="post" style="padding:0px;margin:0px;" onsubmit="return false;">
	
				<?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
: 
				<input type="text" name="fid" id="fid" size="8" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fid']); ?>
" class="text-input" /> - 
				
				<?php echo $this->_tpl_vars['lang']['controller']['formReasonLabel']; ?>
:	
				<select name="freason" id="freason">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="general" <?php if ($this->_tpl_vars['formData']['freason'] == 'general'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonGeneral']; ?>
</option>
						<option value="ads" <?php if ($this->_tpl_vars['formData']['freason'] == 'ads'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonAds']; ?>
</option>
						<option value="idea" <?php if ($this->_tpl_vars['formData']['freason'] == 'idea'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonIdea']; ?>
</option>
						<option value="support" <?php if ($this->_tpl_vars['formData']['freason'] == 'support'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonSupport']; ?>
</option>
					</select> -
					
					<?php echo $this->_tpl_vars['lang']['controller']['formStatusLabel']; ?>
:	
					<select name="fstatus" id="fstatus">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="new" <?php if ($this->_tpl_vars['formData']['fstatus'] == 'new'): ?>selected="selected"<?php endif; ?>>New</option>
						<option value="pending" <?php if ($this->_tpl_vars['formData']['fstatus'] == 'pending'): ?>selected="selected"<?php endif; ?>>Pending</option>
						<option value="completed" <?php if ($this->_tpl_vars['formData']['fstatus'] == 'completed'): ?>selected="selected"<?php endif; ?>>Completed</option>
					</select> -
					
					<?php echo $this->_tpl_vars['lang']['controller']['formKeywordLabel']; ?>
:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fkeyword']); ?>
" class="text-input" /><select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="username" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'username'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInUsernameLabel']; ?>
</option>
						<option value="fullname" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'fullname'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInFullnameLabel']; ?>
</option>
						<option value="email" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'email'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInEmailLabel']; ?>
</option>
						<option value="phone" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'phone'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInPhoneLabel']; ?>
</option>
						<option value="message" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'message'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInMessageLabel']; ?>
</option>
						<option value="ipaddress" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'ipaddress'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInIpAddressLabel']; ?>
</option>
						<option value="note" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'note'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInNoteLabel']; ?>
</option>
						
					</select>
					
				
				
				
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
		var path = rooturl_admin + "contact/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
		}
		
		var reason = $("#freason").val();
		if(reason.length > 0)
		{
			path += "/reason/" + reason;
		}
		
		var status = $("#fstatus").val();
		if(status.length > 0)
		{
			path += "/status/" + status;
		}
		
		var keyword = $("#fkeyword").val();
		if(keyword.length > 0)
		{
			path += "/keyword/" + keyword;
		}
		
		var keywordin = $("#fsearchin").val();
		if(keywordin.length > 0)
		{
			path += "/searchin/" + keywordin;
		}
		
				
		document.location.href= path;
	}
</script>
'; ?>



