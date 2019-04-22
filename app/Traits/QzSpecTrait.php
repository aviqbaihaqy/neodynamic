<?php

namespace App\Traits;

trait QzSpecTrait {

	public function spc($mode, $nilai, $jml_k) {
		if ($jml_k == '') {$jml_k = '40';}
		$sp2 = ceil(($jml_k - $nilai)/2);
		$sp1 = floor(($jml_k - $nilai)/2);
		if ($mode=="1") {return $sp1;} else if ($mode=="2") {return $sp2;}
	}

	public function spasi($jml) {
		$spasi ='';
		for ($i=0; $i < $jml; $i++) {
			$spasi .= ' ';
		}
		return $spasi;
	}

	public function addspc($mode, $nilai, $total_k) {
		$jml_k = strlen($nilai);
		$jmlspc = $total_k - $jml_k;
		$spc_center = ceil($jmlspc /2);
		if ($mode == "1") {
			return $nilai."".$this->spasi($jmlspc);
		} else if ($mode == "2") {
			return $this->spasi($jmlspc)."".$nilai;
		} else if ($mode == "3") {
			return $this->spasi($spc_center)."".$nilai."".$this->spasi($spc_center);
		}
	}

	public function splitpsn($text, $width = '80', $break = '\n', $cut = 0 ) {
		$wrappedarr = array();
		$wrappedtext = wordwrap( $text, $width, $break, $cut );
		$arr = explode( $break, $wrappedtext );
		$size = count( $arr );
		return $arr;
	}

	public function getUnicodeChar($name=null){
		switch ($name) {
			case 'f15':
				return Chr(0x1B) . Chr(0x21) . chr(0x67);
			break;
			case 'f10':
				return Chr(0x1B) . Chr(0x21) . chr(0x50);
			break;
			case 'boldTag':
				return Chr(27) . Chr(69);
			break;
			case 'condensed':
				return Chr(27) . Chr(33) . Chr(4);
			break;
			case 'fontsize':
				return Chr(27) . Chr(80);
			break;
			case 'boldOpen':
				return Chr(27) . Chr(69);
			break;
			case 'boldClose':
				return Chr(27) . Chr(70);
			break;
			case 'italicOpen':
				return Chr(27) . Chr(52);
			break;
			case 'italicClose':
				return Chr(27) . Chr(53);
			break;
			case 'underlineOpen':
				return Chr(27) . Chr(45) . Chr(49);
			break;
			case 'underlineClose':
				return Chr(27) . Chr(45) . Chr(48);
			break;
			case 'initialized':
				return chr(27).chr(64);
			break;
			case 'condensedOpen':
				return chr(15);
			break;
			case 'condensedClose':
				return chr(18);
			break;
			
			default:
				return '';
			break;
		}
	}

}