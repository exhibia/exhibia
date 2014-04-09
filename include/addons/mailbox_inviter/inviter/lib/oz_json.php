<?php

define ('JSONTYPE_OBJECT',0);
define ('JSONTYPE_ARRAY',1);
define ('JSONTYPE_NULL',2);
define ('JSONTYPE_BOOLEAN',3);
define ('JSONTYPE_STRING',4);
define ('JSONTYPE_NUMERIC',5);


define('JSONSTATE_INTEGER',0);
define('JSONSTATE_FRACTION',1);
define('JSONSTATE_E',2);
define('JSONSTATE_E_DIGITS',3);



class OzJsonParser {
	var $json;
	var $idx;
	var $jsonlen;
	var $assoc; //true=use associative array, false=use stdclass

	function OzJsonParser ($str, $assoc=FALSE) {
		$this->json = $str;
		$this->idx = 0;
		$this->jsonlen = strlen($str);
		$this->assoc = $assoc;
	}



	function skipWhitespace () {
	 	//This code is optimized for minimal whitespace, as json is usually compact, without unnecessary whitespace
		for (; $this->idx<$this->jsonlen; $this->idx++) {
		 	$c = $this->json[$this->idx];
		 	if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;
//			if (!ctype_space($this->json[$i])) break;
		}


	}
//*/


	function readName () {
		//$this->skipWhitespace();
		//for (; $this->idx<$this->jsonlen; $this->idx++) {$c = $this->json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}

		$i1 = $this->idx;
		$n = $this->jsonlen;
		if ($i1>=$n) return NULL;
		$i = $i1;
		$sb = '';
		$json = $this->json;	//faster
		while ($i<$n) {
			//$c = ord($this->json[$i]);
			//$validchar = ($c>=65 && $c<=90) || ($c>=97 && $c<=122) || ($c>=48 && $c<=57) || $c===36 || $c===95;
			$c = $json[$i];
			//$validchar = ctype_alnum($c) || $c==='_' || $c==='$';
			//if (!$validchar) break;
			if (!ctype_alnum($c) && $c!=='_' && $c!=='$') break;
			$sb.=$c;
			$i++;
		}
		$this->idx = $i;
		//return $i===$i1 ? NULL : substr($this->json,$i1,$i-$i1);
		return $sb;
	}


	function readString() {


		$i = $this->idx;
		$n = $this->jsonlen;
		if ($i>=$n) return null;
		$sb = '';
		$json = $this->json;	//faster
		$quoteChar = $json[$i++];
		while ($i<$n) {
			$c = $json[$i];
			if ($c === '\\') {
			 	$c = $json[++$i];
				if ($c==='r') $sb.="\r";
				elseif ($c==='n') $sb.="\n";
				elseif ($c==='t') $sb.="\t";
				elseif ($c==='b') $sb.="\b";
				elseif ($c==='u') {
					$hex = substr($json,$i+1,4);
					$i+=4;
					if ($hex !== null && strlen($hex) == 4) {
						//Try to parse unicode (??)
						$sb.=chr_utf8(hexdec($hex));
					}
				}
				elseif ($c==='x') {
					$hex = substr($json,$i+1,2);
					$i+=2;
					if ($hex !== null && strlen($hex) == 2) {
						$sb.=chr(hexdec($hex));
					}
				}
				else $sb.=$c;
			} elseif ($c === $quoteChar) {
				// Hit the ending quote char
				$this->idx = $i+1;
				return $sb;
			} else {
				$sb.=$c;
			}
			$i++;
		}
		$this->idx = $i;
		return $sb;
	}


