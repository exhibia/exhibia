function pwd_test_password(passwd) {	
  var intScore   = 0
  var strVerdict = "unsicher"
  var strLog     = ""
		
  // PASSWORD LENGTH
  if (passwd.length<5) {
    intScore = (intScore+3)
  } else if (passwd.length>4 && passwd.length<8) {
    intScore = (intScore+6)
  } else if (passwd.length>7 && passwd.length<16) {
    intScore = (intScore+12)
  } else if (passwd.length>15) {
    intScore = (intScore+18)
  }

  if (passwd.match(/[a-z]/)) {
    intScore = (intScore+1)
  }
		
  if (passwd.match(/[A-Z]/)) {
    intScore = (intScore+5)
  }
		
  if (passwd.match(/\d+/)) {
    intScore = (intScore+5)
  }
		
  if (passwd.match(/(.*[0-9].*[0-9].*[0-9])/)) {
    intScore = (intScore+5)
  }

  if (passwd.match(/.[!,@,#,$,%,^,&,*,?,_,~]/)) {
    intScore = (intScore+5)
  }
		
  if (passwd.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) {
    intScore = (intScore+5)
  }

  if (passwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
    intScore = (intScore+2)
  }

  if (passwd.match(/([a-zA-Z])/) && passwd.match(/([0-9])/)) {
    intScore = (intScore+2)
  }
 
  if (passwd.match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/)) {
    intScore = (intScore+2)
  }

  if(intScore < 16) {
    strVerdict = "Weak";
    strColor = "red";
  } else if (intScore > 10 && intScore < 15) {
    strVerdict = "Weak";
    strColor = "red";
  } else if (intScore > 14 && intScore < 25) {
    strVerdict = "Medium";
    strColor = "#ffd801";
  } else if (intScore > 24 && intScore < 35) {
    strVerdict = "Strong";
    strColor = "orange";
  } else {
    strVerdict = "Very strong";
    strColor = "#3bce08";
  }
	
  ctlBar = document.getElementById("pwd_bar");
  ctlText = document.getElementById("pwd_text");

  nRound = (intScore*2);
  if (nRound > 100) {
    nRound = 100;
  }

  ctlBar.style.width = nRound + "%";
  ctlBar.style.backgroundColor = strColor;
  ctlText.innerHTML = "<span style='color: " + strColor + ";'>" + strVerdict + "</span>";
}
