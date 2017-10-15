<?php
namespace app\home\controller;
use think\Db;

class Notice extends Home{
    public function index(){
        $list = \think\Db::name('Document')->select();
        //var_dump($list);exit;
        $this->assign('list', $list);
        return $this->fetch();
    }
    //查看详情功能
    public function show($id){
        //var_dump($id);
        $list =Db::name('Document')->where(['id'=>$id])->select();
        $llist=Db::name('document_article')->find(['id'=>$id]);
        //var_dump($llist);exit;
        $this->assign('llist',$llist);
       $this->assign('list', $list);
        return $this->fetch();
    }
}