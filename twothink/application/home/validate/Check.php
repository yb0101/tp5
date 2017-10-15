<?php
namespace  app\home\validate;
use think\Validate;

class Check extends Validate {
    protected $rule =[
        ['name', 'require', '姓名必填写'],
        ['tel', 'require', '电话必须填写'],
        ['room', 'require', '地址必须填写'],
        ['id_nu', 'require', '标题必须填写'],
    ];
}