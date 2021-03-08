<html dir="rtl">
    <head>
    <link href="https://sayer.ae/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://sayer.ae/public/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <style>
        body, h1, h2, h3, h4, h5, h6, a, li, label, input, span, button th, td, p ,tr{
            font-family: 'Cairo', sans-serif !important;
        }
        .edit-margin-cancel-button {
            margin: 7px;
        }
    </style>
    <style>
        .square {
        height: 50px;
        width: 50px;
        background-color: #fff;
        border:1px solid black;
        }
        .rectangle {
        height:70px;
        width: 100px;
        background-color: #fff;
        border:2px solid;
        border-color:black;
        text-align:center;
        float:left
        }
        .tn{
        margin-top:15px
        }
        .tt{
        margin-top:2px
        }
        .tf{
        margin-top:10px
        }
        .format{
        color:black;border-bottom: 1pt solid black;border-top: 1pt solid black;border-right: 1pt solid black;border-left: 1pt solid black;
        }
        .formatsendrecive{
        border: none;font-size:20px;color:black
        }
        .formattr{
        color:black;border-bottom: 1pt solid black;border-top: 1pt solid black;border-right: 1pt solid black;border-left: 1pt solid black;
        }
        .formatinnertr{
        border-right: 1pt solid black;border-left: 1pt solid black;
        }
        .formatinnerbuttom{
        border-right: 1pt solid black;border-left: 1pt solid black;border-bottom: 1pt solid black
        }
        .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        }
        .location{
        margin-top:0;
        }
        .table th {
            padding: 0;
        }
        .table td {
            padding: 0;
        }
    </style>
    <style>
        @page {
            size: A5 landscape;
        }
        @page :left {
            /*margin-left: 1cm;*/
        }
    </style>
</head>
<body style="background-color:white" class="">
    <div class="container" >
    <div class="invoice-00001 printarea location" id="printarea" dir="rtl">
        <div class="animated animatedFadeInUp fadeInUp">
            <div class="row inv--head-section">
                <div class="col-sm-1"></div>
                <div class="col-sm-4 col-12 align-self-center text-center">
{{--                    <p>رقم الكوبون: {{ $row->coupon_code }}</p>--}}
                </div>
                <div class="col-sm-3 col-12 align-self-center text-center">
                    @if($row->user->type == 3)
                        <img src="{{ url('dashboard/uploads/users/'.$senderProfile->shop_photo) }}" style="height:70px;width:200px" class="imgcenter">
                    @endif
                </div>
                <div class="col-sm-3 col-12 align-self-center text-center">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row inv--head-section">
            <div class="col-sm-3 col-12">

            </div>
            <div class="col-sm-3 col-12">
            </div>
            </div>
            <div class="row inv--head-section">
                <div class="col-sm-3 col-12">

                </div>
<div class="col-sm-12 col-12 align-self-center text-center">
    <center class="center" style="font-size: 12px;">
        تاريخ الطلب: {{ $row->received_date }}
    </center>
    <center class="center" style="font-size: 12px;">
        نوع الطلب: {{ $row->service->name_ar }}
    </center>
</div>

<div class="col-sm-3 col-12">

</div>

</div>
<div class="row" >
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <center >
            <h6 style="font-weight: bold; font-size: 13px">رقم الطلب : {{ $row->order_number }} رقم التتبع : {{ $row->track_delivery_number }}</h6>
            @if($row->coupon_code !== '' && $row->coupon_code !== null)
                <h6 style="font-size: 13px">رقم الكوبون : {{ $row->coupon_code }}</h6>
            @endif
        </center>
    </div>
    <div class="col-md-2"></div>
