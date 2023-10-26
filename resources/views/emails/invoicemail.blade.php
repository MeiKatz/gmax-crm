@component('mail::message')
{{ $invoice->clientdata->name }},

Thank you for choosing {{$settings->companyname}}. We appreciate your business!

We would like to notify you that a new invoice has been created from {{$settings->companyname}}.
Please find the details by clicking view invoice button. 
<br><br>
Invoice id : {{$invoice->invoid}}<br>
Total Amount : {{$invoice->totalamount}}<br>
Paid Amount : {{$invoice->paidamount}}<br>
Due Date : {{$invoice->duedate}}<br>
Invoice Date : {{$invoice->invodate}}<br>



@php $link = URL::to('/')."/invoices/pay/".$invoice->id; @endphp
@component('mail::button', ['url' => $link ,  'color' => 'success'])
View Invoice 
@endcomponent

Thanks,<br>
{{$settings->companyname}}
@endcomponent
