<?php

function oz_vcard_unescape ($str) {
	if ($str==null) return null;
	$ba2 = '';
	$n = strlen($str);
	for ($i=0; $i<$n; $i++) {
		$v = $str[$i];
		if ($v=='\\' && $i+1<$n) {
			$v2 = $str[++$i];
			if ($v2=='r') $ba2.="\r";
			else if ($v2=='n') $ba2.="\n";
			else $ba2.=$v2;
		}
		else {
			$ba2.=$v;
		}
	}
}

function oz_vcard_to_string($ba,$encoding,$charset) {
	if ($encoding!=null) {
		$encoding = strtoupper($encoding);
		if ('QUOTED-PRINTABLE'==$encoding) $ba=quoted_printable_decode($ba);
		else if ('B'==$encoding) $ba=base64_decode($ba);
	}

	if ($charset==null) {
		return $ba;
	}
	else {
		$charset = strtoupper($charset);
		if ($charset=='UTF-8' || $charset=='UTF8') return $ba;
		else return iconv($charset,'UTF-8',$ba);
	}
}

function oz_vcard_to_binary ($ba, $encoding) {
	if ($encoding!=null) {
		$encoding = strtoupper($encoding);
		if ('QUOTED-PRINTABLE'==$encoding) return quoted_printable_decode($ba);
		else if ('B'==$encoding) return base64_decode($ba);
	}
	return $ba;
}

function oz_vcard_split ($ba,$delim=',') {
	$a = array();
	$n = strlen($ba);
	$i1 = 0;
	for ($i = 0; $i < $n; $i++) {
		$c = $ba[$i];
		if ($c == '\\') {
			// Skip the next escape char
			if ($i+1 < $n) {
				$i++;
			}
		} else if ($c == $delim) {
			$a[]=substr($ba,$i1,$i-$i1);
			$i1=$i+1;
		}
	}
	if ($i1 < $n) {
		if ($i1 == 0) $a[]=$ba;
		else $a[]=substr($ba,$i1,$n-$i1);
	}
	return $a;
}


class OzVCardField {
	var $name;
	var $rawValue;
	var $params = array();

	function OzVCardField ($rawName, $rawValue) {

		$sa = explode(';',$rawName);
		$this->name = trim($sa[0]);


		$n = count($sa);
		for ($i = 1; $i < $n; $i++) {
			$s = $sa[$i];
			$idx = strpos($s,'=');
			if ($idx===false) {
				$this->addParam(trim($s),null);
			}
			else {
				$key = strtoupper(trim(substr($s,0,$idx)));
				$vals = explode(',',substr($s,$idx+1));
				foreach ($vals as $val) {
					$this->addParam($key,trim($val));
				}
			}
		}


		$this->rawValue = $rawValue;
	}


	function addParam($paramName, $value) {
		$paramName = strtoupper($paramName);
		if (isset($this->params[$paramName])) {
			$this->params[$paramName][] = $value;
		}
		else {
			$a = array();
			$a[] = $value;
			$this->params[$paramName] = $a;//array($value);
		}
	}

	function hasParam ($paramName) {
		return array_key_exists(strtoupper($paramName),$this->params);
	}

	function &getParamValues ($paramName) {
		$paramName = strtoupper($paramName);
		if (isset($this->params[$paramName])) {
			return $this->params[$paramName];
		}
		else {
			return null;
		}
	}

	function getFirstParamValue ($paramName) {
		$paramName = strtoupper($paramName);
		if (isset($this->params[$paramName])) {
			$v =& $this->params[$paramName];
			if (count($v)==0) return null;
			else return $v[0];
		}
		else {
			return null;
		}
	}

	function getBinaryValue () {
		$encoding = $this->getFirstParamValue('ENCODING');
		return oz_vcard_to_binary($this->rawValue,$encoding);
	}

	function getStringValue () {
		$encoding = $this->getFirstParamValue('ENCODING');
		$charset = $this->getFirstParamValue('CHARSET');
		return oz_vcard_to_string($this->rawValue,$encoding,$charset);
	}

