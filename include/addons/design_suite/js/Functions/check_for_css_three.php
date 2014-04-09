
function check_for_css_three(cssRule){

  if(cssRule.match(/linear-gradient/)){
     var css = add_gradients_to_css(cssRule);
  
  }
  
  return css;
}