	function readNumber()  {

		// First char can be 0 or -
		//$this->skipWhitespace();
		//for (; $this->idx<$this->jsonlen; $this->idx++) {$c = $this->json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}

		$i1 = $this->idx;
		$n = $this->jsonlen;
		if ($i1>=$n) return null;
		$json = $this->json;	//faster

		// Verify this is a number (or not!)
		$c = $json[$i1];
		if ($c!=='-' && $c!=='+' && !ctype_digit($c)) {
//echo "[UNKNOWNCHAR:$c]";
			return null;
		}



		$state = JSONSTATE_INTEGER;
		$i = $i1;
		//$sb = '';
		//$sb.=$c;
		for (;$i<$n;$i++) {
			$c = $json[$i];
			//if ($c == null) break;
			if ($state == JSONSTATE_INTEGER) {
				if ($c == '.')
					$state = JSONSTATE_FRACTION;
				else if ($c == 'e' || $c == 'E')
					$state = JSONSTATE_E;
				//Note: A loophole in state is such that it allows multiple - or + !
				//We will need to create another state in the future.
				else if ($c !== '-' && $c!=='+' && !ctype_digit($c)) {
					break;
				}
			} else if ($state == JSONSTATE_FRACTION) {
				if ($c == 'e' || $c == 'E')
					$state = JSONSTATE_E;
				else if (!ctype_digit($c)) {
					break;
				}
			} else if ($state == JSONSTATE_E) {
				if (ctype_digit($c)) {
					// Do nothing. Append to sb, and switch to e digits state
				} else if ($c !== '-' && $c !== '+') {
					break;
				}
				$state = JSONSTATE_E_DIGITS;
			} else {
				// State is 3 ...must be...
				if (!ctype_digit($c)) {
					break;
				}
			}
			//$sb.=$c;
		}

		$sv = substr($json,$i1,$i-$i1);

		$this->idx = $i;	
		// If state reached 1, then we have decimal places. Use double
		// instead
		$d = floatval($sv);
		if ($state >= JSONSTATE_FRACTION) {
			return $d;
		} else {
			//Use int if within 32-bit number range (assuming 32-bit php)
			if ($d<-2147483648 || $d>2147483647) return $d;
			return intval($sv);
		}
	}

	function readObject () {

		$obj = $this->assoc ? array() : new stdClass;

		// Read members of the object
		$json = $this->json;
		$jsonlen = $this->jsonlen;
		while (true) {
			//$this->skipWhitespace();
			for (; $this->idx<$jsonlen; $this->idx++) {$c = $json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}

			// Read name. In some cases, it may be missing quotes.
			//$c = $this->read();
			$c = $this->idx<$jsonlen ? $json[$this->idx++] : NULL;
			
			if ($c==='\'' || $c==='"') {
				//$this->unread();
				if ($this->idx>0) $this->idx--;
				
				$name = $this->readString();
			}
			else if ($c==='}') {
			 	break;//empty object {}}
			}
			else {
				//$this->unread();
				if ($this->idx>0) $this->idx--;
				$name = $this->readName();
			}
			//$name = $this->readString();
			if ($name===null) break;

//echo "[NAME=$name]";

			// Read ":"
			//$this->skipWhitespace();
			for (; $this->idx<$jsonlen; $this->idx++) {$c = $json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}
			//$c = $this->read();
			//PHP4 doesn't support exceptions. We'll just swallow the error for now...
			//if ($c !== ':') throw new JsonParserException("Expecting ':'");

			//$c = $this->idx<$this->jsonlen ? $this->json[$this->idx++] : NULL;
			if ($this->idx < $jsonlen) $this->idx++;	//Assume it's : we're skipping'
//			for (; $this->idx<$this->jsonlen; $this->idx++) {$c = $this->json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t" && $c!==':') break;}
			

			// Read value
			$readSomething=FALSE;
			$value = $this->readValue($readSomething);
			if (!$readSomething) {
				//Eat up the } character that readValue() did not consume
				if ($this->idx<$jsonlen) $this->idx++;
				break;
			}

			//FIXME WHAT IF $VALUE IS EOF???

			//Set a value in the object.
			if ($this->assoc) $obj[$name]=$value;
			else $obj->$name = $value;	


			// Read "," or "}" or "]" or ")"
			//$this->skipWhitespace();
			for (; $this->idx<$jsonlen; $this->idx++) {$c = $json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}
			//$c = $this->read();
			$c = $this->idx<$jsonlen ? $json[$this->idx++] : NULL;
			if ($c === null || $c === '}') {
				break;
			} else if ($c !== ',') {
				//PHP doesn't support exceptions. We'll just swallow the error for now ...
				//throw new JsonParserException("Expecting ','");
			}
		}
		return $obj;
	}


