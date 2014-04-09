
function cOnNavi(td){
  if(document.getElementById||(document.all && !(document.getElementById))){
    td.style.backgroundColor="#E7E7E7";
  }
}

function cOutNavi(td){ 
  if(document.getElementById||(document.all && !(document.getElementById))){
    td.style.backgroundColor="#C2E7D8";
  }
}

// alle checkboxen markieren
function mark(check,praefix) { //Alle Elemente, die mit praefix beginnen werden auf check gesetzt.
    var fields = document.forms["list"].elements;
    for(i=0;i<fields.length;i++) {
            var field = fields[i];
            if((field.name.substr(0,praefix.length) == praefix) && (field.type == 'checkbox')) {
                    field.checked = check;
            }
    }
}

function unmark(check,praefix) { //Alle Elemente, die mit praefix beginnen werden auf check gesetzt.
    var fields = document.forms["list"].elements;
    for(i=0;i<fields.length;i++) {
            var field = fields[i];
            if((field.name.substr(0,praefix.length) == praefix) && (field.type == 'checkbox')) {
                    field.checked = false;
            }
    }
}


function test(feld,praefix) { //Das Feld feld ist genau dann geckeckt, wenn ale Elemente, die mit praefix beginnen, gechekt sind.
    var allchecked = true;
    var fields = document.forms["list"].elements;
    for(i=0;i<fields.length;i++) {
            var field = fields[i];
            if((field.name.substr(0,praefix.length) == praefix) && (field.type == 'checkbox')) {
                    if(!field.checked) {
                            allchecked = false;
                    }
            }
    }
    document.getElementById(zeile).checked = allchecked;
}

// ----------



