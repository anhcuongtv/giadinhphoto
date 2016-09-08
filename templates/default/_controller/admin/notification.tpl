{if count($notifySuccess) > 0}
<div class="notification success png_bg">
	<a href="#" class="close"><img src="{$currentTemplate}/images/admin/icons/cross_grey_small.png" title="Close" alt="close" /></a>
    <div>
       {if $notifySuccess|@is_array}
			{foreach item=notifySuccessItem from=$notifySuccess name="notifysuccess"}
				<p>{$notifySuccessItem}</p>
				{if !$smarty.foreach.notifysuccess.last}<div class="notify-bar-text-sep"></div>{/if}
			{/foreach}
		{else}
			<p>{$notifySuccess}</p>
		{/if}
    </div>
</div>
{/if}

{if count($notifyError) > 0}
<div class="notification error png_bg">
	<a href="#" class="close"><img src="{$currentTemplate}/images/admin/icons/cross_grey_small.png" title="Close" alt="close" /></a>
	<div>
		{if $notifyError|@is_array}
			{foreach item=notifyErrorItem from=$notifyError name="notifyerror"}
				<p>{$notifyErrorItem}</p>
				{if !$smarty.foreach.notifyerror.last}<div class="notify-bar-text-sep"></div>{/if}
			{/foreach}
		{else}
			<p>{$notifyError}</p>
		{/if}
	</div>
</div>
{/if}

{if count($notifyWarning) > 0}
<div class="notification attention png_bg">
	<div>
		{if $notifyWarning|@is_array}
			{foreach item=notifyWarningItem from=$notifyWarning name="notifywarning"}
				<p>{$notifyWarningItem}</p>
				{if !$smarty.foreach.notifywarning.last}<div class="notify-bar-text-sep"></div>{/if}
			{/foreach}
		{else}
			<p>{$notifyWarning}</p>
		{/if}
	</div>
</div>
{/if}

{if count($notifyInformation) > 0}
<div class="notification information png_bg">
	<div>
		{if $notifyInformation|@is_array}
			{foreach item=notifyInformationItem from=$notifyInformation name="notifyinformation"}
				<p>{$notifyInformationItem}</p>
				{if !$smarty.foreach.notifyinformation.last}<div class="notify-bar-text-sep"></div>{/if}
			{/foreach}
		{else}
			<p>{$notifyInformation}</p>
		{/if}
	</div>
</div>
{/if}