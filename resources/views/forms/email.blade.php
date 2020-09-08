<b>IFLY</b><br/>

@if($email->instructor)
<div>
<p><b>Хочу записаться к инструктору! Его имя:</b>&nbsp;{{$email->instructor}}</p>
</div>
@endif
 
<div>
<p><b>Имя:</b>&nbsp;{{$email->name}}</p>
</div>
 
<div>
<p><b>Фамилия:</b>&nbsp;{{$email->fname}}</p>
</div>

<div>
<p><b>Телефон:</b>&nbsp;{{$email->tel}}</p>
</div>

<div>
<p><b>Email:</b>&nbsp;{{$email->email}}</p>
</div>
 
<div>
<p><b>Сообщение:</b>&nbsp;{{$email->text}}</p>
</div>
 