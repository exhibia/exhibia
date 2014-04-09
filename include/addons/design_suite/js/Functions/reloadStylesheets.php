function reloadStylesheets() {
 
    $('#master_css').attr('href', '<?php echo $SITE_URL;?>css/styles.php?page=<?php echo $template;?>&template=<?php echo $template;?>&reload=' + new Date().getTime());
   
}

function reloadStylesheets_newTemplate(template) {
 
    $('#master_css').attr('href', '<?php echo $SITE_URL;?>css/styles.php?page=' + template + '&template=' + template + '&reload=' + new Date().getTime());
   
}