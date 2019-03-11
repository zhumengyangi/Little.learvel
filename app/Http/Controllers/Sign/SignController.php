<?php

namespace App\Http\Controllers\Sign;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class SignController extends Controller
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
//        echo '123';exit;
        return view('sign.index');
    }

    /**
     * 执行签到操作
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function doSign(Request $request)
    {
        //接收传递的参数
        $params = $request->param();

        $return = [
            'code' => 2000,
            'msg'  => '签到成功',
            'data' => [],
        ];


        //  判断是否传递用户ID
        if(!isset($params['user_id']) || empty($params['user_id'])){

            $return = [
                'code' => 4001,
                'msg'  => '用户ID不能为空'
            ];

            return json_encode($return);

        }

        $userId = $params['user_id'];


        //  获取今天的日期
        $today = date('Y-m-d');


//        $info = DB::table('student')->insert($data);

        //  根据当前用户ID查询签到数据
        $sign1 = DB::query('select * from sign_info where user_id = ?',[ $userId ]);


        //  重复签到
        if(!empty($sign1) && $sign1[0]['last_date'] == $today){

            $return = [
                'code' => 4002,
                'msg'  => '亲，今日您已签到过，请明天再来'
            ];

//            Log::info('亲，今日您已签到过，请明天再来');

            return json_encode($return);

        }

        //  第一次签到的时候
        if(empty($sign1)){

//            $data = $request->except('_token');

//            $info = DB::table('student')->insert($data);

//            $data = array('user_id' => $userId, 'c_days' => 1, 'total_scores' => 1, 'total_days' => 1, 'last_date' => $today);

//            DB::table('sign_info')->insert($data);

            DB::query('insert into sign_info (user_id, c_days, total_scores, total_days, last_date) values(?, ?, ?, ?, ?)',[ $userId, 1, 1, 1, $today]);

            $return['data']['score'] = 1;

            //  打印日志
//            Log::info('第一次签到的时候');

            return json_encode($return);

        }else{

            //  昨天的日期
            $last_day = date('Y-m-d', time()-3600*24);

            //  连续签到
            if($last_day == $sign1[0]['last_date']){

                //  连续签到的天数
                $c_days = $sign1[0]['c_days'] + 1;

//                Log::info('连续签到的时候');

            }else{

                $c_days = 1;

//                Log::info('非连续签到的时候');

            }

            $total_scores = $sign1[0]['total_scores'] + $c_days;

            $total_days = $sign1[0]['total_days'] + 1;


//            $arr = array('c_days' => $c_days, 'total_scores' => $total_scores, 'total_days' => $total_days, 'last_date' => $today);

//            DB::table('sign_info')->where('user_id', '=', $userId)->update($arr);

            DB::query('update sign_info set c_days = ?, total_scores = ?, total_days = ?, last_date = ? where user_id = ?',[ $c_days, $total_scores, $total_days, $today, $userId]);

            $return['data']['score'] = $c_days;

            return json_encode($return);

        }

        //        return json($return);
    }


    /**
     * 签名的列表
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function getList()
    {
        $sign = DB::query('select * from sign_info');
//        $sign = DB::select('select * from sign_info');

        $return = [
            'code' => 2000,
            'msg'  => '签到成功',
            'data' => $sign
        ];

        return json_encode($return);

    }


}
