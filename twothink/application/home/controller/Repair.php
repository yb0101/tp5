<?php
namespace app\home\controller;
use think\Controller;
use think\Request;

class Repair extends Home {
    //添加在线报修
    public function add(){
    if(request()->isPost()){
        $Repair=model('Repair');
        $post_data=Request::instance()->post();
        $validate=validate('repair');
        if(!$validate->check($post_data)){
            return $this->error($Repair->getError());
        }
        $data=$Repair->create($post_data);
        if($data){
            $this->success('添加成功', url('index'));
            //记录行为
            action_log('update_repair', 'repair', $data->id, UID);
        } else {
            $this->error($Repair->getError());
        }
    } else {
        $pid = input('pid', 0);
        //获取父导航
        if(!empty($pid)){
            $parent = \think\Db::name('Repair')->where(array('id'=>$pid))->field('title')->find();
            $this->assign('parent', $parent);
        }

        $this->assign('pid', $pid);
        $this->assign('info',null);
        $this->assign('meta_title', '新增导航');
        return $this->fetch('add');
    }
        }

}