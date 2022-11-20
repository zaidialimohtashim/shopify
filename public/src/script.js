var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js");
xmlhttp.onreadystatechange = function(){
	if ((xmlhttp.status == 200) && (xmlhttp.readyState == 4))
	{
		eval(xmlhttp.responseText);
		
        //Use JQuery here
        console.log(meta);
        // if(jQuery(".shopify-payment-button__button").length > 0){
        //    jQuery('<a href="#" style="display: block; width: 100%; padding: 10px; text-align: center; text-decoration: none; color: #fff; background: #0091ff; margin: 8px 0px 8px 0px;" class="customizable_product">Customizable</a>').insertAfter("button.shopify-payment-button__button");
        // }

	}
}
xmlhttp.send();

