<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>{if $pageTitle != ''}{$pageTitle}{else}{$setting.site.defaultPageTitle}{/if}</title>
<meta name="author" content="iMSVietnam, support@imsvietnam.com" />
<meta name="keywords" content="{$pageKeyword|default:$setting.site.defaultPageKeyword}" />
<meta name="description" content="{$pageDescription|default:$setting.site.defaultPageDescription}" />
<meta name="robots" content="index,follow" />
<link href="{$conf.rooturl}{$currentTemplate}/css/judge.css" rel="stylesheet" type="text/css" media="screen,print" />
<script language="JavaScript" type="text/javascript" src="{$conf.rooturl}{$currentTemplate}/js/jquery-1.3.2.js"></script>



</head>
<body>


<div id="header">
    <div id="header-main" style="max-width: 1280px; margin: 0 auto;">
	<div id="headerleft">
    	<strong><big>{$currentPhoto->name}{if $currentPhoto->section == 'landscape-c'} [Best Portrait]{elseif $currentPhoto->section == 'sport-c'} [Best Action]{elseif $currentPhoto->section == 'idea-c'} [Best Idea]{elseif $currentPhoto->section == 'landscape-m'}[Best Portrait]{elseif $currentPhoto->section == 'sport-m'} [Best Action]{elseif $currentPhoto->section == 'idea-m'} [Best Idea]{/if} - Photo ID #{$currentPhoto->id}</big></strong>
    </div>
	
	<div id="headerright">
    	<strong><big>{$lang.controller.title}</big></strong> &lt; <a style="color: yellow;" href="{$conf.rooturl}memberarea.html" title="">{$me->username}</a> - <a href="{$conf.rooturl}logout.html" title="Logout">{$lang.controller.logout}</a> &gt;
	</div>
    </div>