	function getStringValues ($delim) {
		$encoding = $this->getFirstParamValue('ENCODING');
		$charset = $this->getFirstParamValue('CHARSET');
		$al = array();
		$a = oz_vcard_split($this->rawValue,$delim);
		foreach ($a as $v)
			$al[] = oz_vcard_to_string($v,$encoding,$charset);
		return $al;
	}
}




//Tokenizer to tokenize vcard like formats, returning series of OzVCardField tokens
class OzVCardTokenizer {

	var $src;
	var $len;
	var $pos;

	var $previousKey;
	var $previousValue;

	function OzVCardTokenizer($vcf) {
		$this->src = $vcf;
		$this->pos = 0;
		$this->len = strlen($vcf);
		$this->previousKey = null;
		$this->previousValue = '';
	}

	function readUntilCRLF(&$buf) {
		$i = $this->pos;
		$n = $this->len;
		while ($i<$n) {
			$v = $this->src[$i++];
			if ($v=="\r") continue;
			else if ($v=="\n") break;
			else if ($v=='\\') {
				if ($i>=$n) break;
				$v2 = $this->src[$i++];
				if ($v2=='r') $buf.="\r";
				else if ($v2=='n') $buf.="\n";
				else $buf.=$v2;
			}
			else $buf.=$v;
		}
		$this->pos = $i;
	}

	function readUntilColonOrCRLF(&$buf) {
		$i = $this->pos;
		$n = $this->len;
		while ($i<$n) {
			$v = $this->src[$i++];
			if ($v=="\r") continue;
			else if ($v=="\n") break;
			else if ($v==':') {
				$this->pos = $i;
				return true;
			}
			else if ($v=='\\') {
				if ($i>=$n) break;
				$v2 = $this->src[$i++];
				if ($v2=='r') $buf.="\r";
				else if ($v2=='n') $buf.="\n";
				else $buf.=$v2;
			}
			else $buf.=$v;
		}
		$this->pos = $i;
		return false;
	}


	function next()  {
		if ($this->pos < $this->len) {
			while ($this->pos < $this->len) {
				$ba = '';
				$hitColon = $this->readUntilColonOrCRLF($ba);
				if (empty($ba)) {
					if ($hitColon) $this->readUntilCRLF($ba);
					continue;
				}
				if ($hitColon) {
					$c = $ba[0];
					if (($c==' ' || $c=='\t') && $this->previousKey!=null) {
						// This is a folded value. The ':' was mistakenly swallowed. Read until hit CRLF/EOF.
						$this->previousValue.=substr($ba,1);
						$this->previousValue.=':';
						$this->readUntilCRLF($this->previousValue);
					}
					else {

						$field = null;
						if ($this->previousKey!=null)
							$field = new OzVCardField($this->previousKey, $this->previousValue);
						$this->previousKey = $ba;
						$this->previousValue = '';
						$this->readUntilCRLF($this->previousValue);


						$tmpf = new OzVCardField($this->previousKey, null);
						$enc = $tmpf->getFirstParamValue('ENCODING');
						if ($enc!=null && strtoupper($enc)=='QUOTED-PRINTABLE') {
							while ($this->pos < $this->len) {
								$ln = strlen($this->previousValue);
								if ($ln==0 || $this->previousValue[$ln-1]!='=') {
									break;
								}
								$this->previousValue = substr($this->previousValue,0,$ln-1); //or just $this->previousValue.="\r\n";
								$this->readUntilCRLF($this->previousValue);
							}
						}

						if ($field!=null) return $field;
					}
				}
				else {
					$c = $ba[0];
					if (($c==' ' || $c=='\t') && $this->previousKey!=null) {
						// This is a folded value. The ':' was mistakenly swallowed. Read until hit CRLF/EOF.
						$this->previousValue.=substr($ba,1);
					}
					else {
						//Junk line
					}
				}
			}
		}


		if ($this->previousKey != null) {
			$field = new OzVCardField($this->previousKey, $this->previousValue);
			$this->previousKey = null;
			$this->previousValue = '';
			return $field;
		} else {
			return null;
		}
	}
}

