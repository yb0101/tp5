<?php
namespace app\home\controller;
use app\home\model\Active;
use think\Db;

class Activity extends Home {
    //遍历列表
    public function index(){
    $list=Db::name('document')->where(['category_id'=>44])->select();
    //var_dump($list);exit;
    $this->assign('list',$list);
    return $this->fetch('index');
    }
    //查看详情功能
    public function show($id){
        //var_dump($id);
        $list =Db::name('Document')->where(['id'=>$id])->select();
//        if($list->view){
//            $list->view=1;
//        }else{
//            ++{$list['view']};
//        }
        $llist=Db::name('document_article')->find(['id'=>$id]);
        //var_dump($llist);exit;
        $this->assign('llist',$llist);
        $this->assign('list', $list);
        return $this->fetch();

    }
    //活动
    public function active($id){
        //判断是否登录
        if(is_login()){
            //已登录,获取用户信息
            $relation=new Active();
            //根据id查询是否已经报名过了
            $result=Active::get(['uid'=>is_login(),'aid'=>$id]);

            if($result){
                //该活动已经报过名
                echo json_encode(['msg'=>'已报名']);die;
            }else{
                $relation->save(['uid'=>is_login(),'aid'=>$id]);
                echo json_encode(['msg'=>'报名成功']);
            }

        }else{
            //没有登录返回请登录
            echo  json_encode(['msg'=>'请登录']);
        }

    }

}