</div>
<div style=" max-width: 1280px; margin: 0 auto;">
<table width="100%" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
	<tr style="background: #fff;">
		<td width="800" style="background:#fff;padding:10px;" valign="top">
			
			
			
			
			<div id="photo" style="width:640px; text-align:center;">
                {if $currentPhoto->fileserver == vn}
                    <a id="originalphoto" href="{$setting.extra.imageDirectoryRemoteServer.vn}{$currentPhoto->filepath}" rel="{$setting.extra.imageDirectoryRemoteServer.vn}{$currentPhoto->filepath}" target="_blank" title="Click to view Fullsize"><img id="bigphoto" src="{$setting.extra.imageDirectoryRemoteServer.vn}{$currentPhoto->filethumb1}" border="0" alt="{$currentPhoto->filethumb1}" /></a>
                {else}
                    <a id="originalphoto" href="{$setting.contestphoto.imageDirectory}{$currentPhoto->filepath}" rel="{$setting.contestphoto.imageDirectory}{$currentPhoto->filepath}" target="_blank" title="Click to view Fullsize"><img id="bigphoto" src="{$setting.contestphoto.imageDirectory}{$currentPhoto->filethumb1}" border="0" alt="{$currentPhoto->filethumb1}" /></a>
                {/if}
            </div>
			
            <div id="photonav">
            	<a href="?id={$prevId}"title="Photo #{$prevId}" class="button"><img style="width:25px;height:48px" src="{$currentTemplate}/images/button_prev.gif" alt="Previous" /></a>
                
				{foreach name=prevphotolist item=smallphoto from=$prevPhotoList}
				{if $smallphoto->fileserver == vn}
                    <a href="?id={$smallphoto->id}" title="Photo #{$smallphoto->id}"><img class="thumb" src="{$setting.extra.imageDirectoryRemoteServer.vn}{$smallphoto->filethumb2}" alt="{$smallphoto->filethumb2}" /></a>
                {else}
                    <a href="?id={$smallphoto->id}" title="Photo #{$smallphoto->id}"><img class="thumb" src="{$setting.contestphoto.imageDirectory}{$smallphoto->filethumb2}" alt="{$smallphoto->filethumb2}" /></a>
                {/if}
                {/foreach}
				
                {if $currentPhoto->fileserver == vn}
                    <a href="#" class="current"><img class="thumb" src="{$setting.extra.imageDirectoryRemoteServer.vn}{$currentPhoto->filethumb2}" alt="{$currentPhoto->filethumb2}" /></a>
                {else}
                    <a href="#" class="current"><img class="thumb" src="{$setting.contestphoto.imageDirectory}{$currentPhoto->filethumb2}" alt="{$currentPhoto->filethumb2}" /></a>
                {/if}
                
                {foreach name=nextphotolist item=smallphoto from=$nextPhotoList}
				{if $smallphoto->fileserver == vn}
                    <a href="?id={$smallphoto->id}" title="Photo #{$smallphoto->id}"><img class="thumb" src="{$setting.extra.imageDirectoryRemoteServer.vn}{$smallphoto->filethumb2}" alt="{$smallphoto->filethumb2}" /></a>
                {else}
                    <a href="?id={$smallphoto->id}" title="Photo #{$smallphoto->id}"><img class="thumb" src="{$setting.contestphoto.imageDirectory}{$smallphoto->filethumb2}" alt="{$smallphoto->filethumb2}" /></a>
                {/if}
                
                {if $smarty.foreach.nextphotolist.first}
                	{assign var=nextid value=$smallphoto->id}
                	
                {/if}
                {/foreach}
                
                <a href="?id={$nextid}"title="Photo #{$nextid}" class="button"><img style="width:25px;height:48px" src="{$currentTemplate}/images/button_next.gif" alt="Next" /></a>
                
			</div>
			
			
		</td>
		<td valign="top">
			<div id="sectionlist">
				<form method="get">
                	
				{$lang.controller.currentsection}: <select name="fsection">
                	{foreach key=sectionvalue item=section from=$sectionList}
						<option value="{$sectionvalue}" {if $currentSection == $sectionvalue}selected="selected"{/if}>{$section}</option>
                    {/foreach}
				</select>
				<input type="submit" value="{$lang.controller.changesection}" />
				</form>
			</div>
			
			<div id="photostat">
				{$lang.controller.photomarked}: <span class="photomarked">{$totalMarkedPhoto}</span>/<span class="photototal">{$totalPhoto}</span> (<a href="{$conf.rooturl}judge.html" title="Go to un-marked photo">{$lang.controller.photoremain} <span class="photoremain">{$remainPhoto}</span></a>)
			</div>
			
            {include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
            
			<div id="judgestat">
            	<h2>{$myRound->name}:{if $me->groupid == $smarty.const.GROUPID_ADMIN} (Total Score: {$totalPoint}){/if}</h2>
                {foreach item=judger from=$judgerList}
					<div class="judgeitem{if $judger->uid == $me->id} judgecurrent{/if}">{$lang.controller.judgerLabel} {counter} 
                	{if $judger->uid == $me->id}({$lang.controller.you}){/if}
					{if $markJudgerList|is_array}
                    {if in_array($judger->uid, $markJudgerList)}
                    	<img src="{$currentTemplate}/images/tick_circle.png" alt="OK" />
                    {else}
                    	<img src="{$currentTemplate}/images/cross_circle.png" alt="NO" />
                    {/if}
					{/if}
                    </div>
                {/foreach}
				
				<div style="clear:both"></div>
			</div>
            
			<form method="post" action="{$conf.rooturl}judge.html?id={$currentPhoto->id}">
            <input type="hidden" name="ftoken" value="{$smarty.session.addPointToken}"  />
			<div id="pointform">
				<h2>{$lang.controller.yourscore}: </h2>
				
					<input type="hidden" name="fid" value="1" />
                    <div style="float: left;
margin-top: 10px;
margin-right: 8px;">
					<label {if $currentJudgerPoint->point == 1}class="selected"{/if}><input type="radio" name="fpoint" value="1" {if $currentJudgerPoint->point == 1}checked="checked"{/if} /> 1</label>
					<label {if $currentJudgerPoint->point == 2}class="selected"{/if}><input type="radio" name="fpoint" value="2" {if $currentJudgerPoint->point == 2}checked="checked"{/if} /> 2</label>
					<label {if $currentJudgerPoint->point == 3}class="selected"{/if}><input type="radio" name="fpoint" value="3" {if $currentJudgerPoint->point == 3}checked="checked"{/if} /> 3</label>
					<label {if $currentJudgerPoint->point == 4}class="selected"{/if}><input type="radio" name="fpoint" value="4" {if $currentJudgerPoint->point == 4}checked="checked"{/if} /> 4</label>
					<label {if $currentJudgerPoint->point == 5}class="selected"{/if}><input type="radio" name="fpoint" value="5" {if $currentJudgerPoint->point == 5}checked="checked"{/if} /> 5</label>
                    </div>
                    <div style="text-align:left;">
					<input type="submit" name="fsubmit" value=" {$lang.controller.oksubmit} " class="submit" />
                    
                    </div>
				</form>
			</div>
            
            {if $awardList|@count > 0}
            <div id="awardbox">
            	{$lang.controller.selectaward}: <select name="faward">
                	<option value="">- - Ranking - -</option>
                    {foreach item=award from=$awardList}
                    	<option value="{$award->id}" {if $formData.faward == $award->id}selected="selected"{/if}>{$award->name}</option>
                    {/foreach}
                </select>
                <input type="submit" name="fsubmitaward" value="{$lang.controller.saveawardbtn}" />
                {if $myPhotoAwards|@count > 0}
                	<hr />
                    <p>
                    	<strong>{$lang.controller.myawardlist} :</strong><br />
                        <ul>
                        {foreach item=myaward from=$myPhotoAwards}
                        	<li><a href="{$conf.rooturl}judge.html?id={$currentPhoto->id}&amp;delaward={$myaward->id}" title="{$lang.controller.deleteaward}"><img src="{$currentTemplate}/images/cross_circle.png" alt="delete" border="0" /></a> <span>{$myaward->award->name}</span></li>
                        {/foreach}
                        </ul>
                    </p>
                {/if}
            </div>
            {/if}
            
			<br /><br /><br />
			<div id="setting" style="text-align:right;">
				<div style="text-align:right; font-size:11px;"><a  class="link-footer" href="javascript:void(0)" onclick="$('#setting-path').slideToggle()">{$lang.controller.photosetting}</a></div>
                <div id="setting-path" style="display:none">
                    <label><input onchange="checkImagePath()" type="radio" name="fpathversion" id="fpathversion" value="online" {if $formData.fpathversion == 'online' OR $formData.fsubmit == ''}checked="checked"{/if} /> ONLINE (http://...)</label>
                    <input type="hidden" name="fprefixonline" id="fprefixonline" value="{$conf.rooturl}{$setting.contestphoto.imageDirectory}" />
                    <br />
                    <label><input onchange="checkImagePath()" type="radio" name="fpathversion" id="fpathversion" value="offline" {if $formData.fpathversion == 'offline'}checked="checked"{/if} /> OFFLINE</label>
                    <input class="path" type="text" name="fprefixoffline" id="fprefixoffline" value="C://Photo" />
                  </div>
			</div>
			</form>
		</td>
	</tr>
</table>

<script type="text/javascript">
	//check path of image
	var currentTemplate = "{$currentTemplate}";
	{literal}
	function checkImagePath()
	{
		//clear current image src
		$('#photonav .thumb').each(function(){$(this).attr('src', currentTemplate + '/images/site/blank.gif');});
		$('#photo #bigphoto').attr('src', currentTemplate + '/images/site/blank.gif');
		$('#photo #originalphoto').attr('href', '#');
		
		var type = $("input[name='fpathversion']:checked").val();
		var prefix = '';
		if(type == 'offline')
		{
			prefix = $("#fprefixoffline").val();	
		}
		else
		{
			prefix = $("#fprefixonline").val();	
		}
		
		
		
		//change thumb src
		$('#photonav .thumb').each(function(){$(this).attr('src', prefix + $(this).attr('alt'));});
		$('#photo #bigphoto').attr('src', prefix + $('#photo #bigphoto').attr('alt'));
		$('#photo #originalphoto').attr('href', prefix + $('#photo #originalphoto').attr('rel'));
	}
	{/literal}
	checkImagePath();

</script>
</div>
</body>
</html>




