<?php /* Smarty version 2.6.26, created on 2014-11-04 17:11:20
         compiled from _controller/site/index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sidebar_news', '_controller/site/index/index.tpl', 67, false),array('modifier', 'lower', '_controller/site/index/index.tpl', 131, false),)), $this); ?>
        <div id="panelleft">
            <div class="infomation">
                <label><?php echo $this->_tpl_vars['lang']['controller']['wellcomeTitle']; ?>
</label>
                <br />
                <?php echo $this->_tpl_vars['lang']['controller']['wellcomeAbout']; ?>
    
            </div>
            
            <div class="photobox">
                <div class="photosection">
                    <div class="title-color">
                        <a href="http://giadinhphotocontest.com/register.html"><?php echo $this->_tpl_vars['lang']['controller']['colorHead']; ?>
</a>
                    </div>
                    
                    <div class="content-color">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="<?php echo $this->_tpl_vars['setting']['extra']['staticserver']['en']; ?>
default/images/img_color.jpg" alt=""></a>
                    </div>
                </div>
                
                <div class="photosection">
                    <div class="title-nature">
                        <a href="http://giadinhphotocontest.com/register.html"><?php echo $this->_tpl_vars['lang']['controller']['natureHead']; ?>
</a>       
                    </div>
                    
                    <div class="content-nature">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="<?php echo $this->_tpl_vars['setting']['extra']['staticserver']['en']; ?>
default/images/img_nature.jpg" alt="">    </a>
                    </div>
                </div>
                
                <div class="photosection">
                    <div class="title-mono">
                        <a href="http://giadinhphotocontest.com/register.html"><?php echo $this->_tpl_vars['lang']['controller']['monoHead']; ?>
</a>    
                    </div>
                    
                    <div class="content-mono">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="<?php echo $this->_tpl_vars['setting']['extra']['staticserver']['en']; ?>
default/images/img_monochrome.jpg" alt=""></a>
                    </div>
                </div>
                
                <div class="photosection">
                    <div class="title-travel">
                        <a href="http://giadinhphotocontest.com/register.html"><?php echo $this->_tpl_vars['lang']['controller']['travelHead']; ?>
</a>    
                    </div>
                    
                    <div class="content-travel">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="<?php echo $this->_tpl_vars['setting']['extra']['staticserver']['en']; ?>
default/images/img_travel.jpg" alt=""></a>
                    </div>
                </div>
            </div>
			<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5400085651509b94"></script>
        </div>
		<div id="panelright">
			<div id="timebox">
                <!--
                <?php if ($this->_tpl_vars['setting']['extra']['enableNews'] == TRUE): ?>
               			<div class="btnreg_upload">
                            <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
register.html"><?php echo $this->_tpl_vars['lang']['controller']['btnuploadreg']; ?>
</a>
                        </div>
				
                <div class="bannerRight">
                    <img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/img_paypal.gif" alt="">
                </div> -->
                <div id="sidebar-news">
                    <div class="head"><img src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/greybox-logo.png" alt="" /> <?php echo $this->_tpl_vars['lang']['controllergroup']['aboutThisContest']; ?>
</div>
                    <div class="body">            
                        <div class="detail"><?php echo smarty_function_sidebar_news(array(), $this);?>
</div>
                    </div>
                </div>
            <div>
            <img src="http://giadinhphotocontest.com/uploads/sifs.jpg" alt="SIFS">

            </div>
                
                <?php endif; ?>
                				
                <div class="left">
					<div class="text">YEAR 2014<br /><?php echo $this->_tpl_vars['lang']['controller']['countdownHeadLabel']; ?>
: <?php echo $this->_tpl_vars['setting']['extra']['countdownDate']; ?>
</div>
					<div id="countdowntimer"></div>
                    <hr style="color:#E6E6FA;width:150px; margin: 10px 0px 0px 50px";/>
				</div>
                
				<div class="mid mid1">
					<div class="head"><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxEvent']; ?>
</div>
					<ul>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxClosingDate']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxJudging']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxNotification']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxExhibitionDate']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxCatalogue']; ?>
</li>
					</ul>
                    
				</div>
                 
				<div class="mid mid2">
					<div class="head"><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxDate']; ?>
</div>
					<ul>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxClosingDateValue']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxJudgingValue']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxNotificationValue']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxExhibitionDateValue']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxCatalogueValue']; ?>
</li>
					</ul>
				</div>
                
                
				<div class="right">
                    <hr style="color:#E6E6FA;width:150px; margin: 10px 0px 0px 50px";/>
					<div class="head"><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxStatistic']; ?>
</div>
					<div class="subhead"><?php echo $this->_tpl_vars['onlineVisitor']; ?>
 <?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxStatisticText']; ?>
</div>
					<ul>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxRegisteredUser']; ?>
: <?php echo $this->_tpl_vars['siteTotalUsers']; ?>
</li>
                        <li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxOfPhotoOnline']; ?>
: <?php echo $this->_tpl_vars['siteTotalPhotos']; ?>
</li>
						<li><?php echo $this->_tpl_vars['lang']['controllergroup']['rightboxOfCountry']; ?>
: <?php echo $this->_tpl_vars['countCountry']; ?>
</li>
											</ul>
				</div>
 
			</div><!-- end #hometimebox -->
            

		</div><!-- end #panelright -->
		
		
	<?php echo '	
		<script type="text/javascript">
	$(document).ready(function() {
	
		//$("#time").countdown({date:"may 1, 2012"});
		
		$("#countdowntimer").countdown({date:"'; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['jsCountdown'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
<?php echo '",
										htmlTemplate: \'<div class="counter-day">%{d}<span>'; ?>
<?php echo $this->_tpl_vars['lang']['controller']['countDay']; ?>
<?php echo '</span></div><div class="counter-time">%{h} <span class="small">'; ?>
<?php echo $this->_tpl_vars['lang']['controller']['countHour']; ?>
<?php echo '</span> %{m} <span class="small">'; ?>
<?php echo $this->_tpl_vars['lang']['controller']['countMinute']; ?>
<?php echo '</span> %{s} <span class="small">'; ?>
<?php echo $this->_tpl_vars['lang']['controller']['countSecond']; ?>
<?php echo '</span></div>\',
										});
	
		//$("#time").countdown({date:"april 15, 2011"});
	});
</script>
'; ?>
