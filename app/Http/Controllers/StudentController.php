<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/2/27
 * Time: 16:27
 */
    namespace App\Http\Controllers;

//    use Illuminate\Filesystem\Cache;
    use Mail;
    use App\Student;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
//    use Illuminate\Support\Facades\Request;

    use Illuminate\Support\Facades\Storage;
    use PHPMailer\PHPMailer\PHPMailer;
    use Session;

    use Illuminate\Support\Facades\Cache;


    class StudentController extends Controller
    {

        //  学生列表页
        public  function index()
        {

            //  分页
            $students = Student::paginate(5);

            return view('student.index',[
                'students' => $students,
            ]);

        }


        //  添加展示页面
        public function create()
        {
            return view('student.create');
        }

        //  保存添加
       /* public function save()
        {
            return view('student.index');
        }*/

        //  添加
        public function saveadd(Request $request)
        {

            $data = $request->except('_token');

            $info = DB::table('student')->insert($data);

//            dd($info);die;
            if($info){
//                echo '对';die;
//                return redirect('student.saveshow');
//                return view('student.saveshow');
//                echo "成功";
//                 view('student.saveshow');
//                 return redirect::to("student.saveshow");
                return redirect('student/saveshow');
            }else{
//                echo '错';die;
                return redirect()->back();
            }

        }

        //  展示
        public function saveshow()
        {

//            $info = DB::table('student')->select();
//            $info = DB::table('student')->select('*')->get();

            $info= DB::select("select * from student");
//                $info = DB::select('select * from student where id > ?',[10]);
//            dd($info);

//            dd($info);die;

            $students = Student::paginate(3);

            return view('student.saveshow',[
                'students' => $students,
            ]);

            /*if($info){
                echo 123;die;
                return view('student.index',$info);
            }*/

//            dd($info);

        }

        //  删除
        public function savedel()
        {

            $id = $_GET['id'];
            $res = DB::table('student')->where('id',$id)->delete();
            if($res){
                return redirect('student/saveshow');
            }

        }


        //  修改页面
        public function saveupdate()
        {
           $id = $_GET['id'];
           $res = DB::table('student')->where('id',$id)->first();
           return view('student/update',['res' => $res]);

        }


        //  修改数据
        public function update(Request $request)
        {

            $data = $request->except('_token');

            $id = $data['id'];

            $name = $data['name'];
            $age = $data['age'];
//            $sex = $data['id'];

            $arr = array('id' => $id, 'name' => $name, 'age' => $age);

            $res = DB::table('student')->where('id','=',$id)->update($arr);

            if($res){
                return redirect('student/saveshow');
            }

        }




        //  上传文件
        public function upload(Request $request)
        {

            if($request->isMethod('POST')){
//                var_dump($_FILES);exit;
                $file = $request->file('source');
//                dd($file);exit;

                //  判断文件是否上传成功
                if($file->isValid()){
//                    dd($file);die;
                    //  文件原名字
                    $originalName = $file->getClientOriginalName();
                    //  文件扩展
                    $ext = $file->getClientOriginalExtension();
                    //  文件类型
                    $type = $file->getClientMimeType();
                    //  临时文件的绝对路径
                    $realPath = $file->getRealPath();

                    //echo $realPath;exit;

                    $filename = date('YmdHis') . '-' . uniqid() . '-' . $ext;

                    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));

                    var_dump($bool);
                }
                exit;
            }


            return view('student.upload');
        }


        //      缓存文件在: /storage/framework/cache
        public function cache1()
        {

            //  使用php去链接reids对象
            $redis = new \Redis();
            $redis->connect('127.0.0.1',6379);


            // 保存对象到缓存中  put(Kay , Val, 过期时间)
            Cache::put('key1', 'val1' , 10);

            //  存在不可以添加 不存在可以添加add()
//            $bool = Cache::add('key1', 'val2', 10);
//            var_dump($bool);

            //  永久保存到缓存中 forever()
//            Cache::add('key1', 'val2');

            //  判断Kay 是否存在
          /*  if(Cache::has('key1')){
                $val = Cache:;get('key3');
                var_dump($val);
            }else{
                echo 'No';
            }*/

        }

        //
        public function cache2()
        {
            //  查看缓存 get()
//            $val = Cache::get('key1');

            //  取出缓存 并删除 pull()
//            $val = Cache::pull('key1');

            //  从缓存中删除对象 forget()
//            $bool = Cache::forget('key1');


//            var_dump($val);
        }


    }
