</div>
<br/>
<div class="row" >
    <div class="col-2"></div>
    <div class="col-8">
        <table class="table table-bordered" id="customers">

    <tbody style="border-right: 0">

         <tr style="border-top: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
          <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" >المرسل:</th>
          <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive">{{$row->user->type == 3 ? $row->user->profile->shop_name_ar : $row->user->profile->name }}</td>
          <th style="border: none; font-size:15px;color:black;" >المستلم:</th>
          <td style="border: none; font-size:15px;color:black">{{ $row->consignee }}</td>
        </tr>

        <tr style="border-right: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
          <th style="border: none; font-size:14px;color:black;" >الدولة:</th>
          <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive">{{ $senderProfile->country->name_ar }}</td>
            <th style="border: none; font-size:15px;color:black;" >الهاتف:</th>
            <td style="border: none; font-size:15px;color:black;direction: ltr">
                {{ $row->consignee_phone }}
                @if($row->consignee_telephone !== null && $row->consignee_telephone !== '')
                    | {{  $row->consignee_telephone }}
                @endif
            </td>
        </tr>

        <tr style="border-right: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
          <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" >الامارة:</th>
          <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive">
            {{ $senderProfile->city->name_ar }}
          </td>
            <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" >الدولة:</th>
            <td style="border: none; font-size:15px;color:black;padding: .10rem;" class="formatsendrecive">{{ $row->country->name_ar }}</td>
        </tr>

        <tr style="border-right: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
            <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" ></th>
            <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive"></td>
            <th style="border: none; font-size:15px;color:black;" >الامارة:</th>
            <td style="border: none; font-size:15px;color:black">{{ $row->city->name_ar }}</td>
        </tr>

         <tr style="border-right: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
            <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" ></th>
            <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive"></td>
            <th style="border: none; font-size:15px;color:black;" >المنطقة:</th>
            <td style="border: none; font-size:15px;color:black;">{{ $row->state->name_ar }}</td>
        </tr>

         <tr style="border-right: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
          <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" ></th>
          <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive"></td>
             <th style="border: none; font-size:15px;color:black;" >العنوان:</th>
             <td style="border: none; font-size:15px;color:black;">{{ $row->consignee_address }}</td>
         </tr>

         <tr style="border-right: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
          <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" ></th>
          <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive"></td>
             @if($row->home_number !== null && $row->home_number !== '')
                 <th style="border: none; font-size:15px;color:black;" >رقم المنزل :</th>
                 <td style="border: none; font-size:15px;color:black;">{{ $row->home_number }}</td>
             @endif
         </tr>

         <tr style="border-right: 1pt solid black;border-left: none;border-right: none;padding: .10rem;" class="formatinnertr">
          <th style="border: none; font-size:15px;color:black;padding-bottom: 10px" ></th>
          <td style="border: none; font-size:15px;color:black;border-left: 1pt solid black;padding: .10rem;" class="formatsendrecive"></td>
             <th style="border: none; font-size:15px;color:black;" >عدد الاكياس :</th>
             <td style="border: none; font-size:15px;color:black;"> {{ $row->package_number }} , الوزن بالكيلو : {{ $row->weight_in_kilo }} </td>
         </tr>

    </tbody>
    </table>
    </div>
</div>


<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <center style="text-align: right">
            <h6 style="font-weight: bold; font-size: 13px">
                @foreach($row->notes()->get() as $note)
                    <span>{{ $note->name_ar }} ,</span>
                @endforeach
            </h6>
        </center>
    </div>
</div>
<div class="row">
    <div class="col-2"></div>
    <div class="col-3">
        <center style="text-align: right">
            <h6 style="font-weight: bold; font-size: 13px">مبلغ الطلبية : {{ $row->order_price }}</h6>
        </center>
    </div>

    <div class="col-4">
        <center style="text-align: right">
            <h6 style="font-weight: bold; font-size: 13px">رسوم الشحن : {{ $row->service->relValue($row->state_id) }} {{ $row->delivery_amount_from == 1 ? 'الرسوم علي المرسل' : 'الرسوم علي المستقبل' }}</h6>
        </center>
    </div>

    <div class="col-3">
        <center style="text-align: right">
            <h6 style="font-weight: bold; font-size: 13px">الاجمالي : {{ $row->total_price }}</h6>
        </center>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
{{--<script> window.print() </script>--}}

        </div>
    </div>
    </div>
</body>
</html>
