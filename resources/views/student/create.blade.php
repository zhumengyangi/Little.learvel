

    {{-- {{ url('student/save') }} --}}
        <form methods="post" action="{{url('student/saveadd')}}">
            {{csrf_field()}}
            姓名：<input type="text" name="Student[name]" id="name" placeholder="请输入姓名"><br /><br/>
            年龄：<input type="text" name="Student[age]" id="name" placeholder="请输入姓名"><br /><br/>
            性别：
                  <input type="radio" name="Student[sex]" value="0">未知
                  <input type="radio" name="Student[sex]" value="1">男
                  <input type="radio" name="Student[sex]" value="2">女<br/><br/>
            <input type="submit" value="添加">

        </form>

