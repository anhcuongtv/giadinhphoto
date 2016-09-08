<h2>Export User</h2>

{if $formData.fsubmit != ''}
<form action="" method="post" name="myform">
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>Build Exporter</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.formFormLabel}</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}user">{$lang.controllergroup.formBackLabel}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		Final Query: 
			<textarea class="text-input mceNoEditor"  rows="5" name="fcompletequery" id="fcompletequery">{$formData.fcompletequery}</textarea>
		
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
{/if}
	
	
<form action="" method="post" name="myform">
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>Build Exporter</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.formFormLabel}</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}user">{$lang.controllergroup.formBackLabel}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
				<h2>SELECT</h2>
				<fieldset>
				<p>
					
					<select id="fselectfield" name="fselectfield[]" multiple="multiple" size="20">
						{foreach item=fieldname from=$formData.userfields}
							<option value="{$fieldname}"  {if in_array($fieldname, $formData.fselectfield)}checked="checked"{/if}>{$fieldname}</option>
							
						{/foreach}
					</select>
				</p>
				<h2>WHERE</h2>
				<textarea class="text-input mceNoEditor"  rows="5" name="fwhere" id="fwhere">{$formData.fwhere}</textarea>
				<small>WHERE help: <br />
				- Using Operators: =(equal), &gt;(greater than), &gt;=(greater than or equal), &lt;(less than), &lt;=(less than or equal), &lt;&gt;(not equal), LIKE(Format: LIKE %nam%)
				<br />
				- Using AND, OR, "(",")" to group conditional by logical. Ex: u.u_id > 0 OR (u.u_id = 5 AND up_country = 'vn')
				</small>
				
				
				<br /><br />
				<h2>ORDER BY</h2>
				<p>
				<select name="forderfield">
					{foreach item=fieldname from=$formData.userfields}
						<option value="{$fieldname}" {if $fieldname == $formData.forderfield}selected="selected"{/if}>{$fieldname}</option>
					{/foreach}
				</select>
				
				<select name="forderby">
					<option value="asc">ASC</option>
					<option value="desc" {if $formData.forderby == 'desc'}selected="selected"{/if}>DESC</option>
				</select>
				</p>
				
				<br /><br />
				<h2>LIMIT</h2>
				<p>
					<input type="text" name="flimit" value="{$formData.flimit|default:10000}" class="text-input" />
				</p>
								
				
				</fieldset>
			
		</div>
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="Build SQL Query" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : {$lang.controllergroup.formRequiredLabel}</small>
		</p>
		</fieldset>
	</div>
	
	

    	
</div>
</form>

{literal}
	<script type="text/javascript">
	
		function moreWhere()
		{
			var html = '<div class="wherebox">' + $('.wherebox:last').html() + '</div>';
			$('.wherebox:last').after(html);
		}
	
	</script>
	


{/literal}
