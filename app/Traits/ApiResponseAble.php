<?php

namespace App\Traits;

use App\Traits\QzDocument;
use Storage;

trait ApiResponseAble {

  use QzDocument;

  public function doPrinting($response)
  {
    if (session('authuser.printer') === 1) {
      return $this->htmlResponse($response);
    } elseif (session('authuser.printer') === 6) {
      return $this->qzTrayResponse($response);
    } else {
      return ['do'=>'nothing'];
    }
  }


  public function htmlResponse($responseResult)
  {
    $html = '';
    $jsonResponse = [];
    $html .= view('struk.header')->render();
    foreach ($responseResult as $struk) {
      if (isset($struk['responseCode']) ? $struk['responseCode'] : null == '00') {
        if (in_array($struk['productid'], config('printer.pdamsys'))) {
          $html .= view('struk.pdam', compact('struk'))->render();
        } elseif (in_array($struk['productid'], config('printer.telcopasca'))) {
          $html .= view('struk.telco-pasca', compact('struk'))->render();
        } elseif (in_array($struk['productid'], config('printer.plnprepaid'))) {
          $html .= view('struk.pln-prepaid', compact('struk'))->render();
        } elseif (in_array($struk['productid'], config('printer.plnpostpaid'))) {
          $html .= view('struk.pln-postpaid', compact('struk'))->render();
        } elseif (in_array($struk['productid'], config('printer.plnnontaglis'))) {
          $html .= view('struk.pln-nontaglis', compact('struk'))->render();
        } else {
          $html .= view('struk.general', compact('struk'))->render();
        }
      } elseif(array_key_exists('errorMessage', $struk)) {
        $jsonResponse[] = [
        'inquiryId' => $struk['inquiryId'],
        'errorMessage' => $struk['errorMessage'],
        'subscriberId' => md5(uniqid()),
        ];
      }
    }
    $html .= view('struk.footer')->render();
    return ['htmlResponse' => $html, 'errorResponse' => $jsonResponse];
  }

  public function qzTrayResponse($responseResult)
  {
    $fileName = $this->fileName();

    $qz_print = '';
    $jsonResponse = [];

    $i=0;
    foreach ($responseResult as $struk) {
      $i++;
      if (isset($struk['responseCode']) ? $struk['responseCode'] : null == '00') {
        if (in_array($struk['productid'], config('printer.pdamsys'))) {
          $qz_print .= $this->pdamSys($struk, $i);
        } elseif (in_array($struk['productid'], config('printer.telcopasca'))) {
          $qz_print .= $this->telkom($struk, $i);
        } elseif (in_array($struk['productid'], config('printer.plnprepaid'))) {
          $qz_print .= $this->plnPrepaid($struk, $i);
        } elseif (in_array($struk['productid'], config('printer.plnpostpaid'))) {
          $qz_print .= $this->plnPostPaid($struk, $i);
        } elseif (in_array($struk['productid'], config('printer.plnnontaglis'))) {
          $qz_print .= $this->plnNonTagLis($struk, $i);
        } else {
          $qz_print .= $this->general($struk, $i);
        }
      } elseif (array_key_exists('errorMessage', $struk)) {
        $jsonResponse[] = [
        'inquiryId' => $struk['inquiryId'],
        'errorMessage' => $struk['errorMessage'],
        'subscriberId' => md5(uniqid()),
        ];
      }
    }

    Storage::disk('public')->put('struk/'.$fileName, $qz_print);

    return ['qzResponse' => $fileName, 'errorResponse' => $jsonResponse];
  }
}
