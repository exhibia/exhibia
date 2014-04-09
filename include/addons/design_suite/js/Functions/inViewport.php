function inViewport (el) {

    var r, html;
    if ( !el || 1 !== el.nodeType ) { return false; }
    html = document.documentElement;
    r = el.getBoundingClientRect();

    return ( !!r 
      && r.bottom >= 0 
      && r.right >= 0 
      && r.top <= html.clientHeight 
      && r.left <= html.clientWidth 
    );

}