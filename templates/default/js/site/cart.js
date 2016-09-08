// JavaScript Document
function fetchRegion(section)
{
	//get country
	var country = $("#f"+section+"country").val();
	$("#f"+section+"region").hide();
	$("#"+section+"regionlabel").hide();
	$("#f"+section+"countryother").hide();
	$("#"+section+"citylabel").hide();
	$("#f"+section+"region").hide();

	if(country != "0" && country.length > 0)
	{
		//Begin using AJAX to create selected manufacturer
		$("#f"+section+"region_indicator").html(loadingIndicator);
	
		
		$.ajax({
				url: requestRegionUrl,
				type: 'POST',
				dataType: 'xml',
				data: 'country=' + country,
				error: function(){
					alert('Error loading XML document');
					$("#f"+section+"region_indicator").html('');
				},
				success: function(xml){
					var success = $(xml).find('success').text();
					var message = $(xml).find('message').text();
					
					//finish all task with ajax success
					$("#f"+section+"region_indicator").html('');
						
					if(success == "1")
					{
						
						//update region list
						var htmldata = '';
						var selectedRegion = $("#f"+section+"regionhidden").html();
						$(xml).find('listitem').each(function(){
															  myText = $(this).text();
															  myId = $(this).attr('id');
															 
															  selectedStr = '';
															  if(myId == selectedRegion)
																selectedStr = ' selected="selected" ';
																
															  htmldata += '<option value="'+myId+'" '+selectedStr+'>'+myText+'</option>';
															  
															  });
						
						if(htmldata.length > 0)
						{
							$("#f"+section+"region").html(htmldata).show();
							$("#"+section+"regionlabel").show();
						}
						
						
					}
					else
						alert(message);
						
					//fetch city of this region
					fetchCity(section);
					
				}
			});
	}
	else
	{
		if(country == "0")
		{
			$("#f"+section+"countryother").show();
		}
	}
}

function fetchCity(section)
{
	if(enableLocationCity == "0")
		return;
	   
	//get country
	var region = $("#f"+section+"region").val();
	$("#f"+section+"city").hide();
	$("#"+section+"citylabel").hide();

	if(region != "0" && region.length > 0)
	{
		//Begin using AJAX to create selected manufacturer
		$("#f"+section+"city_indicator").html(loadingIndicator);
	
		
		$.ajax({
				url: requestCityUrl,
				type: 'POST',
				dataType: 'xml',
				data: 'region=' + region,
				error: function(){
					alert('Error loading XML document');
					$("#f"+section+"city_indicator").html('');
				},
				success: function(xml){
					var success = $(xml).find('success').text();
					var message = $(xml).find('message').text();
					
					//finish all task with ajax success
					$("#f"+section+"city_indicator").html('');
						
					if(success == "1")
					{
						
						//update region list
						var htmldata = '';
						var selectedCity = $("#f"+section+"cityhidden").html();
						$(xml).find('listitem').each(function(){
															  var myText = $(this).text();
															  var myId = $(this).attr('id');
															 
															  var selectedStr = '';
															  if(myId == selectedCity)
																selectedStr = ' selected="selected" ';
																
															  htmldata += '<option value="'+myId+'" '+selectedStr+'>'+myText+'</option>';
															  
															  });
						
						if(htmldata.length > 0)
						{
							$("#f"+section+"city").html(htmldata).show();
							$("#"+section+"citylabel").show();
						}						
						
					}
					
					
				}
			});
	}
}

function clearbillingform()
{
	if(confirm('Are you sure ?'))
	{
		window.location.href=clearBillingAddress;
	}
}

	
function checkBillingShippingSame()
{
	if($("#fbillingshippingsame").attr("checked"))
	{
		$("#shippingInformation").hide();
	}
	else
	{
		$("#shippingInformation").show();
	}
			
}