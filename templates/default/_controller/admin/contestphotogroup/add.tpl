<h2>{$lang.controller.head_add}</h2>
<div class="content-box"><!-- Start Content Box -->
    <form action="{$conf.rooturl_admin}contestphotogroup/add" method="post" name="manage">
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="`$smartyControllerGroupContainer`notification.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
                <fieldset>
                    <p>
                        <label>{$lang.controller.group_parent} <span class="star_require">*</span> : </label>
                        <select id="groupParent" name="groupParent">
                           <option value="0">-----------</option>
                           {$data}
                        </select>
                    </p>
                    <p>
                        <label>{$lang.controller.group_name} <span class="star_require">*</span> : </label>
                        <input type="text" name="groupName" id="groupName" size="40" value="{$info->name}" class="text-input">
                    </p>
                    <p>
                        <label>{$lang.controller.group_limit} <span class="star_require">*</span> : </label>
                        <input type="text" name="groupLimit" id="groupLimit" size="40" value="{$info->limit}" class="text-input">
                    </p>
                    <p>
                        <label>{$lang.controller.group_order} <span class="star_require">*</span> : </label>
                        <input type="text" name="groupOrder" id="groupOrder" value="{$info->order}" size="40" class="text-input">
                    </p>
	                <p>
		                <label>{$lang.controller.group_isGroup} <span class="star_require">*</span> : </label>
		                <input type="checkbox" name="isGroup" id="isGroup" {if ($info->isGroup === 1)}checked="checked"{/if} class="text-input">
	                </p>
                    <p>
                        <label>{$lang.controller.group_status} <span class="star_require">*</span>  : </label>
                        <select id="groupStatus" name="groupStatus">
                            <option value="1" {if ($info->status === 1)}selected="selected"{/if}>{$lang.controller.yes}</option>
                            <option value="0" {if ($info->status === 0)}selected="selected"{/if}>{$lang.controller.no}</option>
                        </select>
                    </p>
					<input type="hidden" name="id" value="{$info->id}"/>
                </fieldset>
		</div>
	</div>
    <div class="content-box-content-alt">
        <fieldset>
            <p>
                <input type="submit" name="fsubmit" value="{$lang.controllergroup.formAddSubmit}" class="button buttonbig">
                <br /><small><span class="star_require">*</span> : {$lang.controllergroup.formRequiredLabel}</small>
            </p>
        </fieldset>
    </div>
    </form>
</div>
