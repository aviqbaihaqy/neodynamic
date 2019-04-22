<?php

namespace App\Http\Controllers;

use App\TagihanSiswa;
use Illuminate\Http\Request;
use SanderVanHooft\Invoicable\Invoice;

class TransaksiController extends Controller
{
    public function index()
    {
        $tagihanSiswa = TagihanSiswa::create([
            'sekolah_id' => '69754354',
            'rekening_id' => '11',
            'peserta_didik_id' => '709',
            'jumlah' => '505000',
            'potongan' => '0',
            'ppn' => '0',
            'sub_total' => '505000',
            'total' => '505000',
            'pemutihan_id' => null,
            'uraian' => '',
            'keterangan' => 'test',
        ]);

        $invoice = $tagihanSiswa->invoices()->create([]);

        // To add a line to the invoice, use these example parameters:
//  Amount:
//      121 (€1,21) incl tax
//      100 (€1,00) excl tax
//  Description: 'Some description'
//  Tax percentage: 0.21 (21%)
        $invoice = $invoice->addAmountInclTax(121, 'Some description', 0.21);
        $invoice = $invoice->addAmountExclTax(100, 'Some description', 0.21);

// Invoice totals are now updated
        echo $invoice->total; // 242
        echo $invoice->tax; // 42

// Set additional information (optional)
        $invoice->currency; // defaults to 'EUR' (see config file)
        $invoice->status; // defaults to 'concept' (see config file)
        $invoice->receiver_info; // defaults to null
        $invoice->sender_info; // defaults to null
        $invoice->payment_info; // defaults to null
        $invoice->note; // defaults to null

// access individual invoice lines using Eloquent relationship
//        $invoice->lines;
//        $invoice->lines();

// Access as pdf
//        return $invoice->download(); // download as pdf (returns http response)
//        return $invoice->pdf(); // or just grab the pdf (raw bytes)

// Handling discounts
// By adding a line with a negative amount.
//        $invoice = $invoice->addAmountInclTax(-121, 'A nice discount', 0.21);

// Or by applying the discount and discribing the discount manually
//        $invoice = $invoice->addAmountInclTax(121 * (1 - 0.30), 'Product XYZ incl 30% discount', 0.21);

// Convenience methods
//        Invoice::findByReference($reference);
//        Invoice::findByReferenceOrFail($reference);
//        $invoice->invoicable(); // Access the related model
    }
}
