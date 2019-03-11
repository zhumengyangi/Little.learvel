<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonus extends Model
{
    //  红包表
    protected $table = "bs_bonus";


    /**
     * @desc 获取红包信息
     * @param $id
     * @return Model|null|object|static
     */
    public static function getBonusInfo($id)
    {

        $bonus = self::where('id',$id)->first();

        return $bonus;

    }


    /**
     * @param $data 修改的数据
     * @param $id 根据这个id
     * @return bool
     */
    public static function updateBonusInfo($data, $id)
    {
        return self::where('id',$id)->update($data);
    }


    /**
     * @desc  添加红包的函数
     * @param $data
     */
    public static function addBonus($data)
    {

        $res = self::insert($data);

        return $res;

    }


    /**
     * @desc  获取红包列表
     */
    public static function getBonusList()
    {

        $list = self::orderBy('id','desc')
                     ->get()
                     ->toArray();

        return $list;

    }

}
