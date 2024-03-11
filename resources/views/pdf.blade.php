<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday Plan</title>
</head>
<body>
    <h1 style='background-color: #a0aec0; padding: 10px;'>Plan: {{$title}}</h1>
    <table style='border-collapse: collapse; width: 100%;'>
        <thead>
            <tr>
                <th style='border: 1px solid #000; padding: 8px;'>Description</th>
                <th style='border: 1px solid #000; padding: 8px;'>Date</th>
                <th style='border: 1px solid #000; padding: 8px;'>Location</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style='border: 1px solid #000; padding: 8px;'>{{$description}}</td>
                <td style='border: 1px solid #000; padding: 8px;'>{{$date}}</td>
                <td style='border: 1px solid #000; padding: 8px;'>{{$location}}</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <h2>Participants</h2>
    <table style='border-collapse: collapse; width: 100%;'>
        <thead>
        <tr>
            <th style='border: 1px solid #000; padding: 8px;'>Name</th>
            <th style='border: 1px solid #000; padding: 8px;'>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($participants as $particpant)
        <tr>
            <td style='border: 1px solid #000; padding: 8px;'>{{$particpant['name']}}</td>
            <td style='border: 1px solid #000; padding: 8px;'>{{$particpant['email']}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