	function readArray() {

		$json = $this->json;
		$jsonlen = $this->jsonlen;
		$obj = array();
		while (true) {
			//$this->skipWhitespace();
			for (; $this->idx<$jsonlen; $this->idx++) {$c = $json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}
			// Read value
			$readSomething=FALSE;
			$val = $this->readValue($readSomething);
			if (!$readSomething) {
				//Eat up the } character that readValue() did not consume
				if ($this->idx<$jsonlen) $this->idx++;
				break;
			}
			$obj[] = $val;

			// Next, we expect either , or ]
			//$this->skipWhitespace();
			for (; $this->idx<$jsonlen; $this->idx++) {$c = $json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}
			//$c = $this->read();
			$c = $this->idx<$jsonlen ? $json[$this->idx++] : NULL;
			if ($c === ']') {
				break;
			}
			else if ($c !== ',') {
				//PHP doesn't support exceptions. We'll just swallow the error for now ...

				// Unexpected token! Expecting a "," for next item!
				//throw new JsonParserException("Expecting ','");
			}
		}
		return $obj;
	}


	//Attempt to read a PHP value
	//Returns an array. First element is a "value was read" boolean value. If true, then value is in the 2nd array element. If false, it means no data was read (typically, EOF)
	function readValue(&$readSomething) {

		$json = $this->json;
		$jsonlen = $this->jsonlen;

		//EOF...
		if ($this->idx>=$jsonlen) {
		 	$readSomething=false;
			return NULL;
		}

		// Read until comma? read until }, ), ] ?

		// Skip whitespaces
		//$this->skipWhitespace();
		for (; $this->idx<$jsonlen; $this->idx++) {$c = $json[$this->idx];if ($c!==' ' && $c!=="\r" && $c!=="\n" && $c!=="\t") break;}

		// Read character and figure out what it is
		$c = $json[$this->idx];
		
//echo "[C=$c]";
		
		if ($c === '}' || $c === ']' || $c === ')' || $c === ',') {

//			$this->idx++;
			//Supposed to unread this character!
		 	$readSomething=false;
			return NULL;
			//return null;
		} else if ($c === '{') {
			$this->idx++;
//echo "[READOBJECT]";
			$v = $this->readObject();
			$readSomething = $v!==NULL;
			return $v;
			//return array($v===null?false:true,$v);
		} else if ($c === '[') {
			$this->idx++;
			$v = $this->readArray();
			//return array($v===null?false:true,$v);
			$readSomething = $v!==NULL;
			return $v;
			
		} else if ($c === '"' || $c === '\'') {
			$v = $this->readString();
// "[READSTRING:$v]";
			$readSomething = $v!==NULL;
			return $v;
			//return array($v===null?false:true,$v);
			//if ($s == null) return null;
			//else return new JsonValue(s);
		} else if ($c === '+' || $c === '-' || ctype_digit($c)) {
			// If first digit is "0", check if it's a hex code.
			// Read until we hit x
			$v = $this->readNumber();
//echo "[READNUMBER:$v]";
			//return array($v===null?false:true,$v);
			$readSomething = $v!==NULL;
			return $v;
		} else {
			$s = $this->readName();
			if ($s === null) {
				//return array(false,null);
				$readSomething = FALSE;
				return NULL;
			}
			$s = strtolower($s);
			if ($s==='null') {
				$readSomething = TRUE;
				return NULL;
				//return array(true,null);
				//return null;		//?????????????????????
				//return JsonValue.NULL;
			} else if ($s==='true') {
				$readSomething = TRUE;
				return TRUE;
				//return array(true,true);
				//return true;
				//return new JsonValue(true);
			} else if ($s==='false') {
				$readSomething = TRUE;
				return FALSE;
				//return array(true,false);
				//return false;
				//return new JsonValue(false);
			} else {
				//PHP doesn't support exceptions. We'll just swallow the error for now ...
				//Don't know what it is!
				//throw new UnsupportedOperationException("NOT YET IMPLEMENTED. GOT " + s);
			}
		}
	}
}

function oz_json_decode ($json, $assoc=FALSE) {

	//PHP's current json handling is unreliable.
	//Quercus's JSON is assumed to be reliable.
	$reliable_json = oz_get_config('reliable_json',NULL);
	if ($reliable_json===NULL) $reliable_json = oz_is_quercus();

	//Use PHP's json decode where available
	if (function_exists('json_decode') && $reliable_json) {
		return json_decode($json,$assoc);
	}
	else {
		$p = new OzJsonParser($json,$assoc);
		$readSomething=FALSE;
		return $p->readValue($readSomething);
		//$v = $p->readValue();
		//return $v[1];	//No matter if got value, or not
	}
}

