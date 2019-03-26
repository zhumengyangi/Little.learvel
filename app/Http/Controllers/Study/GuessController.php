<?php

namespace App\Http\Controllers\Study;

use App\Study\Guess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GuessController extends Controller
{

    /**
     * @desc 足球竞猜添加页面
     */
    public function add()
    {

        return view('study.guess.add');

    }


    /**
     * @desc  添加竞猜
     * @param Request $request
     */
    public function doAdd(Request $request)
    {


        //  获取全部参数
        $params = $request->all();

//        dd($params);

        //  实例化
        $guess = new Guess();

        //  赋值
        $data = [
            'team_a' => $params['team_a'],
            'team_b' => $params['team_b'],
            'end_at' => $params['end_at'],
        ];

        //  执行方法
        $guess->add($data);

        return redirect('/study/guess/list?user_id=1');

    }


    /**
     * @desc  列表页面
     * @param Request $request
     */
    public function list(Request $request)
    {

        //  获取全部参数
        $params = $request->all();

        //  实例化
        $guess = new Guess();

        //  调用该方法
        $assign['list'] = $guess->getList();

        //  默认为 1
        $assign['user_id'] = isset($params['user_id']) ?? 1;

        //  返回
        return view('study.guess.list',$assign);

    }


    /**
     * @desc 竞猜
     * @param Request $request
     */
    public function guess(Request $request)
    {

        $params = $request->all();

        $guess = new Guess();

        $assign['info'] = $guess->getInfo($params['id']);

        $assign['user_id'] = isset($params['user_id']) ?? 1;

        return view('study.guess.guess', $assign);

    }


    /**
     * @desc 执行添加页面
     * @param Request $request
     */
    public function doGuess(Request $request)
    {

        //  获取全部的参数
        $params = $request->all();

        //  删除没有用的token
        unset($params['_token']);

        //  查找数据
        $data = DB::table('study_guess_record')->where(['user_id' => $params['user_id'], 'team_id' => $params['team_id']])->first();

        //  判断是否为空
        if(empty($data)){ //  空 插入
            DB::table('study_guess_record')->insert($params);
        }else{          //  非空 修改
            DB::table('study_guess_record')->where('id',$data->id)->update($params);
        }

        //  返回
        return redirect('/study/guess/list?user_id=1');
    }


    /**
     * @desc  查询结果
     * @param Request $request
     */
    public function checkResult(Request $request)
    {

        //  获取全部记录
        $params = $request->all();

        //  实例化
        $guess = new Guess();

        //  拿到对应的id
        $assign['info'] = $guess->getInfo($params['id']);

        //  查询该条记录
        $assign['first'] = DB::table('study_guess_record')->where(['user_id' => $params['user_id'], 'team_id' => $params['id']])->first();



        //  返回
        return view('study.guess.result',$assign);

    }


}
