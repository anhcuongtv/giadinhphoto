<table width="100%" border="0"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
	<tr>
  	<td>
    	<div class="nav_tabs">	
      <ul>
      		<li class=""><a href="{$base_dir}news/view">Manage Product</a></li>
          <li class=""><a href="{$base_dir}news/add">Add New Product</a></li>
          <li class=""><a href="{$base_dir}manufacturer/view">Manufacturer</a></li>
          <li class=""><a href="{$base_dir}productfield/view">Field</a></li>
          <li class=""><a href="{$base_dir}productattribute/view">Attribute</a></li>
          <li class=""><a href="{$base_dir}productreview/view">Review</a></li>
          <li class=""><a href="{$base_dir}productfullcategory/view">Manage Category</a></li>
          <li class=""><a href="{$base_dir}productfullcategory/add">Add Category</a></li>
          <li class="active"><a href="javascript:void(0);">Assigning no-parent  subcategory...</a></li>
        </ul>
        <div class="tab_description">This section allows you to edit move no-parent subcategory to new category.</div>
      </div>
    </td>
  </tr>
</table>


<form action="" method="post">
	<table width="100%" class="tablegrid" border="0" cellspacing="0" cellpadding="2" style="border-collapse:collapse;">
     
       <tr>
      	<td align="right">Name<span class="star_require">*</span> :</td>
        <td><input type='text' name="fcatname[en]" value="{$formData.fcatname.en}" size="40"/></td>
      </tr>
      <tr>
      	<td align="right">(OR) Move to category :</td>
        <td><select name="fcategory">{html_options options=$categoryOptions selected=$formData.fcategory}</select></td>
      </tr>
   
      <tr>
        <td></td>
        <td><input type="submit" name="fsubmit" value=" Assign " class="submit_double_border" /></td>
      </tr>
    </table>
</form>