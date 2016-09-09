<h2>{$lang.controller.head_list}</h2>
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="`$smartyControllerGroupContainer`notification.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="{$conf.rooturl_admin}contestphotogroup/add" method="get" name="manage">
                {$data}
                <div class="submit">
                    <input type="submit" value="Thêm Thể Loại" />
                </div>
			</form>
		</div>
	</div>
</div>
