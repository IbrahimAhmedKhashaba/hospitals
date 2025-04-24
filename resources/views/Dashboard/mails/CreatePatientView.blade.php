<x-mail::message>
@if($email)
تم إضافتك بنجاح


البريد الإلكتروني: {{ $email }}<br>
كلمة المرور: {{ $password }}<br>
@else
تم معالجة طلبك بنجاح
@endif

تشرف بزيارتنا في المواعيد الآتية
@foreach($appointments as $appointment)
    <p>{{ $appointment->name }}</p>
@endforeach

<x-mail::button :url="url('User/login')">
    Go to Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
