<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户签到</title>
</head>
<body>
<div id ="sign">
                                                      {{--   v-if="show"    {{ score }}--}}
    <button @click="doSign">签到</button> <span >今日已签到，获得积分: 分</span><br><br>

    <table border="1" cellspacing="0">

        <thead>
        <th>总计签到</th>
        <th>总积分</th>
        <th>总签到天数</th>
        </thead>

        <tbody>
       {{-- <tr v-for="sign in sign_list">
            <td>{{ sign.c_days }}</td>
            <td>{{ sign.total_scores }}</td>
            <td>{{ sign.total_days }}</td>
        </tr>--}}
            @foreach($sign_list as $sign)
                <tr>
                    <td>{{ $sign->c_days }}</td>
                    <td>{{ $sign->total_scores }}</td>
                    <td>{{ $sign->total_days }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

<script src="/static/js/vue.js"></script>
<script src="/static/js/jq.js"></script>

<script>

    var sign = new Vue({

        el: "#sign",
        data: {
            show: false,
            score: 0,
            sign_list: []
        },

        created: function(){
            this.list();
        },

        methods: {

            //  获取签名列表
            list:function(){

                var that = this;

                $.ajax({
                    url: "/index/sign/getList",
                    type: "post",
                    dataType: "json",
                    data: {},
                    success:function (res) {
                        if(res.code == 2000){
//                                alert(1);
                            that.sign_list = res.data;
                        }
                    },
                    error:function(){

                    }
                })
            },

            //  执行签名
            doSign:function(){

                var that = this;

                $.ajax({
                    url: "/index/sign/doSign",
                    type: "post",
                    dataType: "json",
                    data: {user_id:1},
                    successs:function(res) {
                        if(res.code == 2000){
                            that.score = res.data.score;

                            that.show = true;

                            that.list();
                        }else{
                            alert(res.msg);
                            return false;
                        }
                    },
                    error:function(){

                    }
                })

            }

        }

    })

</script>
</body>
</html>