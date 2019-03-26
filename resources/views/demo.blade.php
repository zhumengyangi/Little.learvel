<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户签到</title>
</head>
<body>

    <div id="sign">

        <button @click="doSign">签到</button><span >今日已签到，获得积分：{{ 3 }} 分</span>
        <br><br>

        <table border="1" cellspacing="0">

            <thead>
                <th>总计签到</th>
                <th>最近连续签到</th>
                <th>获得积分</th>
            </thead>

            <tbody>
                {{--@foreach()--}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                {{--@endforeach--}}
            </tbody>

        </table>

    </div>
    <script src="/js/jq.js"></script>
    <script src="/js/vue.js"></script>
    <script>

        var sign = new Vue({

            el: "#sing",
            data: {
                show: false,
                score: 0,
                sign_list: []
            },

            //  构造函数
            created:function () {
                this.list();
            },

            methods: {

                //  获取签名列表
                list:function () {

                    var that = this;

                    $.ajax({
                        url: "/zhouk/getList",
                        type: "post",
                        dataType: "json",
                        data: {},

                        success:function (res) {
                            if(res.code == 2000){
                                that.sign_list = res.data;
                            }
                        },

                        error:function () {

                        }
                    })
                },


                //  执行签名
                doSign:function () {

                    var that = this;

                    $.ajax({
                        url: "/zhouk/doSign",
                        type: "post",
                        dataType: "json",
                        data: {user_id: 1},

                        success:function (res) {
                            if(res.code == 2000){
                                that.score = res.data.score;

                                that.show = true;

                                that.list();
                            }else{
                                alert(res.msg);
                                return false;
                            }
                        },

                        error:function () {

                        }
                    })

                }

            }

        })

    </script>
</body>
</html>