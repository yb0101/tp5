<?php
namespace app\home\controller;
use think\Db;

class Service extends Home{
    //遍历数据
    public function index(){
        $list=Db::name('document')->where(['category_id'=>47])->select();
        $this->assign('list',$list);
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
    //业主认证
    public function check()
    {

        if(!is_login()){
            $this->redirect('user/login/index');
        }
        //将信息保存到check表中
        if (request()->isPost()) {
            //判断是否有相同名字已经认证过

            $member = model('check');
            $post_data = \think\Request::instance()->post();
            //获取用户UID

            $post_data['uid']=is_login();
            //状态为未审核
            $post_data['status']='未审核';
            //自动验证
            $validate = validate('check');

            if (!$validate->check($post_data)) {
                return $this->error($validate->getError());
            }

            $data = $member->create($post_data);
            if ($data) {
                $this->success('新增成功', url('index'));
            } else {
                $this->error($member->getError());
            }

        }
        return $this->fetch();
    }
    //我报名的活动
    public function activity(){

        $list=\think\Db::name('relation')->where(['uid'=>is_login()])->select();
        /*$uids=[];
        foreach ($list as $k=>$value){
            $uids[$k]=$value['aid'];
        }
        //根据uids查询出所有活动
        //$map = array('id' => array('in', $id) );//['id'=>['in',$id]]
        $activities= \think\Db::name('document')->where(['id'=>['in',$uids]])->select();*/
        $this->assign('list',$list);
        //$this->assign('activities',$activities);
        return $this->fetch();
    }
}
