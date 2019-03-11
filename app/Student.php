<?php

    namespace App;



    use Illuminate\Database\Eloquent\Model;

    class Student extends Model
    {

        protected $table = 'student';

        //  批量赋值
        protected $filtable = ['name', 'age', 'sex'];

        public $timestamps = true;

        protected function getDateFormat()
        {
            return time();
        }

        protected function asDateTime($val)
        {
            return $val;
        }

    }