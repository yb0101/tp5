<?php
namespace app\admin\validate;
use think\Validate;

class Property extends Validate{
    //验证规则
    protected $rule = [
        ['username', 'require', '姓名必填写'],
        ['tel', 'require', '电话必须填写'],
        ['address', 'require', '地址必须填写'],
        ['title', 'require', '标题必须填写'],
    ];
}