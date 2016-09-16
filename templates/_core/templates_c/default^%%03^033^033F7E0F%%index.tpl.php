<?php /* Smarty version 2.6.26, created on 2016-09-16 13:22:09
         compiled from _controller/admin/contestphoto/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/contestphoto/index.tpl', 28, false),array('modifier', 'upper', '_controller/admin/contestphoto/index.tpl', 32, false),array('modifier', 'date_format', '_controller/admin/contestphoto/index.tpl', 84, false),array('modifier', 'htmlspecialchars', '_controller/admin/contestphoto/index.tpl', 109, false),array('function', 'paginate', '_controller/admin/contestphoto/index.tpl', 58, false),)), $this); ?>
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
contestphoto"><?php echo $this->_tpl_vars['lang']['controllergroup']['formViewAll']; ?>
</a></li>
		</ul>
		<?php endif; ?>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphoto/add/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
</a></li>
		</ul>
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
				<table class="grid" cellpadding="5" width="100%">
					
				<?php if (count($this->_tpl_vars['photos']) > 0): ?>
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/id/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'id'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">ID</a></th>
							<th width="60">Photo</th>
							<th class="td_left"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/name/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'name'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">Name</a></th>		
							<th class="td_right"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/filesize/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'filesize'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">File Size</a></th>				
							<th class="td_center"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/resolution/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'resolution'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">Resolution</a></th>
							<th class="td_center"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/view/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'view'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">View</a></th>				
							<th align="left"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/username/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'username'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">Poster</a></th>				
							
							<th align="left"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/id/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'id'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">Date Posted</a></th>
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
				<?php $_from = $this->_tpl_vars['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
					
						<tr>
							<td align="center"><input type="checkbox" name="fbulkid[]" value="<?php echo $this->_tpl_vars['photo']->id; ?>
" <?php if (in_array ( $this->_tpl_vars['photo']->id , $this->_tpl_vars['formData']['fbulkid'] )): ?>checked="checked"<?php endif; ?>/></td>
							
							<td style="font-weight:bold;"><?php echo $this->_tpl_vars['photo']->id; ?>
</td>
							<?php if ($this->_tpl_vars['photo']->fileserver == ""): ?>
                            <td><a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['photo']->filethumb1; ?>
" title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><img src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['photo']->filethumb2; ?>
" width="60" /></a></td>                  <?php else: ?>
                            <td><a href="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['photo']->filethumb1; ?>
" title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><img src="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['photo']->filethumb2; ?>
" width="60" /></a></td>
                            <?php endif; ?>
							<td><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphoto/edit/id/<?php echo $this->_tpl_vars['photo']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><b><?php echo $this->_tpl_vars['photo']->name; ?>
</b></a>
								<div><small><?php if ($this->_tpl_vars['photo']->description != ''): ?>Tag: <?php echo $this->_tpl_vars['photo']->description; ?>
<?php endif; ?></small></div>
							
							</td>
							<td class="td_right"><?php echo $this->_tpl_vars['photo']->formatFileSize(); ?>
</td>
							<td class="td_center"><?php echo $this->_tpl_vars['photo']->resolution; ?>
</td>
							<td class="td_center"><?php echo $this->_tpl_vars['photo']->view; ?>
</td>
							<td><?php echo $this->_tpl_vars['photo']->poster->username; ?>
</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
							<td><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphoto/edit/id/<?php echo $this->_tpl_vars['photo']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pencil.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
" width="16"/></a> &nbsp;
								<a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
photocontest/delete/id/<?php echo $this->_tpl_vars['photo']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
?token=<?php echo $_SESSION['securityToken']; ?>
');"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/cross.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formDeleteLabel']; ?>
" width="16"/></a>
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
				
				<?php echo $this->_tpl_vars['lang']['controller']['formKeywordLabel']; ?>
:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fkeyword']); ?>
" class="text-input" /><select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="name" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'name'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInNameLabel']; ?>
</option>
						<option value="username" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'username'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInUsernameLabel']; ?>
</option>
						<option value="description" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'description'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInDescriptionLabel']; ?>
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
		var path = rooturl_admin + "contestphoto/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
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






