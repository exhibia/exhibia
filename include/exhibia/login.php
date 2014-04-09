<style>
.single #column-left {
  float: left;
  width: 1000px;
  margin: 50px 10px 0 0;
}
#column-right {
width: 280px!important;
margin:0 0 50px 0;
}
#container {

}
</style>
        <div id="main">
            <?php include("header.php"); ?>
            <div id="container" style="width:100%;">
               
                   <div id="column-left" style="width:1000px;float:left;">
                   
			    <?php if(file_exists("include/$template/login.php")){
			    
				include("include/$template/login/index.php");
				
				}else{
				
				include("include/login/index.php");
				
				}
			    ?>
		    </div>
		    <div id="column-right" style="float:right;">
			<?php include("$BASE_DIR/include/$template/column-right.php"); ?>
		    </div>
                
		<?php include("footer.php"); ?>
		</div>
           </div>