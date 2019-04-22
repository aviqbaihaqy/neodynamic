@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row">
            <h1>How to directly Print ESCPOS Commands without Preview or Printer Dialog</h1>

            <div class="col-md-4 col-md-offset-2">
                <hr />
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="useDefaultPrinter" />
                        <strong>Print to Default printer</strong> or...
                    </label>
                </div>
                <div id="loadPrinters">
                    Click to load and select one of the installed printers!
                    <br />
                    <a onclick="javascript:jsWebClientPrint.getPrinters();" class="btn btn-success">Load installed printers...</a>
                    <br />
                    <br />
                </div>

                <div id="installedPrinters" style="visibility: hidden">
                    <label for="installedPrinterName">Select an installed Printer:</label>
                    <select name="installedPrinterName" id="installedPrinterName" class="form-control"></select>
                </div>
            </div>

            <div class="col-md-4">
                <hr/>

                <input class="btn btn-success" type="button" style="font-size:18px"
                       onclick="javascript:jsWebClientPrint.print('useDefaultPrinter=' + $('#useDefaultPrinter').attr('checked') + '&printerName=' + $('#installedPrinterName').val());"
                       value="Print Label..."/>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        var wcppGetPrintersTimeout_ms = 10000; //10 sec
        var wcppGetPrintersTimeoutStep_ms = 500; //0.5 sec

        function wcpGetPrintersOnSuccess() {
            // Display client installed printers
            if (arguments[0].length > 0) {
                var p = arguments[0].split("|");
                var options = '';
                for (var i = 0; i < p.length; i++) {
                    options += '<option>' + p[i] + '</option>';
                }
                $('#installedPrinters').css('visibility', 'visible');
                $('#installedPrinterName').html(options);
                $('#installedPrinterName').focus();
                $('#loadPrinters').hide();
            } else {
                alert("No printers are installed in your system.");
            }
        }

        function wcpGetPrintersOnFailure() {
            // Do something if printers cannot be got from the client
            alert("No printers are installed in your system.");
        }
    </script>


    {!!

    // Register the WebClientPrint script code
    // The $wcpScript was generated by PrintESCPOSController@index

    $wcpScript;

    !!}

@endsection