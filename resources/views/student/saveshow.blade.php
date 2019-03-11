<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1" cellspacing="0">
        <a href="{{ url('student/create') }}">添加</a><br/>
        <a href="{{ url('student/saveadd') }}">显示</a>
        <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th width="120">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <td>{{ $student->sex }}</td>
                    <td>
                        <a href="savedel?id=<?php echo $student->id ?>" onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                        {{--<a href="{{ url('student/savedel', ['id' => $student->id]) }}" onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>--}}
                        <a href="saveupdate?id=<?php echo $student->id ?>">修改</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div>
        {{-- 分页 --}}
        {{ $students->render() }}
    </div>
</body>
</html>



























