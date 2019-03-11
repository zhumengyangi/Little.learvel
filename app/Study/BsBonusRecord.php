<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonusRecord extends Model
{
    //  用户抢到红包的记录表
    protected $table = "bs_bonus_record";


    /**
     * @desc 创建一条记录
     * @param $data 创建的记录的数据
     * @return
     */
    public static function createRecord($data)
    {

        $res = self::insert($data);

        return $res;

    }


    /**
     * @desc 获取最大金额的红包
     * @param $bonusId 红包Id
     * @return Model|null|static
     */
    public static function getMaxBonus($bonusId)
    {

        $res = self::select('id')
             ->where('bonus_id',$bonusId)
             ->orderBy('money', 'desc')
             ->first();

        return $res;
    }


    /**
     * @desc  更新红包的记录
     * @param 需要更新的数据
     * @param 红包ID
     * @return
     */
    public static function updateBonusRecord($data, $id)
    {
        return self::where('id', $id)->update($data);
    }


    /**
     * @desc 通过用户id和红包id获取红包的记录
     * @param $userId  用户ID
     * @param $bonusId 红包Id
     * @return
     */
    public static function getRecordById($userId, $bonusId)
    {

        return self::where('user_id', $userId)
                ->where('bonus_id', $bonusId)
                ->first();

    }



    /**
     * @desc  获取红包记录的列表
     * @param $bonusId
     */
    public static function getBonusRecord($bonusId)
    {

        return self::where('bonus_id', $bonusId)
                     ->get()
                     ->toArray();

    }
}
