
<form methods="post" action="{{url('student/update')}}">
    {{csrf_field()}}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="id" value="<?php echo $res->id ?>">
    姓名：<input type="text" name="name" id="name" value="{{ old('Student')['name'] ? old('Student')['name'] : $res->name }}" placeholder="请输入姓名"><br /><br/>
    年龄：<input type="text" name="age" id="age" value="{{ old('Student')['age'] ? old('Student')['age'] : $res->age }}" placeholder="请输入年龄"><br /><br/>
    {{--性别：
        @foreach($res->sex() as $ind=>$val)
            <label>
                <input type="radio" name="Student[sex]" {{ isset($student->sex) && $student->sex == $ind ? 'checked' : '' }} value="{{ $ind  }}">
                {{ $val }}
            </label>
        @endforeach--}}
        {{--<p>{{ $errors->first('Student.sex ') }}</p>--}}
    {{--<input type="radio" name="Student[sex]" value="0">未知
    <input type="radio" name="Student[sex]" value="1">男
    <input type="radio" name="Student[sex]" value="2">女<br/><br/>--}}
    <input type="submit" value="修改">

</form>