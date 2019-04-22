<?php

namespace App\Http\Controllers;

use App\Neodynamic\ClientPrintJob;
use App\Neodynamic\DefaultPrinter;
use App\Neodynamic\InstalledPrinter;
use App\Neodynamic\WebClientPrint;
use App\Traits\QzDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PpobController extends Controller
{
    use QzDocument;

    public function index()
    {

        $wcpScript = WebClientPrint::createScript(
            action('WebClientPrintController@processRequest'),
            action('PpobController@printCommands'),
            Session::getId());

        return view('ppob.index', ['wcpScript' => $wcpScript]);
    }

    public function text($type)
    {
        $fileName = $type . time() . '_qz.txt';
        $struk = [];

        //default untuk general
        $struk['footer'] = 'MATUR NUWUN';
        $struk['date'] = '22 April 2019';
        $struk['numreceipt'] = '001';
        $struk['billPeriod'] = 'April';
        $struk['billAmount'] = '200000';
        $struk['subscriberId'] = 'X20';
        $struk['subscriberName'] = 'Aviq Baihaqy';
        $struk['subscriberAddress'] = 'Tegal';
        $struk['subscriberSegmentation'] = 'A';
        $struk['admin'] = '002';
        $struk['total'] = '210000';
        $struk['dataReceipt'] = [
            'pdam' => 'PDAM TEGAL',
            'standMtr' => '123',
            'cubMtr' => '200',
            'NonWaterAmount' => '100',
            'penaltyAmount' => '5000',
            'standmeter' => 'meter',
            'msn' => 'msn',
            'Materai' => '6000',
            'PPN' => '10000',
            'PPJ' => '1000',
            'Angsuran' => '20000',
            'RpStromToken' => '20000',
            'JmlKwh' => '2000'
        ];


        switch ($type) {
            default:
            case 'GENERAL':
                $qz_print = $this->general($struk, 1);
                break;
            case 'PDAMSYS':
                $qz_print = $this->pdamSys($struk, 1);
                break;
            case 'TELKOM':

                $struk['swreff'] = 'XXX90909';
                $struk['dataReceipt'][0]['periode'] = 'Januari';
                $struk['dataReceipt'][0]['jmltag'] = '20000';
                $struk['dataReceipt'][1]['periode'] = 'Februari';
                $struk['dataReceipt'][1]['jmltag'] = '20000';
                $struk['dataReceipt'][2]['periode'] = 'Maret';
                $struk['dataReceipt'][2]['jmltag'] = '20000';

                $qz_print = $this->telkom($struk, 1);
                break;
            case 'PLNPREPAID':
                $qz_print = $this->plnPrepaid($struk, 1);
                break;
            case 'PLNPOSTPAID':
                $qz_print = $this->plnPostpaid($struk, 1);
                break;
            case 'PLNNONTAGLIS':
                $qz_print = $this->plnNonTagLis($struk, 1);
                break;
        }

        // file path storage\app\public\struk
        Storage::disk('public')->put('struk/' . $fileName, $qz_print);

        return ['file' => storage_path('public/struk/' . $fileName), 'print' => $qz_print];
    }

    public function printCommands(Request $request)
    {

        if ($request->exists(WebClientPrint::CLIENT_PRINT_JOB)) {

            $useDefaultPrinter = ($request->input('useDefaultPrinter') === 'checked');
            $printerName = urldecode($request->input('printerName'));
            $filetype = $request->input('filetype');

            //Create ESC/POS commands for sample receipt
            $esc = '0x1B'; //ESC byte in hex notation
            $newLine = '0x0A'; //LF byte in hex notation

            $cmds = $this->text($filetype);

            //Create a ClientPrintJob obj that will be processed at the client side by the WCPP
            $cpj = new ClientPrintJob();
            //set ESCPOS commands to print...
            $cpj->printerCommands = $cmds['print'];
            $cpj->formatHexValues = true;

            if ($useDefaultPrinter || $printerName === 'null') {
                $cpj->clientPrinter = new DefaultPrinter();
            } else {
                $cpj->clientPrinter = new InstalledPrinter($printerName);
            }

            //Send ClientPrintJob back to the client
            return response($cpj->sendToClient())
                ->header('Content-Type', 'application/octet-stream');

        }
    }
}
