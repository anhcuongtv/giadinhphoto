<?php /* Smarty version 2.6.26, created on 2016-09-16 10:00:18
         compiled from _controller/admin/order/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/order/index.tpl', 28, false),array('modifier', 'upper', '_controller/admin/order/index.tpl', 32, false),array('modifier', 'date_format', '_controller/admin/order/index.tpl', 75, false),array('modifier', 'htmlspecialchars', '_controller/admin/order/index.tpl', 104, false),array('function', 'paginate', '_controller/admin/order/index.tpl', 59, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_list']; ?>
</h2>

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
order"><?php echo $this->_tpl_vars['lang']['controllergroup']['formViewAll']; ?>
</a></li>
		</ul>
		<?php endif; ?>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order/add/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
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
				<input type="hidden" name="ftoken" value="<?php echo $_SESSION['orderBulkToken']; ?>
" />
				<table class="grid" cellpadding="5" width="100%">
					
				<?php if (count($this->_tpl_vars['orders']) > 0): ?>
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th align="left" width="30"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/id/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'id'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">ID</a></th>
							<th align="left"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/id/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'id'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>">Invoice ID</a></th>		
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['printCustomerInfo']; ?>
</th>				
							<th align="right"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/subtotal/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'subtotal'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['formOrderTotalLabel']; ?>
</a></th>	
                            <th align="center"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/datepaid/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'datepaid'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['formPaidLabel']; ?>
</a></th>	
                            <th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formOrderPaidMethod']; ?>
</th>			
										
							
							<th width="100" align="left"><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/status/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'status'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['formOrderStatusLabel']; ?>
</a></th>
							<th><a href="<?php echo $this->_tpl_vars['filterUrl']; ?>
sortby/id/sorttype/<?php if ($this->_tpl_vars['formData']['sortby'] == 'id'): ?><?php if (((is_array($_tmp=$this->_tpl_vars['formData']['sorttype'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) != 'DESC'): ?>DESC<?php else: ?>ASC<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['formOrderOnLabel']; ?>
</a></th>
							<th width="70"></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="10">
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
				<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
					
						<tr <?php if ($this->_tpl_vars['order']->status == 'completed'): ?>style="background:#A5F791;" title="Completed"<?php endif; ?>>
							<td align="center"><input type="checkbox" name="fbulkid[]" value="<?php echo $this->_tpl_vars['order']->id; ?>
" <?php if (in_array ( $this->_tpl_vars['order']->id , $this->_tpl_vars['formData']['fbulkid'] )): ?>checked="checked"<?php endif; ?>/></td>
							<td style="font-weight:bold;"><?php echo $this->_tpl_vars['order']->id; ?>
</td>
							<td style="font-weight:bold;"><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order/edit/id/<?php echo $this->_tpl_vars['order']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['order']->invoiceid; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['order']->billingFirstname; ?>
 <?php echo $this->_tpl_vars['order']->billingLastname; ?>
</td>
							<td align="right"><?php $this->assign('priceAfterAll', $this->_tpl_vars['order']->subtotal+$this->_tpl_vars['order']->shipprice+$this->_tpl_vars['order']->taxprice); ?><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['priceAfterAll']); ?>
</td>
                            <td align="center"><?php if ($this->_tpl_vars['order']->datepaid > 0 || $this->_tpl_vars['order']->status == 'completed'): ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/tick_circle.png" alt="Yes" border="0" width="16" title="<?php echo $this->_tpl_vars['lang']['controller']['formOrderPaidAtTooltip']; ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['order']->datepaid)) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty'])); ?>
. <?php echo $this->_tpl_vars['lang']['controller']['formOrderPaidMethod']; ?>
: <?php echo $this->_tpl_vars['order']->paymentmethod; ?>
" /><?php endif; ?></td>
                            <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']->paymentmethod)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</td>
							
							<td align="left"><?php echo $this->_tpl_vars['order']->status; ?>
</td>
							<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty'])); ?>
</td>
							<td><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order/edit/id/<?php echo $this->_tpl_vars['order']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pencil.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
" width="16"/></a> &nbsp;
								<a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order/delete/id/<?php echo $this->_tpl_vars['order']->id; ?>
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
				
				<?php echo $this->_tpl_vars['lang']['controller']['formInvoiceIdLabel']; ?>
: 
				<input type="text" name="finvoiceid" id="finvoiceid" size="8" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['finvoiceid']); ?>
" class="text-input" /> - 
				
				
				<?php echo $this->_tpl_vars['lang']['controller']['formKeywordLabel']; ?>
:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fkeyword']); ?>
" class="text-input" /><select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="email" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'email'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInEmailLabel']; ?>
</option>
						<option value="status" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'status'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInStatusLabel']; ?>
</option>
						<option value="paymentmethod" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'paymentmethod'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInPaymentmethodLabel']; ?>
</option>
						<option value="firstname" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'firstname'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInFirstNameLabel']; ?>
</option>
						<option value="lastname" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'lastname'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInLastNameLabel']; ?>
</option>
						<option value="phone" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'phone'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInPhoneLabel']; ?>
</option>
						<option value="comment" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'comment'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInCommentLabel']; ?>
</option>
						<option value="address" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'address'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInAddressLabel']; ?>
</option>
						<option value="city" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'city'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInCityLabel']; ?>
</option>
						<option value="region" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'region'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInRegionLabel']; ?>
</option>
						<option value="country" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'country'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInCountryLabel']; ?>
</option>
						<option value="zipcode" <?php if ($this->_tpl_vars['formData']['fsearchin'] == 'zipcode'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['formKeywordInZipcodeLabel']; ?>
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
		var path = rooturl_admin + "order/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
		}
		
		var invoiceid = $("#finvoiceid").val();
		if(parseInt(invoiceid) > 0)
		{
			path += "/invoiceid/" + invoiceid;
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






