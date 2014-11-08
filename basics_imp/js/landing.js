var i = 0;
var landing = new Array();


function load_image_landing()
{

	landing[0] = "http://localhost/web_developing/artist_place/images/one.jpg";
	landing[1] = "http://localhost/web_developing/artist_place/images/two.jpg";
	landing[2] = "http://localhost/web_developing/artist_place/images/three.jpg";
}

function swap_image_re()
{
	if (landing.length==0)
	{
		load_image_landing();
	}
	document.slide.src=landing[i];
	if (i<landing.length-1)
	{
		i++;
	}
	else
	{
		i=0;
	}
	setTimeout("swap_image_re()",4000);
}
window.onload=load_image_landing;
window.onload=swap_image_re;