<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class Guess extends Model
{

    //  连接表名
    protected $table = "study_guess";

    //  不维护时间字段
    public $timestamps = false;


    /**
     * @desc  添加
     * @param $data
     * @return bool
     */
    public function add($data)
    {

        return self::insert($data);

    }


    /**
     * @desc  查看列表
     * @return array
     */
    public function getList()
    {

        return self::select('id','team_a','team_b','end_at','result')
                    ->orderBy('end_at','desc')
                    ->get()
                    ->toArray();


//        return self::get()->toArray();

    }


    /**
     * @desc 获取一条数据
     * @param $data
     * @return bool
     */
    public function getInfo($id)
    {

        return self::where('id',$id)->first();

    }


}
