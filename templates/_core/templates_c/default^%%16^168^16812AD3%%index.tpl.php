<?php /* Smarty version 2.6.26, created on 2014-11-01 08:50:53
         compiled from _controller/site/judge/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', '_controller/site/judge/index.tpl', 7, false),array('modifier', 'count', '_controller/site/judge/index.tpl', 140, false),array('function', 'counter', '_controller/site/judge/index.tpl', 104, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['pageTitle'] != ''): ?><?php echo $this->_tpl_vars['pageTitle']; ?>
<?php else: ?><?php echo $this->_tpl_vars['setting']['site']['defaultPageTitle']; ?>
<?php endif; ?></title>
<meta name="author" content="iMSVietnam, support@imsvietnam.com" />
<meta name="keywords" content="<?php echo ((is_array($_tmp=@$this->_tpl_vars['pageKeyword'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['setting']['site']['defaultPageKeyword']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['setting']['site']['defaultPageKeyword'])); ?>
" />
<meta name="description" content="<?php echo ((is_array($_tmp=@$this->_tpl_vars['pageDescription'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['setting']['site']['defaultPageDescription']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['setting']['site']['defaultPageDescription'])); ?>
" />
<meta name="robots" content="index,follow" />
<link href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/judge.css" rel="stylesheet" type="text/css" media="screen,print" />
<script language="JavaScript" type="text/javascript" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/js/jquery-1.3.2.js"></script>



</head>
<body>


<div id="header">
    <div id="header-main" style="max-width: 1280px; margin: 0 auto;">
	<div id="headerleft">
    	<strong><big><?php echo $this->_tpl_vars['currentPhoto']->name; ?>
<?php if ($this->_tpl_vars['currentPhoto']->section == 'landscape-c'): ?> [Best Portrait]<?php elseif ($this->_tpl_vars['currentPhoto']->section == 'sport-c'): ?> [Best Action]<?php elseif ($this->_tpl_vars['currentPhoto']->section == 'idea-c'): ?> [Best Idea]<?php elseif ($this->_tpl_vars['currentPhoto']->section == 'landscape-m'): ?>[Best Portrait]<?php elseif ($this->_tpl_vars['currentPhoto']->section == 'sport-m'): ?> [Best Action]<?php elseif ($this->_tpl_vars['currentPhoto']->section == 'idea-m'): ?> [Best Idea]<?php endif; ?> - Photo ID #<?php echo $this->_tpl_vars['currentPhoto']->id; ?>
</big></strong>
    </div>
	
	<div id="headerright">
    	<strong><big><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
</big></strong> &lt; <a style="color: yellow;" href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html" title=""><?php echo $this->_tpl_vars['me']->username; ?>
</a> - <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
logout.html" title="Logout"><?php echo $this->_tpl_vars['lang']['controller']['logout']; ?>
</a> &gt;
	</div>
    </div>
</div>
<div style=" max-width: 1280px; margin: 0 auto;">
<table width="100%" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
	<tr style="background: #fff;">
		<td width="800" style="background:#fff;padding:10px;" valign="top">
			
			
			
			
			<div id="photo" style="width:640px; text-align:center;">
                <?php if ($this->_tpl_vars['currentPhoto']->fileserver == vn): ?>
                    <a id="originalphoto" href="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filepath; ?>
" rel="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filepath; ?>
" target="_blank" title="Click to view Fullsize"><img id="bigphoto" src="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filethumb1; ?>
" border="0" alt="<?php echo $this->_tpl_vars['currentPhoto']->filethumb1; ?>
" /></a>
                <?php else: ?>
                    <a id="originalphoto" href="<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filepath; ?>
" rel="<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filepath; ?>
" target="_blank" title="Click to view Fullsize"><img id="bigphoto" src="<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filethumb1; ?>
" border="0" alt="<?php echo $this->_tpl_vars['currentPhoto']->filethumb1; ?>
" /></a>
                <?php endif; ?>
            </div>
			
            <div id="photonav">
            	<a href="?id=<?php echo $this->_tpl_vars['prevId']; ?>
"title="Photo #<?php echo $this->_tpl_vars['prevId']; ?>
" class="button"><img style="width:25px;height:48px" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/button_prev.gif" alt="Previous" /></a>
                
				<?php $_from = $this->_tpl_vars['prevPhotoList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prevphotolist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prevphotolist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['smallphoto']):
        $this->_foreach['prevphotolist']['iteration']++;
?>
				<?php if ($this->_tpl_vars['smallphoto']->fileserver == vn): ?>
                    <a href="?id=<?php echo $this->_tpl_vars['smallphoto']->id; ?>
" title="Photo #<?php echo $this->_tpl_vars['smallphoto']->id; ?>
"><img class="thumb" src="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" alt="<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" /></a>
                <?php else: ?>
                    <a href="?id=<?php echo $this->_tpl_vars['smallphoto']->id; ?>
" title="Photo #<?php echo $this->_tpl_vars['smallphoto']->id; ?>
"><img class="thumb" src="<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" alt="<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" /></a>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
				
                <?php if ($this->_tpl_vars['currentPhoto']->fileserver == vn): ?>
                    <a href="#" class="current"><img class="thumb" src="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filethumb2; ?>
" alt="<?php echo $this->_tpl_vars['currentPhoto']->filethumb2; ?>
" /></a>
                <?php else: ?>
                    <a href="#" class="current"><img class="thumb" src="<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['currentPhoto']->filethumb2; ?>
" alt="<?php echo $this->_tpl_vars['currentPhoto']->filethumb2; ?>
" /></a>
                <?php endif; ?>
                
                <?php $_from = $this->_tpl_vars['nextPhotoList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nextphotolist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nextphotolist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['smallphoto']):
        $this->_foreach['nextphotolist']['iteration']++;
?>
				<?php if ($this->_tpl_vars['smallphoto']->fileserver == vn): ?>
                    <a href="?id=<?php echo $this->_tpl_vars['smallphoto']->id; ?>
" title="Photo #<?php echo $this->_tpl_vars['smallphoto']->id; ?>
"><img class="thumb" src="<?php echo $this->_tpl_vars['setting']['extra']['imageDirectoryRemoteServer']['vn']; ?>
<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" alt="<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" /></a>
                <?php else: ?>
                    <a href="?id=<?php echo $this->_tpl_vars['smallphoto']->id; ?>
" title="Photo #<?php echo $this->_tpl_vars['smallphoto']->id; ?>
"><img class="thumb" src="<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" alt="<?php echo $this->_tpl_vars['smallphoto']->filethumb2; ?>
" /></a>
                <?php endif; ?>
                
                <?php if (($this->_foreach['nextphotolist']['iteration'] <= 1)): ?>
                	<?php $this->assign('nextid', $this->_tpl_vars['smallphoto']->id); ?>
                	
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                
                <a href="?id=<?php echo $this->_tpl_vars['nextid']; ?>
"title="Photo #<?php echo $this->_tpl_vars['nextid']; ?>
" class="button"><img style="width:25px;height:48px" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/button_next.gif" alt="Next" /></a>
                
			</div>
			
			
		</td>
		<td valign="top">
			<div id="sectionlist">
				<form method="get">
                	
				<?php echo $this->_tpl_vars['lang']['controller']['currentsection']; ?>
: <select name="fsection">
                	<?php $_from = $this->_tpl_vars['sectionList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sectionvalue'] => $this->_tpl_vars['section']):
?>
						<option value="<?php echo $this->_tpl_vars['sectionvalue']; ?>
" <?php if ($this->_tpl_vars['currentSection'] == $this->_tpl_vars['sectionvalue']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['section']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
				</select>
				<input type="submit" value="<?php echo $this->_tpl_vars['lang']['controller']['changesection']; ?>
" />
				</form>
			</div>
			
			<div id="photostat">
				<?php echo $this->_tpl_vars['lang']['controller']['photomarked']; ?>
: <span class="photomarked"><?php echo $this->_tpl_vars['totalMarkedPhoto']; ?>
</span>/<span class="photototal"><?php echo $this->_tpl_vars['totalPhoto']; ?>
</span> (<a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
judge.html" title="Go to un-marked photo"><?php echo $this->_tpl_vars['lang']['controller']['photoremain']; ?>
 <span class="photoremain"><?php echo $this->_tpl_vars['remainPhoto']; ?>
</span></a>)
			</div>
			
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            
			<div id="judgestat">
            	<h2><?php echo $this->_tpl_vars['myRound']->name; ?>
:<?php if ($this->_tpl_vars['me']->groupid == @GROUPID_ADMIN): ?> (Total Score: <?php echo $this->_tpl_vars['totalPoint']; ?>
)<?php endif; ?></h2>
                <?php $_from = $this->_tpl_vars['judgerList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['judger']):
?>
					<div class="judgeitem<?php if ($this->_tpl_vars['judger']->uid == $this->_tpl_vars['me']->id): ?> judgecurrent<?php endif; ?>"><?php echo $this->_tpl_vars['lang']['controller']['judgerLabel']; ?>
 <?php echo smarty_function_counter(array(), $this);?>
 
                	<?php if ($this->_tpl_vars['judger']->uid == $this->_tpl_vars['me']->id): ?>(<?php echo $this->_tpl_vars['lang']['controller']['you']; ?>
)<?php endif; ?>
                    <?php if (in_array ( $this->_tpl_vars['judger']->uid , $this->_tpl_vars['markJudgerList'] )): ?>
                    	<img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/tick_circle.png" alt="OK" />
                    <?php else: ?>
                    	<img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/cross_circle.png" alt="NO" />
                    <?php endif; ?>
                    
                    </div>
                <?php endforeach; endif; unset($_from); ?>
				
				<div style="clear:both"></div>
			</div>
            
			<form method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
judge.html?id=<?php echo $this->_tpl_vars['currentPhoto']->id; ?>
">
            <input type="hidden" name="ftoken" value="<?php echo $_SESSION['addPointToken']; ?>
"  />
			<div id="pointform">
				<h2><?php echo $this->_tpl_vars['lang']['controller']['yourscore']; ?>
: </h2>
				
					<input type="hidden" name="fid" value="1" />
                    <div style="float: left;
margin-top: 10px;
margin-right: 8px;">
					<label <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 1): ?>class="selected"<?php endif; ?>><input type="radio" name="fpoint" value="1" <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 1): ?>checked="checked"<?php endif; ?> /> 1</label>
					<label <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 2): ?>class="selected"<?php endif; ?>><input type="radio" name="fpoint" value="2" <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 2): ?>checked="checked"<?php endif; ?> /> 2</label>
					<label <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 3): ?>class="selected"<?php endif; ?>><input type="radio" name="fpoint" value="3" <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 3): ?>checked="checked"<?php endif; ?> /> 3</label>
					<label <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 4): ?>class="selected"<?php endif; ?>><input type="radio" name="fpoint" value="4" <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 4): ?>checked="checked"<?php endif; ?> /> 4</label>
					<label <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 5): ?>class="selected"<?php endif; ?>><input type="radio" name="fpoint" value="5" <?php if ($this->_tpl_vars['currentJudgerPoint']->point == 5): ?>checked="checked"<?php endif; ?> /> 5</label>
                    </div>
                    <div style="text-align:left;">
					<input type="submit" name="fsubmit" value=" <?php echo $this->_tpl_vars['lang']['controller']['oksubmit']; ?>
 " class="submit" />
                    
                    </div>
				</form>
			</div>
            
            <?php if (count($this->_tpl_vars['awardList']) > 0): ?>
            <div id="awardbox">
            	<?php echo $this->_tpl_vars['lang']['controller']['selectaward']; ?>
: <select name="faward">
                	<option value="">- - Ranking - -</option>
                    <?php $_from = $this->_tpl_vars['awardList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['award']):
?>
                    	<option value="<?php echo $this->_tpl_vars['award']->id; ?>
" <?php if ($this->_tpl_vars['formData']['faward'] == $this->_tpl_vars['award']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['award']->name; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
                <input type="submit" name="fsubmitaward" value="<?php echo $this->_tpl_vars['lang']['controller']['saveawardbtn']; ?>
" />
                <?php if (count($this->_tpl_vars['myPhotoAwards']) > 0): ?>
                	<hr />
                    <p>
                    	<strong><?php echo $this->_tpl_vars['lang']['controller']['myawardlist']; ?>
 :</strong><br />
                        <ul>
                        <?php $_from = $this->_tpl_vars['myPhotoAwards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myaward']):
?>
                        	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
judge.html?id=<?php echo $this->_tpl_vars['currentPhoto']->id; ?>
&amp;delaward=<?php echo $this->_tpl_vars['myaward']->id; ?>
" title="<?php echo $this->_tpl_vars['lang']['controller']['deleteaward']; ?>
"><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/cross_circle.png" alt="delete" border="0" /></a> <span><?php echo $this->_tpl_vars['myaward']->award->name; ?>
</span></li>
                        <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
			<br /><br /><br />
			<div id="setting" style="text-align:right;">
				<div style="text-align:right; font-size:11px;"><a  class="link-footer" href="javascript:void(0)" onclick="$('#setting-path').slideToggle()"><?php echo $this->_tpl_vars['lang']['controller']['photosetting']; ?>
</a></div>
                <div id="setting-path" style="display:none">
                    <label><input onchange="checkImagePath()" type="radio" name="fpathversion" id="fpathversion" value="online" <?php if ($this->_tpl_vars['formData']['fpathversion'] == 'online' || $this->_tpl_vars['formData']['fsubmit'] == ''): ?>checked="checked"<?php endif; ?> /> ONLINE (http://...)</label>
                    <input type="hidden" name="fprefixonline" id="fprefixonline" value="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
" />
                    <br />
                    <label><input onchange="checkImagePath()" type="radio" name="fpathversion" id="fpathversion" value="offline" <?php if ($this->_tpl_vars['formData']['fpathversion'] == 'offline'): ?>checked="checked"<?php endif; ?> /> OFFLINE</label>
                    <input class="path" type="text" name="fprefixoffline" id="fprefixoffline" value="C://Photo" />
                  </div>
			</div>
			</form>
		</td>
	</tr>
</table>

<script type="text/javascript">
	//check path of image
	var currentTemplate = "<?php echo $this->_tpl_vars['currentTemplate']; ?>
";
	<?php echo '
	function checkImagePath()
	{
		//clear current image src
		$(\'#photonav .thumb\').each(function(){$(this).attr(\'src\', currentTemplate + \'/images/site/blank.gif\');});
		$(\'#photo #bigphoto\').attr(\'src\', currentTemplate + \'/images/site/blank.gif\');
		$(\'#photo #originalphoto\').attr(\'href\', \'#\');
		
		var type = $("input[name=\'fpathversion\']:checked").val();
		var prefix = \'\';
		if(type == \'offline\')
		{
			prefix = $("#fprefixoffline").val();	
		}
		else
		{
			prefix = $("#fprefixonline").val();	
		}
		
		
		
		//change thumb src
		$(\'#photonav .thumb\').each(function(){$(this).attr(\'src\', prefix + $(this).attr(\'alt\'));});
		$(\'#photo #bigphoto\').attr(\'src\', prefix + $(\'#photo #bigphoto\').attr(\'alt\'));
		$(\'#photo #originalphoto\').attr(\'href\', prefix + $(\'#photo #originalphoto\').attr(\'rel\'));
	}
	'; ?>

	checkImagePath();

</script>
</div>
</body>
</html>



