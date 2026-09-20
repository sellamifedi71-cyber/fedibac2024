// JavaScript Document
function verif1()
{s=document.getElementById("s").selectedIndex
 d=document.getElementById("d").value
 t=document.getElementsByName("r")
 p=document.getElementById("p").value
	if(s=1)
		{alert("choix obligatoire")
		return false
		}
  else if(d[0].toUpperCase<"A"&&d[0].toUpperCase>"Z"||d[d.length].toUpperCase<"A"&&d[d.length].toUpperCase>"Z"||d.length<10&&d.length>100)
	 {return false
	  alert("desription incorrect")
	 
	 }
 else if()
}