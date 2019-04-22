<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SanderVanHooft\Invoicable\IsInvoicable\IsInvoicableTrait;


class TagihanSiswa extends Model
{
    use IsInvoicableTrait;

    protected $table = 'tagihan_siswa';

    protected $fillable = [
        'sekolah_id','rekening_id','peserta_didik_id','jumlah','potongan','ppn','sub_total','total','pemutihan_id','uraian','keterangan'
    ];
}
