<?php
namespace app\admin\controller;
use think\Request;

class 	Property extends Admin{
//物业展示列表
public function index(){
    $pid = input('get.pid', 0);
    /* 获取频道列表 */
    $map  = array('status' => array('gt', -1), 'pid'=>$pid);
    //var_dump($map);exit;
    $list = \think\Db::name('Property')->select();
    //var_dump($list);exit;
    $this->assign('list', $list);
    $this->assign('pid', $pid);
    $this->assign('meta_title' , '保修管理');
    return $this->fetch('index');
}
//添加
public function add()
{
    //var_dump($this->request->post());exit;
    if (request()->isPost()) {//如果是POST传值
        $Property = model('Property');//先NEW一个模型
        $post_data = Request::instance()->post();//加载数据
        //自动验证
        $validate = validate('Property');
        if(!$validate->check($post_data)){
            return $this->error($validate->getError());
        }
        $post_data['create_time']=time();
        $data = $Property->insert($post_data);
        //var_dump($data);exit;
        if ($data) {
            $this->success('添加成功', url('index'));
            //记录行为
            action_log('update_property', 'Property', $data->id, UID);//相等于添加命令
        } else {
            $this->error($Property->getError());
        }
    } else {
        $this->assign('info', array('pid' => input('pid')));
        $propertys = \think\Db::name('Property')->field(true)->select();
        $propertys = model('Common/Tree')->toFormatTree($propertys);
        $propertys = array_merge(array(0 => array('id' => 0, 'title_show' => '顶级菜单')), $propertys);
        $this->assign('Propertys', $propertys);
        $this->assign('meta_title', '新增菜单');
        return $this->fetch('edit');
    }
}
//删除功能
public function del(){
    $id = array_unique((array)input('id/a',0));

    if ( empty($id) ) {
        $this->error('请选择要操作的数据!');
    }

    $map = array('id' => array('in', $id) );
    if(\think\Db::name('Property')->where($map)->delete()){
        session('admin_menu_list',null);
        //记录行为
        action_log('update_porperty', 'Property', $id, UID);
        $this->success('删除成功');
    } else {
        $this->error('删除失败！');
    }
}
//编辑功能
    public function edit($id = 0){
        if(request()->isPost()){
            $Property = model('Property');
            $post_data=$this->request->post();
            $post_data['create_time']=time();
            $data = $Property->update($post_data);
            if($data){
                session('admin_property_list',null);
                //记录行为
                action_log('update_property', 'Property', $data->id, UID);
                $this->success('更新成功', Cookie('__forward__'));
            } else {
                $this->error($Property->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('Property')->field(true)->find($id);
            $propertys = \think\Db::name('Property')->field(true)->select();
            $propertys = model('Common/Tree')->toFormatTree($propertys);

            $propertys = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $propertys);
            $this->assign('Propertys', $propertys);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            $this->assign('info', $info);
            $this->assign('meta_title', '编辑后台菜单');
            return $this->fetch('edit');
        }
    }
}