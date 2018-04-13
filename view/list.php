<?php
$root_path = get_absolute_path(dirname($_SERVER['SCRIPT_NAME'])) . config('root_path');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>下载站&nbsp;<?php echo urldecode($path); ?></title>
    <link href="view/css/bootstrap.min.css" rel="stylesheet">
    <link href="view/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <style type="text/css">
        .conent {
            font-size: 16px;
        }
        .bago {
            font-size: 25px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">逗比极客</a>
                </div>
            </div>
        </nav>
        <div class="col-md-12 conent">
            <h1 class="breadcrumb">Index of &nbsp;<?php echo urldecode($path); ?></h1>
            <table class="table table-striped">
                <tr>
                    <th class="file-name">Name</th>
                    <th class="file-size">Size</th>
                    <th class="file-date-created">Date Created</th>
                    <th class="file-date-modified">Date Modified</th>
                </tr>
                <?php if($path != '/'):?>
                    <tr>
                        <td class="file-name"><span class="fa fa-folder-open">&nbsp;&nbsp;&nbsp;</span>
                            <a class="bago" href="<?php echo get_absolute_path($root_path.$path.'../');?>">..</a>
                        </td>
                        <td class="file-size"></td>
                        <td class="file-date-created"></td>
                        <td class="file-date-modified"></td>
                    </tr>
                <?php endif;?>
                <?php foreach((array)$items as $item):?>
                    <?php if(!empty($item['folder'])):?>
                        <tr>
                            <td class="file-name"><span class="fa fa-folder-open">&nbsp;&nbsp;&nbsp;</span><a href="<?php echo get_absolute_path($root_path.$path.$item['name']);?>"><?php echo $item['name'];?>/</a></td>
                            <td class="file-size"><?php echo $item['size'];?></td>
                            <td class="file-date-created"><?php echo date("Y-m-d H:i:s", $item['createdDateTime']);?></td>
                            <td class="file-date-modified"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']);?></td>
                        </tr>
                    <?php else:?>
                        <tr>
                            <td class="file-name"><span id="so" class="fa">&nbsp;&nbsp;&nbsp;</span><a id="file" href="<?php echo get_absolute_path($root_path.$path).$item['name'];?>"><?php echo $item['name'];?></a></td>
                            <td class="file-size"><?php echo $item['size'];?></td>
                            <td class="file-date-created"><?php echo date("Y-m-d H:i:s", $item['createdDateTime']);?></td>
                            <td class="file-date-modified"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']);?></td>
                        </tr>
                    <?php endif;?>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div>
</body>
<script>
    $(function () {
        var str = document.getElementById('file').innerText;
        if (str.indexOf('.ass') >=0) {
            $("span#so").addClass('fa-file-text');
        }
        else if (str.indexOf('.apk') >= 0) {
            $('span#so').addClass('fa-android');
        }
        else if (str.indexOf('.dmg') >= 0) {
            $('span#so').addClass('fa-apple');
        }
        else if (str.indexOf('.exe') >= 0) {
            $('span#so').addClass('fa-windows');
        }
        else if (str.indexOf('.iso') >= 0) {
            $('span#so').addClass('fa-archive');
        }
        else if (str.indexOf('.pdf') >= 0) {
            $('span#so').addClass('fa-pdf-o');
        }
        else if (str.indexOf('.rar') >= 0) {
            $('span#so').addClass('fa-file-zip-o');
        }
        else if (str.indexOf('.rpm') >= 0) {
            $('span#so').addClass('fa-file-zip-o');
        }
        else if (str.indexOf('.sh') >= 0) {
            $('span#so').addClass('fa-file-text');
        }
        else if (str.indexOf('.txt') >= 0) {
            $('span#so').addClass('fa-file-text');
        }
        else if (str.indexOf('.zip') >= 0) {
            $('span#so').addClass('fa-file-zip-o');
        }
        else if(str.indexOf('.7z') >= 0)
        {
            $('span#so').addClass('fa-file-zip-o');
        }
    })
</script>
</html>
