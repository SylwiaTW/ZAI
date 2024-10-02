function dataczas()
	{
		var d = new Date();
		
		var godzina = d.getHours();
		if (godzina<10) godzina = "0"+godzina;
		
		var minuta = d.getMinutes();
		if (minuta<10) minuta = "0"+minuta;
		
		var sekunda = d.getSeconds();
		if (sekunda<10) sekunda = "0"+sekunda;
		
		var dzien = d.getDate();
		var miesiac = d.getMonth();
		var rok = d.getFullYear();
		
		switch (miesiac) {
			case 0:
				miesiac = "stycznia";
				break;
			case 1:
				miesiac = "lutego";
				break;
			case 2:
				miesiac = "marca";
				break;
			case 3:
				miesiac = "kwietnia";
				break;
			case 4:
				miesiac = "maja";
				break;
			case 5:
				miesiac = "czerwca";
				break;
			case 6:
				miesiac = "lipca";
				break;
			case 7:
				miesiac = "sierpnia";
				break;
			case 8:
				miesiac = "września";
				break;
			case 9:
				miesiac = "października";
				break;
			case 10:
				miesiac = "listopada";
				break;
			case 11:
				miesiac = "grudnia";
		}

		document.getElementById("zegar").innerHTML = 
		 godzina+":"+minuta+":"+sekunda+", "+dzien+" "+miesiac+" "+rok;
		 setTimeout("dataczas()",1000);
	}