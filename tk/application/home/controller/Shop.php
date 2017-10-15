<?php
namespace app\home\controller;
use app\home\model\Document;
use think\Db;

class Shop extends Home{
    //遍历列表
    public function index(){
//        $list=Db::name('document')->where(['category_id'=>45])->paginate(1);
//        var_dump($list);exit;
        $id=45;
        $this->assign('id',$id);
        return $this->fetch('index');
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
    //我的
    public function my(){
        return $this->fetch();
    }
    //服务
    public function fuwu(){
        return $this->fetch();
    }
    //业主认证
    public function yezhurenzheng(){
        return $this->fetch();
    }
    //在线缴费

    //关于我们
    public function about(){
        return $this->fetch();
    }
    //生活贴士
    public function notice(){
        $list=Db::name('document')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //发现
    public function faxian(){
        return $this->fetch();
    }
//AJAX分页
public function more($page=1){
$list=Db::name('document')->where(['category_id'=>45])->paginate(1);
$this->assign('list',$list);
$this->assign('no',++$page);
return $this->fetch();
}
}