<!DOCTYPE html>
<html>
<head>
    <title> {!! $email_subject !!}</title>
</head>
<body>

<center>
    <h2>
        {!! $email_subject !!}
    </h2>
</center>

<p>Hi, Sir</p>
<p>{{ $email_message }}</p>

<strong><a href="{{url('/openings/'.$url)}}" type="button">Click to acknowledge!</a></strong>
<p>{{$url}}</p>
</body>
</html>
