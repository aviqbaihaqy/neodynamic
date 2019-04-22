<?php

namespace App\Traits;

trait QzDocument
{
    use QzSpecTrait;

    public function fileName()
    {
        return session('authuser.kd_loket') . time() . '_qz.txt';
    }

    public function plnPostpaid($struk = null, $i)
    {
        $msg = $struk['footer'];
        $msg = explode('<br>', $msg);

        $cetak = '';
        $cetak .= $this->getUnicodeChar('initialized');
        $cetak .= $this->getUnicodeChar('fontsize');
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('3', 'STRUK PENERIMA', '45') . '' . $this->addspc('3', $this->getUnicodeChar('boldOpen') . 'STRUK PEMBAYARAN ' . 'PLN Postpaid' . '' . $this->getUnicodeChar('boldClose'), '60') . '' . $this->addspc('2', 'MODE', '30') . "\n";
        $cetak .= $this->addspc('1', date('d-m-Y H:i:s', strtotime($struk['date'])), '45') . '' . $this->addspc('1', 'NO. STRUK: ' . $struk['numreceipt'], '60') . '' . $this->addspc('2', date('d-m-Y H:i:s', strtotime($struk['date'])), '30') . "\n";
        $cetak .= "\n";
        $cetak .= $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '45') . '' . $this->addspc('1', 'IDPEL       : ' . $struk['subscriberId'], '60') . '' . $this->addspc('1', '' . 'BL/TH' . '       : ' . $struk['billPeriod'], '30') . "\n";
        $cetak .= $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '45') . '' . $this->addspc('1', 'NAMA        : ' . $struk['subscriberName'], '60') . '' . $this->addspc('1', 'STAND METER : ' . $struk['dataReceipt']['standmeter'], '30') . "\n";
        $cetak .= $this->addspc('1', 'PRIODE  : ' . $struk['billPeriod'], '45') . '' . $this->addspc('1', 'TARIF/DAYA  : ' . $struk['subscriberSegmentation'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', 'RP TAG PLN  : ' . number_format($struk['billAmount']), '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', '' . 'REFF' . '  : ' . $struk['swreff'], '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'JUMLAH  : Rp. ' . number_format($struk['billAmount']), '45') . '' . '' . $this->addspc('3', 'PLN menyatakan struk ini sebagai bukti pembayaran yang sah.', '90') . "\n";
        $cetak .= $this->addspc('1', 'ADM BANK: Rp. ' . number_format($struk['admin']), '45') . '' . $this->addspc('1', 'ADMIN BANK*) : Rp. ' . number_format($struk['admin']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'TOTAL   : Rp. ' . number_format($struk['total']), '45') . '' . $this->addspc('1', 'TOTAL BAYAR  : Rp. ' . number_format($struk['total']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', (isset($msg[0])) ? $msg[0] : '', '90') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', (isset($msg[1])) ? $msg[1] : '', '90') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', (isset($msg[2])) ? $msg[2] : '', '90') . "\n";
        if ($i % 2 == 0) {
            $cetak .= "\n\n\n";
        } else {
            $cetak .= "\n\n";
        }
        return $cetak;
    }

    public function plnPrepaid($struk = null, $i)
    {
        $cetak = '';
        $cetak .= $this->getUnicodeChar('initialized');
        $cetak .= $this->getUnicodeChar('fontsize');
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('3', 'STRUK PENERIMA', '45') . '' . $this->addspc('3', $this->getUnicodeChar('boldOpen') . 'STRUK PEMBAYARAN ' . 'PLN - PREPAID' . '' . $this->getUnicodeChar('boldClose'), '60') . '' . $this->addspc('2', 'MODE', '30') . "\n";
        $cetak .= $this->addspc('1', date('d-m-Y H:i:s', strtotime($struk['date'])), '45') . '' . $this->addspc('1', 'NO. STRUK: ' . $struk['numreceipt'], '60') . '' . $this->addspc('2', date('d-m-Y H:i:s', strtotime($struk['date'])), '30') . "\n";
        $cetak .= "\n";
        $cetak .= $this->addspc('1', 'NO METER: ' . $struk['dataReceipt']['msn'], '45') . '' . $this->addspc('1', 'NO METER     : ' . $struk['dataReceipt']['msn'], '60') . '' . $this->addspc('1', 'METERAI         : Rp. ' . number_format($struk['dataReceipt']['Materai']), '30') . "\n";
        $cetak .= $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '45') . '' . $this->addspc('1', 'IDPEL        : ' . $struk['subscriberId'], '60') . '' . $this->addspc('1', 'PPN             : Rp. ' . number_format($struk['dataReceipt']['PPN']), '30') . "\n";
        $cetak .= $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '45') . '' . $this->addspc('1', 'NAMA         : ' . $struk['subscriberName'], '60') . '' . $this->addspc('1', 'PPJ             : Rp. ' . number_format($struk['dataReceipt']['PPJ']), '30') . "\n";
        $cetak .= $this->addspc('1', 'DAYA    : ' . $struk['subscriberSegmentation'], '45') . '' . $this->addspc('1', 'TARIF DAYA   : ' . $struk['subscriberSegmentation'], '60') . '' . $this->addspc('1', 'ANGSURAN        : Rp. ' . number_format($struk['dataReceipt']['Angsuran']), '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', 'REF          : ' . $struk['swreff'], '60') . '' . $this->addspc('1', 'RP STROOM/TOKEN : Rp. ' . number_format($struk['dataReceipt']['RpStromToken']), '30') . "\n";
        $cetak .= $this->addspc('1', 'ADMIN   : Rp. ' . number_format($struk['admin']), '45') . '' . $this->addspc('1', 'RP BAYAR     : Rp. ' . number_format($struk['total']), '60') . '' . $this->addspc('1', 'JML KWH         : ' . $struk['dataReceipt']['JmlKwh'], '30') . "\n";
        $cetak .= $this->addspc('1', 'TOTAL   : Rp. ' . number_format($struk['total']), '45') . '' . $this->addspc('1', '', '60') . '' . $this->addspc('1', 'ADMIN BANK      : Rp. ' . number_format($struk['admin']), '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', $this->getUnicodeChar('f10') . 'STROOM/TOKEN: ' . chunk_split($struk['billPeriod'], 4, ' '), '90') . "\n";
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', $struk['footer'], '90') . "\n";
        if ($i % 2 == 0) {
            $cetak .= "\n\n\n";
        } else {
            $cetak .= "\n\n";
        }
        return $cetak;
    }

    public function plnNonTagLis($struk = null, $i)
    {
        $msg = $struk['footer'];
        $msg = explode('<br>', $msg);

        $cetak = '';
        $cetak .= $this->getUnicodeChar('initialized');
        $cetak .= $this->getUnicodeChar('fontsize');
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('3', 'STRUK PENERIMA', '45') . '' . $this->addspc('3', $this->getUnicodeChar('boldOpen') . 'STRUK PEMBAYARAN ' . 'TAGIHAN NONTAGLIS' . '' . $this->getUnicodeChar('boldClose'), '60') . '' . $this->addspc('2', 'MODE', '30') . "\n";
        $cetak .= $this->addspc('1', $struk['date'], '45') . '' . $this->addspc('1', 'NO. STRUK: ' . $struk['numreceipt'], '60') . '' . $this->addspc('2', $struk['date'], '30') . "\n";
        $cetak .= "\n";
        $cetak .= $this->addspc('1', 'TRANSAKSI : ' . str_limit($struk['subscriberAddress'], 30), '45') . '' . $this->addspc('1', 'TRANSAKSI        : ' . $struk['subscriberAddress'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', 'REGISTRASI: ' . '##IDREGISTRASI##', '45') . '' . $this->addspc('1', 'NO REGISTRASI    : ' . '##IDREGISTRASI##', '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', 'IDPEL     : ' . $struk['subscriberId'], '45') . '' . $this->addspc('1', 'TGL REGISTRASI   : ' . '##TGLREGISTRASI##', '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', 'NAMA      : ' . str_limit($struk['subscriberName'], 30), '45') . '' . $this->addspc('1', 'NAMA             : ' . $struk['subscriberName'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', 'IDPEL            : ' . $struk['subscriberId'], '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', 'BIAYA PLN        : Rp. ' . number_format($struk['billAmount']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', 'GSP REF*)        : ' . $struk['swreff'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', 'JUMLAH  : Rp. ' . number_format($struk['billAmount']), '45') . '' . '' . $this->addspc('3', $msg[0], '90') . "\n";
        $cetak .= $this->addspc('1', 'ADM BANK: Rp. ' . number_format($struk['admin']), '45') . '' . $this->addspc('1', 'ADMIN BANK*) : Rp. ' . number_format($struk['admin']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'TOTAL   : Rp. ' . number_format($struk['total']), '45') . '' . $this->addspc('1', 'TOTAL BAYAR  : Rp. ' . number_format($struk['total']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . '' . $this->addspc('3', $struk['footer'], '90') . "\n";
        if ($i % 2 == 0) {
            $cetak .= "\n\n\n";
        } else {
            $cetak .= "\n\n";
        }
        return $cetak;
    }

    public function telkom($struk = null, $i)
    {
        $msg = $struk['footer'];
        $msg = explode('<br>', $msg);

        $cetak = '';
        $cetak .= $this->getUnicodeChar('initialized');
        $cetak .= $this->getUnicodeChar('fontsize');
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('3', 'STRUK PENERIMA', '45') . '' . $this->addspc('3', $this->getUnicodeChar('boldOpen') . 'STRUK PEMBAYARAN ' . 'TAGIHAN TELKOM' . '' . $this->getUnicodeChar('boldClose'), '60') . '' . $this->addspc('2', '', '30') . "\n";
        $cetak .= $this->addspc('1', $struk['date'], '45') . '' . $this->addspc('1', 'NO. STRUK: ' . $struk['numreceipt'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= "\n";
        $cetak .= $this->addspc('1', 'NO.REF : ' . $struk['swreff'], '45') . '' . $this->addspc('1', 'TGL PEMBAYARAN   : ' . $struk['date'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', 'REGISTRASI: ' . '-', '45') . '' . $this->addspc('1', 'NO. REFERENSI    : ' . $struk['swreff'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', 'NAMA      : ' . str_limit($struk['subscriberName'], 30), '45') . '' . $this->addspc('1', 'NAMA PELANGGAN   : ' . $struk['subscriberName'], '60') . '' . $this->addspc('1', ' ', '30') . "\n";
        $cetak .= $this->addspc('1', 'IDPEL     : ' . $struk['subscriberId'], '45') . '' . $this->addspc('1', 'NO.PELANGGAN     : ' . $struk['subscriberId'], '60') . '' . $this->addspc('1', '', '30') . "\n";

        for ($i = 0; $i < 3; $i++) {
            if (!empty($struk['dataReceipt'][$i])) {
                $cetak .= $this->addspc('1', $struk['dataReceipt'][$i]['periode'] . '   : Rp. ' . number_format($struk['dataReceipt'][$i]['jmltag']), '45') . '' . $this->addspc('1', 'TAGIHAN          : ' . $struk['dataReceipt'][$i]['periode'], '60') . '' . $this->addspc('1', 'Rp. ' . number_format($struk['dataReceipt'][$i]['jmltag']), '30') . "\n";
            } else {
                $cetak .= "\n";
            }
        }

        $cetak .= $this->addspc('1', 'ADM BANK  : Rp. ' . number_format($struk['admin']), '45') . '' . $this->addspc('1', 'ADMIN BANK*)     : Rp. ' . number_format($struk['admin']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'TOTAL     : Rp. ' . number_format($struk['total']), '45') . '' . $this->addspc('1', 'TOTAL BAYAR      : Rp. ' . number_format($struk['total']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . '' . $this->addspc('3', $msg[0], '90') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . '' . $this->addspc('3', $msg[1], '90') . "\n";
        if ($i % 2 == 0) {
            $cetak .= "\n\n\n";
        } else {
            $cetak .= "\n\n";
        }
        return $cetak;
    }

    public function pdamMkm($struk = null, $i)
    {
        $msg = $struk['footer'];
        $msg = explode('<br>', $msg);

        $cetak = '';
        $cetak .= $this->getUnicodeChar('initialized');
        $cetak .= $this->getUnicodeChar('fontsize');
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('3', 'STRUK PENERIMA', '45') . '' . $this->addspc('3', $this->getUnicodeChar('boldOpen') . 'STRUK PEMBAYARAN ' . '##NAMAPDAM##' . '' . $this->getUnicodeChar('boldClose'), '60') . '' . $this->addspc('2', 'MODE', '30') . "\n";
        $cetak .= $this->addspc('1', date('d-m-Y H:i:s', strtotime($struk['date'])), '45') . '' . $this->addspc('1', 'NO. STRUK: ' . '##NOSTRUK##', '60') . '' . $this->addspc('2', date('d-m-Y H:i:s', strtotime($struk['date'])), '30') . "\n";
        $cetak .= "\n";
        $cetak .= $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '45') . '' . $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '60') . '' . $this->addspc('1', 'BLN/TH      : ' . '##PERIODE##', '30') . "\n";
        $cetak .= $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '45') . '' . $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '60') . '' . $this->addspc('1', 'STAND METER : ' . '##MLALU##' . '-' . '##MKINI##', '30') . "\n";
        $cetak .= $this->addspc('1', 'PRIODE  : ' . $struk['billPeriod'], '45') . '' . $this->addspc('1', 'ALAMAT  : ' . substr($struk['subscriberId'], 0, 48), '60') . '' . $this->addspc('1', 'PEMAKAIAN   : ' . '##PAKAI##', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', 'MPI REF : ' . $struk['swreff'], '60') . '' . $this->addspc('1', 'GOL. TARIF  : ' . '##GOL##', '30') . "\n";
        $cetak .= $this->addspc('1', 'DENDA   : Rp. ' . number_format($struk['dataReceipt']['penaltyAmount']), '45') . '' . $this->addspc('1', 'DENDA   : Rp. ' . number_format($struk['dataReceipt']['penaltyAmount']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'JUMLAH  : Rp. ' . number_format($struk['billAmount']), '45') . '' . $this->addspc('1', 'JUMLAH  : Rp. ' . number_format($struk['billAmount']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . '' . $this->addspc('3', $msg[0], '90') . "\n";
        $cetak .= $this->addspc('1', 'ADM BANK: Rp. ' . number_format($struk['admin']), '45') . '' . $this->addspc('1', 'ADMIN BANK*) : Rp. ' . number_format($struk['admin']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'TOTAL   : Rp. ' . number_format($struk['total']), '45') . '' . $this->addspc('1', 'TOTAL BAYAR  : Rp. ' . number_format($struk['total']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', $msg[1], '90') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', ($msg[2]) ? $msg[2] : $msg[1], '90') . "\n";
        if ($i % 2 == 0) {
            $cetak .= "\n\n\n";
        } else {
            $cetak .= "\n\n";
        }
        return $cetak;
    }

    public function pdamSys($struk = null, $i)
    {
        $msg = $struk['footer'];
        $msg = explode('<br>', $msg);

        $cetak = '';
        $cetak .= $this->getUnicodeChar('initialized');
        $cetak .= $this->getUnicodeChar('fontsize');
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('3', 'STRUK PENERIMA', '45') . '' . $this->addspc('3', $this->getUnicodeChar('boldOpen') . 'STRUK PEMBAYARAN ' . $struk['dataReceipt']['pdam'] . '' . $this->getUnicodeChar('boldClose'), '60') . '' . $this->addspc('2', 'MODE', '30') . "\n";
        $cetak .= $this->addspc('1', $struk['date'], '45') . '' . $this->addspc('1', 'NO. STRUK: ' . $struk['numreceipt'], '60') . '' . $this->addspc('2', $struk['date'], '30') . "\n";
        $cetak .= "\n";
        $cetak .= $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '45') . '' . $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '60') . '' . $this->addspc('1', 'BLN/TH      : ' . $struk['billPeriod'], '30') . "\n";
        $cetak .= $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '45') . '' . $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '60') . '' . $this->addspc('1', 'STAND METER : ' . $struk['dataReceipt']['standMtr'], '30') . "\n";
        $cetak .= $this->addspc('1', 'PRIODE  : ' . $struk['billPeriod'], '45') . '' . $this->addspc('1', 'ALAMAT  : ' . substr($struk['subscriberAddress'], 0, 48), '60') . '' . $this->addspc('1', 'PEMAKAIAN   : ' . $struk['dataReceipt']['cubMtr'], '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', 'LAIN2   : Rp. ' . number_format($struk['dataReceipt']['NonWaterAmount']), '60') . '' . $this->addspc('1', 'GOL. TARIF  : ' . $struk['subscriberSegmentation'], '30') . "\n";
        $cetak .= $this->addspc('1', 'DENDA   : Rp. ' . $struk['dataReceipt']['penaltyAmount'], '45') . '' . $this->addspc('1', 'DENDA   : Rp. ' . $struk['dataReceipt']['penaltyAmount'], '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'JUMLAH  : Rp. ' . number_format($struk['billAmount']), '45') . '' . $this->addspc('1', 'HRG AIR : Rp. ' . number_format($struk['billAmount']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . '' . $this->addspc('3', 'PDAM menyatakan struk ini sebagai bukti pembayaran yang sah.', '90') . "\n";
        $cetak .= $this->addspc('1', 'ADM BANK: Rp. ' . number_format($struk['admin']), '45') . '' . $this->addspc('1', 'ADMIN BANK*) : Rp. ' . number_format($struk['admin']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'TOTAL   : Rp. ' . number_format($struk['total']), '45') . '' . $this->addspc('1', 'TOTAL BAYAR  : Rp. ' . number_format($struk['total']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', $msg[0], '90') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', $msg[1], '90') . "\n";
        if ($i % 2 == 0) {
            $cetak .= "\n\n\n";
        } else {
            $cetak .= "\n\n";
        }
        return $cetak;
    }

    public function general($struk = null, $i)
    {
        if (!empty($struk['footer'])) {
            $msg = strtoupper($struk['footer']);
        } else {
            $msg = 'TERIMA KASIH';
        }

        $cetak = '';
        $cetak .= $this->getUnicodeChar('initialized');
        $cetak .= $this->getUnicodeChar('fontsize');
        $cetak .= $this->getUnicodeChar('condensedOpen');
        $cetak .= $this->addspc('3', 'STRUK PENERIMA', '45') . '' . $this->addspc('3', $this->getUnicodeChar('boldOpen') . 'STRUK PEMBAYARAN ' . $struk['dataReceipt']['pdam'] . '' . $this->getUnicodeChar('boldClose'), '60') . '' . $this->addspc('2', 'MODE', '30') . "\n";
        $cetak .= $this->addspc('1', $struk['date'], '45') . '' . $this->addspc('1', 'NO. STRUK: ' . $struk['numreceipt'], '60') . '' . $this->addspc('2', $struk['date'], '30') . "\n";
        $cetak .= "\n";
        $cetak .= $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '45') . '' . $this->addspc('1', 'IDPEL   : ' . $struk['subscriberId'], '60') . '' . $this->addspc('1', 'BLN/TH      : ' . $struk['billPeriod'], '30') . "\n";
        $cetak .= $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '45') . '' . $this->addspc('1', 'NAMA    : ' . $struk['subscriberName'], '60') . '' . $this->addspc('1', ' ' . $struk['dataReceipt']['standMtr'], '30') . "\n";
        $cetak .= $this->addspc('1', 'PRIODE  : ' . $struk['billPeriod'], '45') . '' . $this->addspc('1', 'ALAMAT  : ' . substr($struk['subscriberAddress'], 0, 48), '60') . '' . $this->addspc('1', 'QTY   : ' . $struk['dataReceipt']['cubMtr'], '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('1', ' ' . number_format($struk['dataReceipt']['NonWaterAmount']), '60') . '' . $this->addspc('1', 'Segment  : ' . $struk['subscriberSegmentation'], '30') . "\n";
        $cetak .= $this->addspc('1', 'DENDA   : Rp. ' . $struk['dataReceipt']['penaltyAmount'], '45') . '' . $this->addspc('1', 'DENDA   : Rp. ' . $struk['dataReceipt']['penaltyAmount'], '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'JUMLAH  : Rp. ' . number_format($struk['billAmount']), '45') . '' . $this->addspc('1', 'LAIN2 : Rp. ' . number_format($struk['billAmount']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . '' . $this->addspc('3', 'HARAP TANDA TERIMA INI DISIMPAN SEBAGAI BUKTI PEMBAYARAN YANG SAH', '90') . "\n";
        $cetak .= $this->addspc('1', 'ADM BANK: Rp. ' . number_format($struk['admin']), '45') . '' . $this->addspc('1', 'ADMIN BANK*) : Rp. ' . number_format($struk['admin']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', 'TOTAL   : Rp. ' . number_format($struk['total']), '45') . '' . $this->addspc('1', 'TOTAL BAYAR  : Rp. ' . number_format($struk['total']), '60') . '' . $this->addspc('1', '', '30') . "\n";
        $cetak .= $this->addspc('1', '', '45') . '' . $this->addspc('3', $msg, '90') . "\n";
        $cetak .= $this->addspc('1', '', '45') . "\n";
        if ($i % 2 == 0) {
            $cetak .= "\n\n\n";
        } else {
            $cetak .= "\n\n";
        }
        return $cetak;
    }
}
