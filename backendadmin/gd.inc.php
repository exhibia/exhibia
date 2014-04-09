<?php
/*
+--------------------------------------------------------------------------
|   CubeCart v3.1.0 Alpha
|   ========================================
|   by Alistair Brookbanks
|	CubeCart is a registered trade mark of Devellion Limited
|   Copyright Devellion Limited 2006. All rights reserved.
|   Devellion Limited,
|   5 Bridge Street,
|   Bishops Stortford,
|   HERTFORDSHIRE.
|   CM23 2JU
|   UNITED KINGDOM
|   http://www.devellion.com
|	UK Private Limited Company No. 5323904
|   ========================================
|   Web: http://www.cubecart.com
|   Date: Tuesday, 14th March 2006
|   Email: info (at) cubecart (dot) com
|	License Type: CubeCart is NOT Open Source Software and Limitations Apply 
|   Licence Info: http://www.cubecart.com/site/faq/license.php
+--------------------------------------------------------------------------
|	/gd/gd.inc.php
|   ========================================
|	GD Class	
+--------------------------------------------------------------------------
*/
class thumbnail
{
	var $img;
	
	function thumbnail($imgfile="",$width="",$height="")
	{
		global $config;
		$config['gdversion']=2;
		//detect image format
		$this->img["format"]=ereg_replace(".*\.(.*)$","\\1",$imgfile);
		$this->img["format"]=strtoupper($this->img["format"]);

		if($config['gdversion']>0)
		{
		
			if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG")
			{
				//JPEG
				$this->img["format"]="JPEG";
				$this->img["src"] = imagecreatefromjpeg($imgfile);
				
			}
			elseif($this->img["format"]=="PNG")
			{
				//PNG
				$this->img["format"]="PNG";
				$this->img["src"] = imagecreatefrompng($imgfile);
			}
			elseif ($this->img["format"]=="GIF")
			{
				//GIF
				$this->img["format"]="GIF";
				$this->img["src"] = imagecreatefromgif($imgfile);
			}
			else
			{
				//DEFAULT
				echo "Not Supported File!";
				exit();
			}
			
			if($width>0 && $height>0)
			{
			
				$this->img["width"] = $width;
				$this->img["height"] = $height;
			
			}
			else
			{
			
				@$this->img["width"] = imagesx($this->img["src"]);
				@$this->img["height"] = imagesy($this->img["src"]);
			
			}
			
			//default quality jpeg
			$this->img["quality"] = $config['gdquality'];
		
		}
		else
		{
		
			return FALSE;
		
		}
		
	}

	function size_custom($width=100, $height=100)
	{
		// custom
		$this->img["width_thumb"] = $width;
    	$this->img["height_thumb"] = $height;
	}
	
	
	function size_width($size=100)
	{
		// width
		$this->img["width_thumb"]=$size;
    	@$this->img["height_thumb"] = ($this->img["width_thumb"]/$this->img["width"])*$this->img["height"];
	}
	
	function size_height($size=100)
	{
		// height
		$this->img["height_thumb"]=$size;
    	@$this->img["width_thumb"] = ($this->img["height_thumb"]/$this->img["height"])*$this->img["width"];
	}
	
	function size_auto($size=100)
	{
		// size automatically
		if ($this->img["width"]>=$this->img["height"])
		{
    	
			$this->img["width_thumb"]=$size;
    		@$this->img["height_thumb"] = ($this->img["width_thumb"]/$this->img["width"])*$this->img["height"];
		
		}
		else
		{
	    	
			$this->img["height_thumb"]=$size;
    		@$this->img["width_thumb"] = ($this->img["height_thumb"]/$this->img["height"])*$this->img["width"];
 		
		}
	
	}

	function jpeg_quality($quality=80)
	{
		//jpeg quality
		$this->img["quality"]=$quality;
	}
	
