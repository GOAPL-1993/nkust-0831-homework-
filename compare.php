<?php
session_start();
$username = $_SESSION["username"];
if ($username == NULL) {
    header("Location: login.php?redir=compare.php");
    exit;
}
$tags = "<iframe width='784' height='441' src='https://www.youtube.com/embed/^^^^' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>jojo list</title>
</head>

<body>
    <h2>jojo list</h2>
    <hr>
    <?php
    // echo $tags;
    //開啟檔案作為讀取
    $fp = fopen("jojo.txt", "r") or die("die");
    //讀入所有的info，放在$data中
    $data = fread($fp, filesize("jojo.txt"));
    //關檔
    fclose($fp);
    //把讀取到的info印出來
    //用換列字元分段各列info
    $jos = explode("\n", $data);
    ?>
    <form method='POST' action="compare.php">
        <select name="gvid">
            <?php
            //以下用迴圈把每個項目個別讀出來
            foreach ($jos as $jo) {
                $temp = explode(",", $jo);
                $model = trim($temp[0]); //第一項目$temp[0]是集名稱
                $vid = trim($temp[1]);   //第二項目$temp[1]是影片ID
                //trim用來清空前後空白字元
                echo "<option value = " . $vid . ">" . $model . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="jojo!!我不做人了!!!">
        <hr>
    </form>
    <?php
    $gvid = $_POST["gvid"];
    //以下做影片ID的置換，並顯示內容
    echo str_replace("^^^^", $gvid, $tags);
    ?>
</body>

</html>