
<div class="listphoto-inner">
		<ul class="photo-item">

			{foreach item=photo from=$photos}
				<li class="item"><a href="{$photo->filepath}"><img src="{$conf.rooturl}uploads/contestphoto/en/{$photo->filethumb2}"/></a> </li>
			{/foreach}
		</li>
	</div>
{literal}
<script>
				$(document).ready(function(){
									$(".listphoto").colorbox({rel:'group1'});

});
</script>
{/literal}