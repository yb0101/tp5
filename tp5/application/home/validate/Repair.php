<?php
namespace app\home\validate;
use think\Validate;
class Repair extends Validate{
     protected $rule =[
         ['username', 'require', '姓名必填写'],
         ['tel', 'require', '电话必须填写'],
         ['address', 'require', '地址必须填写'],
         ['title', 'require', '标题必须填写'],
     ];
}