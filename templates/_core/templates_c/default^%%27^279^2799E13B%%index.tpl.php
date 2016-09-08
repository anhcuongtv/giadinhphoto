<?php /* Smarty version 2.6.26, created on 2012-11-16 15:16:42
         compiled from _controller/admin/newscategory/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/newscategory/index.tpl', 19, false),array('modifier', 'date_format', '_controller/admin/newscategory/index.tpl', 70, false),array('function', 'paginate', '_controller/admin/newscategory/index.tpl', 46, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_list']; ?>
</h2>
<div id="page-intro"><?php echo $this->_tpl_vars['lang']['controller']['intro_list']; ?>
</div>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_list']; ?>
 (<?php echo $this->_tpl_vars['total']; ?>
)</h3>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory/add"><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="<?php echo $_SESSION['newscategoryBulkToken']; ?>
" />
				<table class="grid">
					
				<?php if (count($this->_tpl_vars['categories']) > 0): ?>
					<thead>
						<tr>
						   <th width="40" align="left"><input class="check-all" type="checkbox" /></th>
							<th width="30" align="left"><?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
</th>
							<th width="50"><?php echo $this->_tpl_vars['lang']['controllergroup']['formOrderLabel']; ?>
</th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formNameLabel']; ?>
</th>							
							<th width="100" class="td_center"><?php echo $this->_tpl_vars['lang']['controller']['formShowLabel']; ?>
</th>
							<th width="120" align="left"><?php echo $this->_tpl_vars['lang']['controller']['formDateModifiedLabel']; ?>
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
									<input type="submit" name="fchangeorder" class="button" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['formChangeOrderSubmit']; ?>
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
					<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="<?php echo $this->_tpl_vars['category']->id; ?>
" <?php if (in_array ( $this->_tpl_vars['category']->id , $this->_tpl_vars['formData']['fbulkid'] )): ?>checked="checked"<?php endif; ?>/></td>
							<td style="font-weight:bold;"><?php echo $this->_tpl_vars['category']->id; ?>
</td>
							<td><input type="text" size="3" value="<?php echo $this->_tpl_vars['category']->order; ?>
" name="forder[<?php echo $this->_tpl_vars['category']->id; ?>
]" class="text-input" /></td>
							<td><a title="URL: <?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['conf']['seoDirNewsCategory']; ?>
/<?php echo $this->_tpl_vars['category']->seoUrl; ?>
-<?php echo $this->_tpl_vars['category']->id; ?>
.html" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory/edit/id/<?php echo $this->_tpl_vars['category']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['category']->name[$this->_tpl_vars['langCode']]; ?>
</a>
								<?php if (count($this->_tpl_vars['category']->sub) > 0): ?>
									<ul>
										<?php $_from = $this->_tpl_vars['category']->sub; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subcat']):
?>
											<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory/edit/id/<?php echo $this->_tpl_vars['subcat']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['subcat']->name[$this->_tpl_vars['langCode']]; ?>
</a></li>
										<?php endforeach; endif; unset($_from); ?>
									</ul>
								<?php endif; ?>
							</td>
							<td class="td_center"><?php if ($this->_tpl_vars['category']->enable == 1): ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/tick_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" width="16"/><?php else: ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/cross_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" width="16"/><?php endif; ?></td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['category']->datemodified)) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatSmarty'])); ?>
</td>
							<td><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory/edit/id/<?php echo $this->_tpl_vars['category']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pencil.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
" width="16"/></a> &nbsp;
								<a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory/delete/id/<?php echo $this->_tpl_vars['category']->id; ?>
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
						<td colspan="10"> <?php echo $this->_tpl_vars['lang']['controllergroup']['notfound']; ?>
</td>
					</tr>
				<?php endif; ?>
				
				</table>
			</form>
	
	</div>

    	
</div>


