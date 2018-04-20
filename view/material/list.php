<?php view::layout('layout') ?>
<?php
function file_ico($item)
{
  $ext = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
  if(in_array($ext,['bmp','jpg','jpeg','png','gif'])){
  	return "image";
  }
  if(in_array($ext,['mp4','mkv','webm','wmv'])){
  	return "ondemand_video";
  }
  if(in_array($ext,['ogg','mp3','wav'])){
  	return "audiotrack";
  }
  return "insert_drive_file";
}


function icon_name($items)
{
    $list = array('ass', 'apk', 'dmg', 'exe', 'iso', 'pdf', 'rar', 'rpm', 'sh', 'txt', 'zip', '7z');
    $list_key = array('ass' => 'fa fa-file-text"', 'apk' => 'fa fa-android"', 'dmg' => 'fa fa-apple"', 'exe' => 'fa fa-windows"', 'iso' => 'fa fa-spin fa-refresh"', 'pdf' => 'fa fa-pdf-o"', 'rar' => 'fa fa-file-zip-o"', 'rpm' => 'fa fa-file-zip-o"', 'sh' => 'fa fa-file-text"', 'txt' => 'fa fa-file-text"', 'zip' => 'fa fa-file-zip-o"', '7z' => 'fa fa-file-zip-o"');
    $isin = in_array(cut_str($items, '.', -1), $list);
    if ($isin) {
        return $list_key[cut_str($items, '.', -1)];
    } else {
        return 'insert_drive_file';
    }
}

function cut_str($str, $sign, $number)
{
    $array = explode($sign, $str);
    $length = count($array);
    if ($number < 0) {
        $new_array = array_reverse($array);
        $abs_number = abs($number);
        if ($abs_number > $length) {
            return 'error';
        } else {
            return $new_array[$abs_number - 1];
        }
    } else {
        if ($number >= $length) {
            return 'error';
        } else {
            return $array[$number];
        }
    }
}

?>

<?php view::begin('content'); ?>

    <div class="mdui-container-fluid">

        <?php if ($head): ?>
            <div class="mdui-typo" style="padding: 20px;">
                <?php e($head); ?>
            </div>
        <?php endif; ?>


        <div class="mdui-row">
            <ul class="mdui-list">
                <li class="mdui-list-item th">
                    <div class="mdui-col-xs-12 mdui-col-sm-7">文件</div>
                    <div class="mdui-col-sm-3 mdui-text-right">修改时间</div>
                    <div class="mdui-col-sm-2 mdui-text-right">大小</div>
                </li>
                <?php if ($path != '/'): ?>
                    <li class="mdui-list-item mdui-ripple">
                        <a href="<?php echo get_absolute_path($root . $path . '../'); ?>">
                            <div class="mdui-col-xs-12 mdui-col-sm-7">
                                <i class="mdui-icon material-icons">arrow_upward</i>
                                ..
                            </div>
                            <div class="mdui-col-sm-3 mdui-text-right"></div>
                            <div class="mdui-col-sm-2 mdui-text-right"></div>
                        </a>
                    </li>
                <?php endif; ?>

                <?php foreach ((array)$items as $item): ?>
                    <?php if (!empty($item['folder'])): ?>

                        <li class="mdui-list-item mdui-ripple">
                            <a href="<?php echo get_absolute_path($root . $path . $item['name']); ?>">
                                <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
                                    <i class="mdui-icon material-icons">folder_open</i>
                                    <?php e($item['name']); ?>
                                </div>
                                <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']); ?></div>
                                <div class="mdui-col-sm-2 mdui-text-right"><?php echo $item['size']; ?></div>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="mdui-list-item file mdui-ripple">
                            <a href="<?php echo get_absolute_path($root . $path) . urlencode($item['name']); ?>"
                               target="_blank">
                                <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
                                    <i <?php
                                    $suffix = cut_str($item['name'], '.', -1);
                                    if (icon_name($suffix) != 'insert_drive_file')
                                        echo 'class="mdui-icon material-icons ' . icon_name($suffix);
                                    else
                                        echo 'class="mdui-icon material-icons"';
                                    ?>>
                                    <?php
                                    $suffix = cut_str($item['name'], '.', -1);
                                    if (icon_name($suffix) === 'insert_drive_file')
                                        echo 'insert_drive_file' ?></i>
                                    <?php e($item['name']); ?>
                                </div>
                                <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']); ?></div>
                                <div class="mdui-col-sm-2 mdui-text-right"><?php echo $item['size']; ?></div>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php if ($readme): ?>
            <div class="mdui-typo mdui-shadow-3" style="padding: 20px;margin: 20px; 0">
                <div class="mdui-chip">
                    <span class="mdui-chip-icon"><i class="mdui-icon material-icons">face</i></span>
                    <span class="mdui-chip-title">README.md</span>
                </div>
                <?php e($readme); ?>
            </div>
        <?php endif; ?>
    </div>
    <script>
        $ = mdui.JQ;
        $(function () {
            $('.file a').each(function () {
                $(this).on('click', function () {
                    var form = $('<form target=_blank method=post></form>').attr('action', $(this).attr('href')).get(0);
                    $(document.body).append(form);
                    form.submit();
                    $(form).remove();
                    return false;
                });
            });
        });
    </script>
<?php view::end('content'); ?>
