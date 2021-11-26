<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
        *{
            margin: 0;
            box-sizing: border-box;

        }
        body{
            background: #E0E0E0;
            font-family: "Roboto", sans-serif;
            background-image: url("");
            background-repeat: repeat-y;
            background-size: 100%;
        }
        ::selection {background: #f31544; color: #FFF;}
        ::moz-selection {background: #f31544; color: #FFF;}
        h1{
            font-size: 1.5em;
            color: #222;
        }
        h2{font-size: .9em;}
        h3{
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        p{
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoiceholder{
            width:100%;
            hieght: 100%;
            padding-top: 20px;
        }
        #invoice{
            position: relative;
            top: -290px;
            margin: 0 auto;
            width: 700px;
            background: #FFF;
        }

        [id*="invoice-"]{ /* Targets all id with "col-" */
            border-bottom: 1px solid #EEE;
            padding: 30px;
        }
        #invoice-top{min-height: 120px;}
        #invoice-mid{min-height: 120px;}
        #invoice-bot{ min-height: 250px;}

        .logo{
            margin-top: 50px;
            margin-left: 20px;
            margin-right: 10px;
            float: left;
            height: 100px;
            width: 100px;
            background: {{asset('assets/images/logo.png) no-repeat')}};
            background-size: 180px 180px;
        }
        .clientlogo{
            float: left;
            height: 260px;
            width: 260px;
            background: {{asset('assets/images/logo-text.png')}} no-repeat;
            background-size: 166px 88px;
        }
        .info{
            display: block;
            float:left;
            margin-left: 20px;
        }
        .title{
            float: right;
        }
        .title p{text-align: right;}
        #project{margin-left: 52%;}
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td{
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }
        .tabletitle{
            padding: 5px;
            background: #EEE;
        }
        .service{border: 1px solid #EEE;}
        .item{width: 50%;}
        .itemtext{font-size: .9em;}

        #legalcopy{
            margin-top: 30px;
        }
        form{
            float:right;
            margin-top: 30px;
            text-align: right;
        }


        .effect2{
            position: relative;
        }
        .effect2:before, .effect2:after{
            z-index: -1;
            position: absolute;
            content: "";
            bottom: 15px;
            left: 10px;
            width: 50%;
            top: 80%;
            max-width:300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }
        .effect2:after{
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }
        .legal{
            width:70%;
        }
    </style>
</head>
<body>
<div id="invoiceholder">

    <div id="headerimage"></div>
    <div id="invoice" class="effect2">

        <div id="invoice-top">
            <div class="logo"></div>
            <div class="info">
                <p>Please send exact amount: <strong >0.15050000 BTC</strong></p>
                <p >Current exchange rate 1BTC = $6590 USD</p>
            </div><!--End Info-->
            <div class="title">
                <h1>Invoice #1069</h1>
                <p>Issued: May 27, 2015</br>
                    Payment Due: June 27, 2015
                </p>
            </div><!--End Title-->
        </div><!--End InvoiceTop-->

        <div id="invoice-mid">
            <div class="clientlogo"></div>
            <div class="info">
                <h2>Client Name</h2>
                <p>JohnDoe@gmail.com</br>
                    555-555-5555</br>
            </div>
            <div id="project">
                <h2>Project Description</h2>
                <p>Proin cursus, dui non tincidunt elementum, tortor ex feugiat enim, at elementum enim quam vel purus. Curabitur semper malesuada urna ut suscipit.</p>
            </div>
        </div><!--End Invoice Mid-->

        <div id="invoice-bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item"><h2>Item Description</h2></td>
                        <td class="Hours"><h2>Hours</h2></td>
                        <td class="Rate"><h2>Rate</h2></td>
                        <td class="subtotal"><h2>Sub-total</h2></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext">Communication</p></td>
                        <td class="tableitem"><p class="itemtext">5</p></td>
                        <td class="tableitem"><p class="itemtext">$75</p></td>
                        <td class="tableitem"><p class="itemtext">$375.00</p></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext">Asset Gathering</p></td>
                        <td class="tableitem"><p class="itemtext">3</p></td>
                        <td class="tableitem"><p class="itemtext">$75</p></td>
                        <td class="tableitem"><p class="itemtext">$225.00</p></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext">Design Development</p></td>
                        <td class="tableitem"><p class="itemtext">5</p></td>
                        <td class="tableitem"><p class="itemtext">$75</p></td>
                        <td class="tableitem"><p class="itemtext">$375.00</p></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext">Animation</p></td>
                        <td class="tableitem"><p class="itemtext">20</p></td>
                        <td class="tableitem"><p class="itemtext">$75</p></td>
                        <td class="tableitem"><p class="itemtext">$1,500.00</p></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext">Animation Revisions</p></td>
                        <td class="tableitem"><p class="itemtext">10</p></td>
                        <td class="tableitem"><p class="itemtext">$75</p></td>
                        <td class="tableitem"><p class="itemtext">$750.00</p></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext"></p></td>
                        <td class="tableitem"><p class="itemtext">HST</p></td>
                        <td class="tableitem"><p class="itemtext">13%</p></td>
                        <td class="tableitem"><p class="itemtext">$419.25</p></td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td class="Rate"><h2>Total</h2></td>
                        <td class="payment"><h2>$3,644.25</h2></td>
                    </tr>

                </table>
            </div><!--End Table-->

            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="QRZ7QTM9XRPJ6">
                <input type="image" src="http://michaeltruong.ca/images/paypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            </form>

            <div id="legalcopy">
                <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.
                </p>
            </div>

        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->
</div><!-- End Invoice Holder-->

</body>
</html>
