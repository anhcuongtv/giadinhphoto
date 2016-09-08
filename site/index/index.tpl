{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
        <div id="panelleft">
            <div class="infomation">
                <label>{$lang.controller.wellcomeTitle}</label>
                <br />
                {$lang.controller.wellcomeAbout}    
            </div>
            
            <div class="photobox">
                <div class="photosection">
                    <div class="title-color">
                        <a href="http://giadinhphotocontest.com/register.html">{$lang.controller.colorHead}</a>
                    </div>
                    
                    <div class="content-color">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="{$setting.extra.staticserver.en}default/images/img_color.jpg" alt=""></a>
                    </div>
                </div>
                
                <div class="photosection">
                    <div class="title-nature">
                        <a href="http://giadinhphotocontest.com/register.html">{$lang.controller.natureHead}</a>       
                    </div>
                    
                    <div class="content-nature">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="{$setting.extra.staticserver.en}default/images/img_nature.jpg" alt="">    </a>
                    </div>
                </div>
                
                <div class="photosection">
                    <div class="title-mono">
                        <a href="http://giadinhphotocontest.com/register.html">{$lang.controller.monoHead}</a>    
                    </div>
                    
                    <div class="content-mono">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="{$setting.extra.staticserver.en}default/images/img_monochrome.jpg" alt=""></a>
                    </div>
                </div>
                
                <div class="photosection">
                    <div class="title-travel">
                        <a href="http://giadinhphotocontest.com/register.html">{$lang.controller.travelHead}</a>    
                    </div>
                    
                    <div class="content-travel">
                        <a href="http://giadinhphotocontest.com/register.html"><img src="{$setting.extra.staticserver.en}default/images/img_travel.jpg" alt=""></a>
                    </div>
                </div>
            </div>
			<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5400085651509b94"></script>
        </div>
		<div id="panelright">
			<div id="timebox">
                <!--
                {if $setting.extra.enableNews == TRUE}
               			<div class="btnreg_upload">
                            <a href="{$conf.rooturl}register.html">{$lang.controller.btnuploadreg}</a>
                        </div>
				
                <div class="bannerRight">
                    <img src="{$staticserver}{$currentTemplate}/images/img_paypal.gif" alt="">
                </div> -->
                <div id="sidebar-news">
                    <div class="head"><img src="{$staticserver}{$currentTemplate}/images/greybox-logo.png" alt="" /> {$lang.controllergroup.aboutThisContest}</div>
                    <div class="body">            
                        <div class="detail">{sidebar_news}</div>
                    </div>
                </div>
            <div>
            <img src="http://giadinhphotocontest.com/uploads/sifs.jpg" alt="SIFS">

            </div>
                
                {/if}
                				
                <div class="left">
					<div class="text">YEAR 2014<br />{$lang.controller.countdownHeadLabel}: {$setting.extra.countdownDate}</div>
					<div id="countdowntimer"></div>
                    <hr style="color:#E6E6FA;width:150px; margin: 10px 0px 0px 50px";/>
				</div>
                
				<div class="mid mid1">
					<div class="head">{$lang.controllergroup.rightboxEvent}</div>
					<ul>
						<li>{$lang.controllergroup.rightboxClosingDate}</li>
						<li>{$lang.controllergroup.rightboxJudging}</li>
						<li>{$lang.controllergroup.rightboxNotification}</li>
						<li>{$lang.controllergroup.rightboxExhibitionDate}</li>
						<li>{$lang.controllergroup.rightboxCatalogue}</li>
					</ul>
                    
				</div>
                 
				<div class="mid mid2">
					<div class="head">{$lang.controllergroup.rightboxDate}</div>
					<ul>
						<li>{$lang.controllergroup.rightboxClosingDateValue}</li>
						<li>{$lang.controllergroup.rightboxJudgingValue}</li>
						<li>{$lang.controllergroup.rightboxNotificationValue}</li>
						<li>{$lang.controllergroup.rightboxExhibitionDateValue}</li>
						<li>{$lang.controllergroup.rightboxCatalogueValue}</li>
					</ul>
				</div>
                
                
				<div class="right">
                    <hr style="color:#E6E6FA;width:150px; margin: 10px 0px 0px 50px";/>
					<div class="head">{$lang.controllergroup.rightboxStatistic}</div>
					<div class="subhead">{$onlineVisitor} {$lang.controllergroup.rightboxStatisticText}</div>
					<ul>
						<li>{$lang.controllergroup.rightboxRegisteredUser}: {$siteTotalUsers}</li>
                        <li>{$lang.controllergroup.rightboxOfPhotoOnline}: {$siteTotalPhotos}</li>
						<li>{$lang.controllergroup.rightboxOfCountry}: {$countCountry}</li>
						{*<li>{$lang.controllergroup.rightboxOfPhotoView}: {$siteTotalViewPhotos}</li>*}
					</ul>
				</div>
 
			</div><!-- end #hometimebox -->
            

		</div><!-- end #panelright -->
		
		
	{literal}	
		<script type="text/javascript">
	$(document).ready(function() {
	
		//$("#time").countdown({date:"may 1, 2012"});
		
		$("#countdowntimer").countdown({date:"{/literal}{$jsCountdown|lower}{literal}",
										htmlTemplate: '<div class="counter-day">%{d}<span>{/literal}{$lang.controller.countDay}{literal}</span></div><div class="counter-time">%{h} <span class="small">{/literal}{$lang.controller.countHour}{literal}</span> %{m} <span class="small">{/literal}{$lang.controller.countMinute}{literal}</span> %{s} <span class="small">{/literal}{$lang.controller.countSecond}{literal}</span></div>',
										});
	
		//$("#time").countdown({date:"april 15, 2011"});
	});
</script>
{/literal}
