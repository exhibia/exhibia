<?php
function cornerImag($obj, $size = 'small'){
$cornerImag = '';

                                    if ($obj['beginner_auction'] == true) {
                                        $cornerImag = 'beginner_auction' . $size . '.png';
                                    } else if ($obj['uniqueauction'] == true) {
                                        $cornerImag = 'lowest' . $size . '.gif';
                                    } else if ($obj['reverseauction'] == true) {
                                        $cornerImag = 'reverse' . $size . '.gif';
                                    } else if ($obj['fixedpriceauction'] == true) {
                                        $cornerImag = 'fixed' . $size . '.gif';
                                    } else if ($obj['pennyauction'] == true) {
                                        $cornerImag = 'cent' . $size . '.gif';
                                    } else if ($obj['nailbiterauction'] == true) {
                                        $cornerImag = 'night' . $size . '.gif';
                                    } else if ($obj['offauction'] == true) {
                                        $cornerImag = '100off' . $size . '.gif';
                                    } else if ($obj['nightauction'] == true) {
                                        $cornerImag = 'night' . $size . '.gif';
                                    } else if ($obj['openauction'] == true) {
                                        $cornerImag = 'open' . $size . '.gif';
                                    } else if ($obj['halfbackauction'] == true) {
                                        $cornerImag = '';
                                    } else if ($obj['seatauction'] == true) {
                                        $cornerImag = 'seatedd-' . $size . '.gif';
                                    }else if ($obj['lockauction'] == true) {
                                        $cornerImag = 'lockedlarge.gif';
                                    }else if ($obj['cashauction'] == true) {
                                        $cornerImag = 'nobidlarge.gif';
                                    }

		 if(!empty($cornerImag)){
		  return $cornerImag;
		  }else{
		  return 'blank.png';
		  }
}

