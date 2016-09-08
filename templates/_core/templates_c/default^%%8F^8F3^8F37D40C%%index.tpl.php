<?php /* Smarty version 2.6.26, created on 2012-11-12 10:17:33
         compiled from _controller/admin/news/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/news/index.tpl', 29, false),array('modifier', 'date_format', '_controller/admin/news/index.tpl', 96, false),array('modifier', 'htmlspecialchars', '_controller/admin/news/index.tpl', 122, false),array('function', 'paginate', '_controller/admin/news/index.tpl', 59, false),)), $this); ?>
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
news"><?php echo $this->_tpl_vars['lang']['controllergroup']['formViewAll']; ?>
</a></li>
		</ul>
		<?php endif; ?>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news/add/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
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
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="<?php echo $_SESSION['newsBulkToken']; ?>
" />
				<table class="grid">
					
				<?php if (count($this->_tpl_vars['newsList']) > 0): ?>
					<thead>
						<tr>
						   <th width="40" align="left"><input class="check-all" type="checkbox" /></th>
							<th width="30" align="left"><?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
</th>
							
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formNameLabel']; ?>
</th>		
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formCategoryLabel']; ?>
</th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formImageLabel']; ?>
</th>		
							<th class="td_center" width="50"><?php echo $this->_tpl_vars['lang']['controller']['formViewLabel']; ?>
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
					<?php $_from = $this->_tpl_vars['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['news']):
?>
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="<?php echo $this->_tpl_vars['news']->id; ?>
" <?php if (in_array ( $this->_tpl_vars['news']->id , $this->_tpl_vars['formData']['fbulkid'] )): ?>checked="checked"<?php endif; ?>/></td>
							<td style="font-weight:bold;"><?php echo $this->_tpl_vars['news']->id; ?>
</td>
							
							<td><a title="URL: <?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['conf']['seoDirNewsCat']; ?>
/<?php echo $this->_tpl_vars['news']->seoUrl; ?>
-<?php echo $this->_tpl_vars['news']->id; ?>
.html" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news/edit/id/<?php echo $this->_tpl_vars['news']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['news']->name[$this->_tpl_vars['langCode']]; ?>
</a>
								
							</td>
							<td>
								<?php if (count($this->_tpl_vars['news']->categoryList) > 0): ?>
								<ul>
									<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
										
										<?php if (in_array ( $this->_tpl_vars['category']->id , $this->_tpl_vars['news']->categoryList )): ?>
											<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news/index/category/<?php echo $this->_tpl_vars['category']->id; ?>
"><?php echo $this->_tpl_vars['category']->title; ?>
</a></li>
										<?php endif; ?>
										
									<?php endforeach; endif; unset($_from); ?>
									</ul>
								<?php endif; ?>
							</td>
							<td>
							<?php if ($this->_tpl_vars['news']->image != ''): ?><a href="" title="">
								<img style="border:1px solid #999999;" alt="<?php echo $this->_tpl_vars['news']->name[$this->_tpl_vars['langCode']]; ?>
" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['news']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['news']->smallImage; ?>
" width="100" height="100"/>
							<?php endif; ?>
							</td>
							<td class="td_center"><?php echo $this->_tpl_vars['news']->view; ?>
</td>
							<td class="td_center"><?php if ($this->_tpl_vars['news']->enable == 1): ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/tick_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" width="16"/><?php else: ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/cross_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" width="16"/><?php endif; ?></td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['news']->datemodified)) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatSmarty'])); ?>
</td>
							<td><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news/edit/id/<?php echo $this->_tpl_vars['news']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pencil.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
" width="16"/></a> &nbsp;
								<a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news/delete/id/<?php echo $this->_tpl_vars['news']->id; ?>
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
		
		<div class="tab-content" id="tab2"><!--Tim kiem-->
			<form action="" method="post" style="padding:0px;margin:0px;" onsubmit="return false;">
	
				<?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
: 
				<input type="text" name="fid" id="fid" size="4" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fid']); ?>
" class="text-input" /> - 
				
				<?php echo $this->_tpl_vars['lang']['controller']['formCategoryLabel']; ?>
:	
					<select name="fcategory" id="fcategory">
						<option value="0">- - - - - - - - - - - - - - - - - - -</option>
						<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
							<option value="<?php echo $this->_tpl_vars['category']->id; ?>
" title="<?php echo $this->_tpl_vars['category']->name; ?>
" <?php if ($this->_tpl_vars['category']->id == $this->_tpl_vars['formData']['fcategory']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['category']->title; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select> -
					
					<?php echo $this->_tpl_vars['lang']['controller']['formShowLabel']; ?>
:	
					<select name="fenable" id="fenable">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="NO" <?php if ($this->_tpl_vars['formData']['fenable'] == 'NO'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
						<option value="YES" <?php if ($this->_tpl_vars['formData']['fenable'] == 'YES'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
					</select> -
					
					<?php echo $this->_tpl_vars['lang']['controller']['formKeywordLabel']; ?>
:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fkeyword']); ?>
" class="text-input" />&nbsp;<select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="idtext" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'idtext'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInIdtextLabel']; ?>
</option>
						<option value="contents" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'contents'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInContentLabel']; ?>
</option>
						
					</select>
			<p align="right">
				<input type="button" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['filterSubmit']; ?>
" class="button" onclick="gosearch();"  />
			</p>
			</form>
		</div>
		
		
	
	</div>
	

    	
</div>

<?php echo '
<script type="text/javascript">
	function gosearch()
	{
		var path = rooturl_admin + "news/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
		}
		
		
		var enable = $("#fenable").val();
		if(enable.length > 0)
		{
			path += "/enable/" + enable;
		}
		var category = $("#fcategory").val();
		if(category.length > 0)
		{
			path += "/category/" + category;
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



