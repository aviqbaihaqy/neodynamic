<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//*********************************
// IMPORTANT NOTE 
// ==============
// If your website requires user authentication, then
// THIS FILE MUST be set to ALLOW ANONYMOUS access!!!
//
//*********************************

//Includes WebClientPrint classes
use App\Neodynamic\WebClientPrint;
use App\Neodynamic\Utils;
use App\Neodynamic\ClientPrintJob;
use App\Neodynamic\DefaultPrinter;
use App\Neodynamic\UserSelectedPrinter;
use App\Neodynamic\InstalledPrinter;
use App\Neodynamic\ParallelPortPrinter;
use App\Neodynamic\SerialPortPrinter;
use App\Neodynamic\NetworkPrinter;
use Illuminate\Support\Facades\Session;


class DemoPrintCommandsController extends Controller
{
    public function index(){

        $wcpScript = WebClientPrint::createScript(action('WebClientPrintController@processRequest'), action('DemoPrintCommandsController@printCommands'), Session::getId());    

        return view('DemoPrintCommands.index', ['wcpScript' => $wcpScript]);
    }

    public function printCommands(Request $request){
        
       if ($request->exists(WebClientPrint::CLIENT_PRINT_JOB)) {

            //get printer commands
            $printerCommands = urldecode($request->input('printerCommands'));

            //get printer settings
            $printerTypeId = $request->input('pid');
            $clientPrinter = NULL;    
            if ($printerTypeId == '0') //use default printer
            {
                $clientPrinter = new DefaultPrinter();
            }
            else if ($printerTypeId == '1') //show print dialog
            {
                $clientPrinter = new UserSelectedPrinter();
            }
            else if ($printerTypeId == '2') //use specified installed printer
            {
                $clientPrinter = new InstalledPrinter($request->input('installedPrinterName'));
            }
            else if ($printerTypeId == '3') //use IP-Ethernet printer
            {
                $clientPrinter = new NetworkPrinter($request->input('netPrinterHost'), $request->input('netPrinterIP'), $request->input('netPrinterPort'));
            }
            else if ($printerTypeId == '4') //use Parallel Port printer
            {
                $clientPrinter = new ParallelPortPrinter($request->input('parallelPort'));
            }
            else if ($printerTypeId == '5') //use Serial Port printer
            {
                $clientPrinter = new SerialPortPrinter($request->input('serialPort'),
                                                    $request->input('serialPortBauds'),
                                                    $request->input('serialPortParity'),
                                                    $request->input('serialPortStopBits'),
                                                    $request->input('serialPortDataBits'),
                                                    $request->input('serialPortFlowControl'));
            }

            //Create a ClientPrintJob obj that will be processed at the client side by the WCPP
            $cpj = new ClientPrintJob();
            $cpj->clientPrinter = $clientPrinter;
            $cpj->printerCommands = $printerCommands;
            $cpj->formatHexValues = true;

            //Send ClientPrintJob back to the client
            return response($cpj->sendToClient())
                        ->header('Content-Type', 'application/octet-stream');
            
            
        }
    }    
}
