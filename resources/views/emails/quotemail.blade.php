@component('mail::message')
{{ $invoice->client->name }},

Thank you for choosing {{$settings->companyname}}. We appreciate your business!

We would like to notify you that a new quotation has been created from {{$settings->companyname}}.
Please find the details by clicking view quote button. 



@component('mail::button', [
  'url' => route('viewquotepublic', [ $invoice ]),
  'color' => 'success',
])
View Quote 
@endcomponent

Thanks,<br>
{{$settings->companyname}}
@endcomponent
