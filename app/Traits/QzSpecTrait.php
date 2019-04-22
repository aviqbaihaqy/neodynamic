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
				return chr(0x1B) . chr(0x21) . chr(0x67);
			break;
			case 'f10':
				return chr(0x1B) . chr(0x21) . chr(0x50);
			break;
			case 'boldTag':
				return chr(27) . chr(69);
			break;
			case 'condensed':
				return chr(27) . chr(33) . chr(4);
			break;
			case 'fontsize':
				return chr(27) . chr(80);
			break;
			case 'boldOpen':
				return chr(27) . chr(69);
			break;
			case 'boldClose':
				return chr(27) . chr(70);
			break;
			case 'italicOpen':
				return chr(27) . chr(52);
			break;
			case 'italicClose':
				return chr(27) . chr(53);
			break;
			case 'underlineOpen':
				return chr(27) . chr(45) . chr(49);
			break;
			case 'underlineClose':
				return chr(27) . chr(45) . chr(48);
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
