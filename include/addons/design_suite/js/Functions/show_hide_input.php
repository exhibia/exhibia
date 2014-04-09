function show_hide_input(operator, inputId){
val = document.getElementById(operator).options[document.getElementById(operator).selectedIndex].value;

      switch(val){
      
	  case('!isset'):
	      document.getElementById(inputId).style.display = 'none';
	  break;
	  case('isset'):
	      document.getElementById(inputId).style.display = 'none';
	  break;
	  case('empty'):
	      document.getElementById(inputId).style.display = 'none';
	  break;
	  case('!empty'):
	      document.getElementById(inputId).style.display = 'none';
	  break;
	  case('in_array'):
	      document.getElementById(inputId).style.display = 'none';
	  break;
	  case('!in_array'):
	      document.getElementById(inputId).style.display = 'none';
	  break;
	  default:
	      document.getElementById(inputId).style.display = 'block';
	      document.getElementById(inputId).style.float = 'left';
      
      }


}