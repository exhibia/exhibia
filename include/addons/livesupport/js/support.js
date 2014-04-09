$(document).ready(function(){
       // Cufon.replace('#status_box a,h3,h2,h1');
        $("#chat-list li").click(function(){
        window.location=$(this).find("a").attr("href"); return false;
});
});