function oz_json_decode2 ($json, $assoc=FALSE) {
	$p = new OzJsonParser($json,$assoc);
	$readSomething=FALSE;
	return $p->readValue($readSomething);
	//$p = new OzJsonParser($json,$assoc);
	//$v = $p->readValue();
	//return $v[1];	//Always use our own json decoder (some PHP versions buggy))
}



function oz_php_escape_string(&$s) {
	$n = strlen($s);
	$s2='';
	for ($i=0;$i<$n;$i++) {
		$c = $s[$i];
		$o = ord($c);
		if ($o===13) $s2.='\\r';
		else if ($o===10) $s2.='\\n';
		else if ($o===9) $s2.='\\t';
		else if ($o===34) $s2.='\\"';
		else if ($o===36) $s2.='\\$';
		else if ($o===92) $s2.='\\\\';
		else if ($o<32 || $o>126) {$s2.=$o<16?'\\x0':'\\x';$s2.=dechex($o);}
		else $s2.=$c;
	}
	return $s2;
}


function oz_json_escape_string(&$s) {
    $n = strlen($s);
    $s2='';
    for ($i=0;$i<$n;$i++) {
        $c = $s[$i];
        if ($c==="\r") $s2.='\\r';
        elseif ($c==="\n") $s2.='\\n';
        elseif ($c==="\t") $s2.='\\t';
        elseif ($c==="\\") $s2.='\\\\';
        elseif ($c==="\n") $s2.='\\n';
        elseif ($c==="\f") $s2.='\\f';
        elseif ($c==="\b") $s2.='\\b';
        elseif ($c==='"') $s2.='\\"';
        else {
            $o = ord($c);
            if (($o & 0x80)===0) {
                $s2.=$c;
            }
            else {
                if (($o & 0xE0)===0xC0) {
                    $c2 = ord($s[++$i]);
                    $u = ($o & 0x1F)<<6 | ($c2 & 0x3F);
                }
                elseif (($o & 0xF0)===0xE0) {
                    $c2 = ord($s[++$i]);
                    $c3 = ord($s[++$i]);
                    $u = ($o & 0x0F)<<12 | ($c2 & 0x3F)<<6 | ($c3 & 0x3F);
                }
                elseif (($o & 0xF8)===0xF0) {
                    $c2 = ord($s[++$i]);
                    $c3 = ord($s[++$i]);
                    $c4 = ord($s[++$i]);
                    $u = ($o & 0x0F)<<18 | ($c2 & 0x3F)<<12 | ($c3 & 0x3F)<<6 | ($c4 & 0x3F);
                }
                $s2 .= sprintf('\\u%04x',$u);
            }
        }
    }
    return $s2;
}


function _oz_json_encode (&$obj) {

	if (function_exists('json_encode')) return json_encode($obj);
	
    if (is_null($obj)) return 'null';
    elseif (is_bool($obj)) return $obj?'true':'false';
    elseif (is_string($obj)) return '"'.oz_json_escape_string($obj).'"';
    elseif (is_numeric($obj)) return $obj;  //check range, and return as double/float in over int range?
    elseif (is_object($obj)) {
        $s = '{';
        $vars = get_object_vars($obj);
        $c = 0;
        foreach ($vars as $k=>$v) {
            if ($c>0) $s .= ',';
            $s .= oz_json_encode($k);
            $s .= ':';
            $s .= oz_json_encode($v);
            $c++;
        }
        $s .= '}';
        return $s;
    }
    elseif (is_array($obj)) {

        $n = count($obj);
        $is_assoc = array_keys($obj)!==range(0,$n-1);
        if (count($obj)===0) return '[]';
        else if ($is_assoc) {
            $s = '{';
            $c = 0;
            foreach ($obj as $k=>$v) {
                if ($c>0) $s .= ',';
                $s .= oz_json_encode($k);   //$k assumes to be valid json names!
                $s .= ':';
                $s .= oz_json_encode($v);
                $c++;
            }
            $s .= '}';
            return $s;
        }
        else {
            $s = '[';
            $c = 0;
            foreach ($obj as $v) {
                if ($c>0) $s .= ',';
                $s .= oz_json_encode($v);
                $c++;
            }
            $s .= ']';
            return $s;
        }
        //is associative or list array?
    }
    //else, what the heck is it?
    return 'null';
}

function oz_json_encode ($obj) {
	if (function_exists('json_encode')) return json_encode($obj);
	else return _oz_json_encode($obj);
}

