<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>足球竞猜列表页面</title>
</head>
<body>

    <table style="border:1px #d4d4d4 solid;">
        <thead>
            <tr style="border:1px #d4d4d4 solid;">
                <th style="border:1px #d4d4d4 solid;">比赛时间</th>
                <th style="border:1px #d4d4d4 solid;">球队</th>
                <th style="border:1px #d4d4d4 solid;">操作</th>
            </tr>
        </thead>
        <tdoby style="text-align: center;">

            @if(!empty($list))
                @foreach($list as $key => $value)
                <tr style="height: 35px;line-height: 35px;">
                    <td style="border:1px #d4d4d4 solid;">
                        {{$value['end_at']}}
                        {{--{{strtotime($value['end_at'])}} - {{time()}} --}}
                    </td>
                    <td style="border:1px #d4d4d4 solid;">
                        {{$value['team_a']}} VS {{$value['team_b']}}
                        {{--{{strtotime($value['end_at'])}} - {{time()}} --}}
                    </td>
                    <td style="border:1px #d4d4d4 solid;">
                        @if(strtotime($value['end_at']) > time())
                            <a href="/study/guess/guess?id={{$value['id']}}&user_id={{$user_id}}">竞猜</a>
                        @else
                            <a href="/study/guess/result?id={{$value['id']}}&user_id={{$user_id}}">查看结果</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
        </tdoby>

    </table>

</body>
</html>











