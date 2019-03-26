<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZhoukController extends Controller
{

    /**
     * 显示静态资源列表
     */
    public function demo()
    {
//        echo '123';die;
        return view('demo');
    }


    /**
     * @desc 执行签到的操作
     * @param Request $request
     */
    public function doSing(Request $request)
    {

        //  接收传递过来的参数
        $params = $request->all();

        $return = [
            'code' => 2000,
            'msg'  => '签到成功',
            'data' => []
        ];

        //  传递用户ID
        $userId = $params['user_id'];

        //  判断用户是否传递用户Id
        if(!isset($userId) || empty($userId)){

            $return = [
                'code' => 4001,
                'msg'  => '用户Id不能为空'
            ];

            return json_encode($return);

        }


        //  获取今天的日期
        $today = date('Y-m-d');

        //  根据当前用户Id查询签到数据
        $sign1 = DB::query('select * from zhouk where user_id = ?',[ $userId ]);

        //  判断重复签到
        if(!empty($sign1) && $sign1[0]['last_date'] == $today){

            $return = [
                'code' => 4002,
                'msg'  => '亲，今日您已经签到过，请明天再来'
            ];

            return json_encode($return);

        }


        //  第一次签到的时候
        if(empty($sign1)){

            $data = [
                'user_id' => $userId,
                'c_days' => 1,
                'total_sores' => 1,
                'total_days' => 1,
                'last_date' => $today,
            ];

            DB::table('zhouk')->insert($data);

            $return['data']['score'] = 1;

            return json_encode($return);

        }else{

            //  昨天的日期
            $last_day = date('Y-m-d', time()-3600*24);

            //  连续签到
            if($last_day == $sign1[0]['last_date']){

                //  连续签到的天数
                $c_days = $sign1[0]['c_days'] + 1;

            }else{

                //  非连续签到初始化为1
                $c_days = 1;

            }

            $total_scores = $sign1[0]['total_scores'] + $c_days;

            $total_days = $sign1[0]['total_days'] + 1;

            DB::query('update zhouk set c_days = ?, total_scores = ?, total_days = ?, last_date = ? where user_id = ?',[ $c_days, $total_scores, $total_days, $today, $userId]);

            $return['data']['score'] = $c_days;

            return json_encode($return);

        }

    }


    /**
     * @desc 签到的列表
     * @return string
     */
    public function getList()
    {

        $sign = DB::query('select * from zhouk');

        $return = [
            'code' => 2000,
            'msg'  => '签到成功',
            'data' => $sign
        ];

        return json_encode($return);

    }



}
