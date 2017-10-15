<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/shop\more.html";i:1507443450;}*/ ?>
<?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
<button class="btn btn-primary btn_load">哥，真没啦</button>
<?php else: ?>
<div class="container-fluid">
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$document): $mod = ($i % 2 );++$i;?>
    <div class="row noticeList">
        <a href="<?php echo url('Shop/show?id='.$document['id']); ?>">
            <div class="col-xs-2">
                <img class="noticeImg" src="/image/1.png" />
            </div>
            <div class="col-xs-10">
                <p class="title"><?php echo $document['title']; ?></p>
                <p class="intro"><?php echo $document['description']; ?></p>
                <p class="info">浏览: <?php echo $document['view']; ?> <span class="pull-right"><?php echo date('Y-m-d',$document['create_time']); ?></span> </p>
            </div>
        </a>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<button class="btn btn-primary btn_load" data-toggle="collapse" onclick="LoadPage(<?php echo $no; ?>)">点击获取更多</button>
<?php endif; ?>