	function randImage($rand)
	{

		global $glob;
		
		$bgColor = imagecolorallocate ($this->img["src"], 255, 255, 255);
		$textColor = imagecolorallocate ($this->img["src"], 0, 0, 0);
		$lineColor = imagecolorallocate ($this->img["src"], 215, 215, 215);
		
		// Add  Random polygons
		
		$noise_x = $this->img["width"] - 5;
		$noise_y = $this->img["height"] - 2;
		
		for ($i=0; $i<3; $i++){
			$polyCoords = array(
			   rand(5,$noise_x), rand(5,$noise_y), 
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y),
			   rand(5,$noise_x), rand(5,$noise_y)
			   );
			   
			$randomcolor = imagecolorallocate( $this->img["src"], rand(150,255), rand(150,255),rand(150,255) );
			imagefilledpolygon($this->img["src"], $polyCoords, 6, $randomcolor);
		}
	
		// write the random chars
		$font = imageloadfont($glob['rootDir']."/classes/fonts/anonymous.gdf");
		imagestring($this->img["src"], $font, 3, 0, $rand, $textColor);
		
		// Add Random noise
	   for ($i = 0; $i < 25; $i++)
	   {
	   
		 $rx1 = rand(0,$this->img["width"]);
		 $rx2 = rand(0,$this->img["width"]);
		 $ry1 = rand(0,$this->img["height"]);
		 $ry2 = rand(0,$this->img["height"]);
		 $rcVal = rand(0,255);
		 $rc1 = imagecolorallocate($this->img["src"],rand(0,255),rand(0,255),rand(100,255));
	
		 imageline ($this->img["src"], $rx1, $ry1, $rx2, $ry2, $rc1);
	   }

		
		$this->show(1);
	
	}

	function show($skip=0)
	{
		global $config;
		
		@header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
	   	@header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	   	@header("Cache-Control: no-store, no-cache, must-revalidate");
	   	@header("Cache-Control: post-check=0, pre-check=0", false);
	   	@header("Pragma: no-cache");
		@header("Content-Type: image/".$this->img["format"]);
		
		if($skip==1)
		{
		
			$this->img["des"] = $this->img["src"];
		
		}
		elseif ($config['gdversion']==2)
		{
			$this->img["des"] = imagecreatetruecolor($this->img["width_thumb"],$this->img["height_thumb"]);
			@imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"],$this->img["height_thumb"], $this->img["width"], $this->img["height"]);
    		    
		}
		elseif ($config['gdversion']==1)
		{    
			$this->img["des"] = imagecreate($this->img["width_thumb"],$this->img["height_thumb"]);
			@imagecopyresized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"],$this->img["height_thumb"], $this->img["width"], $this->img["height"]);    
		}
		
		
		if ($config['gdversion']>0)
		{
		
			// fix for base restriction error
			/*
			$fh = fopen($this->img["des"],'w');
			fclose($fh);
			*/
			
			if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG")
			{
				//JPEG
				imagejpeg($this->img["des"],"",$this->img["quality"]);
				
			} 
			elseif($this->img["format"]=="PNG")
			{
				//PNG
				imagepng($this->img["des"]);
				
			}
			elseif($this->img["format"]=="GIF")
			{
				//GIF
				imagegif($this->img["des"]);
			}
			
			imagedestroy($this->img["des"]);
			
		}
		
	}

	function save($save="")
	{
		global $config;
		$config['gdversion']=2;
		
		if ($config['gdversion']==2)
		{
			$this->img["des"] = imagecreatetruecolor($this->img["width_thumb"],$this->img["height_thumb"]);
			@imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		
		} 
		elseif ($config['gdversion']==1)
		{
		
			$this->img["des"] = imagecreate($this->img["width_thumb"],$this->img["height_thumb"]);
			@imagecopyresized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		}
 		
		if ($config['gdversion']>0)
		{
		
			// fix for base restriction error
			/*
			$fh = fopen($this->img["des"],'w');
			fclose($fh);
			*/
		
			if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG")
			{
				//JPEG
				imagejpeg($this->img["des"],$save,$this->img["quality"]);
				
			}
			elseif ($this->img["format"]=="PNG")
			{
				//PNG
				imagepng($this->img["des"],$save);
				
			}
			elseif ($this->img["format"]=="GIF")
			{
				//GIF
				imagegif($this->img["des"],$save);
				
			}
			imagedestroy($this->img["des"]);
			@chmod($this->img["des"], 0644);
			
		}
	
	}

}
?>