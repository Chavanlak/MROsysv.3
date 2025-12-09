{{-- 
@component('mail::message')
{{$NotiData['title']}}


@component('mail::panel')
เมลสาขา: {{ $NotiData['branch'] }}
เเจ้งซ่อมจากสาขา: {{ $NotiData['branchname'] }}
ผู้แจ้ง: {{ $NotiData['name'] }}
@endcomponent


@component('mail::panel')
เมลโซน: {{ $NotiData['zone'] }}
ผู้ดูแล: {{ $NotiData['staffname'] }}


@endcomponent


@component('mail::panel')
เเจ้งปัญหา {{ $NotiData['equipmentname'] }}

รายละเอียด:{{ $NotiData['detail'] }}
@endcomponent


@component('mail::button', ['url' => $NotiData['linkmail']])
ไฟล์การเเจ้งซ่อม
@endcomponent


@if(isset($NotiData['img']) && !empty($NotiData['img']))
Noti-picture data:

@foreach ($NotiData['img'] as $imgitem)
<img src="data:image/jpeg;base64,{{ $imgitem }}" width="100" height="100">

@endforeach
@endif

@endcomponent --}}


 @component('mail::message')
{{$NotiData['title']}}


@component('mail::panel')
**ผู้แจ้ง:** {{ $NotiData['name'] }}

**เเจ้งซ่อมจากสาขา:** {{ $NotiData['branchname'] }}

**Email:** {{ $NotiData['branch'] }}
@endcomponent


@component('mail::panel')
**Zone Manager:** {{ $NotiData['staffname'] }}

**Email:** {{ $NotiData['zone'] }}


@endcomponent


@component('mail::panel')
**เเจ้งปัญหา:** {{ $NotiData['equipmentname'] }}

**รายละเอียด:** {{ $NotiData['detail'] }}
@endcomponent

{{-- @component('mail::button', ['url' => $NotiData['linkmail']])
ไฟล์การเเจ้งซ่อม
@endcomponent --}}
@component('mail::button', [
    'url' => $NotiData['linkmail'],
    'color' => 'success'
])
📂 เปิดไฟล์การแจ้งซ่อม
@endcomponent




@if(isset($NotiData['img']) && !empty($NotiData['img']))
Noti-picture data:

@foreach ($NotiData['img'] as $imgitem)
<img src="data:image/jpeg;base64,{{ $imgitem }}" width="100" height="100">

@endforeach
@endif

@endcomponent

