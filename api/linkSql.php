
<?php

    function getConn($sql){
        //连接数据库
        $conn = mysqli_connect('127.0.0.1','root','root','bx');
        //连接失败
        if(!$conn){
            die('数据库连接失败...').mysqli_connect_error();
        }
        //设置编码
        mysqli_set_charset($conn,'utf-8');
        //进行增删改
        $res = mysqli_query($conn,$sql);

        //关闭数据库
        mysqli_close($conn);
        //返回数据
        return $res;
    }


    function showData($sql){
        //连接数据库
        $conn = mysqli_connect('127.0.0.1','root','root','bx');
        //判断是否连接失败
        if(!$conn){
            die('数据库连接失败....').mysqli_connect_error();
        }
        //设置编码格式
        mysqli_set_charset($conn,'utf-8');
        //查询
        $res = mysqli_query($conn,$sql);
        //判断查询结果
        $str = '';
        if(!$res){
            $str =  '获取数据失败...';
        }else if(mysqli_num_rows($res)==0){
            $str = '没有任何数据...';
        }else{
            while($data = mysqli_fetch_assoc($res)){
                $arr[] = $data;
            }
            mysqli_close($conn);
            return $arr;
        }
        mysqli_close($conn);
        return false;
    }

?>