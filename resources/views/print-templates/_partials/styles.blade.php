<style>
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    padding-top: 0px;
    font-size: 11px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    margin-top: 10px;
}
@media only screen {
  .invoice-box {
      border: 1px solid #eee;
  }
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 26px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
    border-top: 2px solid black;
}
.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
    padding-bottom: 40px;
}

.invoice-box table tr.total td:nth-child(5), .invoice-box table tr.total td:nth-child(4) {
    border-top: 2px solid #eee;
}
.details {
    line-height: 0.1;
}
.page_break {
  position: relative;
  display: block;
  height: 10px;
  width: 100%;
  page-break-after: always!important;
}
.heading td, .item td {
    text-align: left!important;
}
.total.last td {
    font-weight: bold;
}
span.address_line {
    display: block;
    line-height: 1.4;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }

    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}
.terms {
    margin-top: 30px;
    margin-bottom: 30px;
}
.terms p {
    text-align: center;
    font-size: 8px;
    line-height: 1.4;
    max-width: 70%;
    margin: auto;
    margin-top: 5px;
}
.branding_col {
    display: flex;
    -webkit-box-align: center!important;
    -ms-flex-align: center!important;
    align-items: center!important;
    height: 70px;
}
.branding {
    background: #404040;
    padding: 25px;
    color: white;
    margin-top: 30px;
    margin-bottom: 30px;
}
.branding img {
    max-width: 130px;
}
.legal {
    text-align: center;
}

/** RTL **/
.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
    text-align: right;
}

.rtl table tr td:nth-child(2) {
    text-align: left;
}
</style>
