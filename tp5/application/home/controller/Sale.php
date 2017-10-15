<?php
namespace app\home\controller;
use think\Db;

class Sale extends Home{
    //遍历数据
    public function index(){
        $list=Db::name('document')->where(['category_id'=>48,'status'=>2])->select();
        $listt=Db::name('document')->where(['category_id'=>48,'status'=>1])->select();
        //var_dump($list);exit;
        $this->assign('list',$list);
        $this->assign('listt',$listt);
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