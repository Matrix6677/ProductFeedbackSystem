<?php
if (isset($_POST) && ! empty($_POST)) {
    $db = new PDO('sqlite:feedback.db');
    $tag = $_POST['tag'];
    $rs_arr = array();
    switch ($tag) {
        case 'getPlat': // 获取产品对应的平台列表
            $sql = "select distinct(plat) from product where name='";
            $sql .= $_POST['product'] . "'";
            $rs_arr = $db->query($sql)->fetchAll();
            break;
        case 'getVersion': // 获取产品对应的平台的软件版本
            $sql = "select distinct(version) from product where name='";
            $sql .= $_POST['product'] . "' and plat='";
            $sql .= $_POST['platform'] . "'";
            $rs_arr = $db->query($sql)->fetchAll();
            break;
        case 'getChannel': // 获取产品的渠道
            $sql = "select distinct(channel) from product where name='";
            $sql .= $_POST['product'] . "' and plat='";
            $sql .= $_POST['platform'] . "' and version='";
            $sql .= $_POST['version'] . "'";
            $rs_arr = $db->query($sql)->fetchAll();
            break;
        case 'record': // 录入数据
            if (empty($_POST["time"]) || empty($_POST["username"]) || empty($_POST["product"]) || empty($_POST["platform"]) || empty($_POST["version"]) || empty($_POST["content"])) {
                $rs_arr = 0;
            } else {
                $sql = "INSERT INTO feedbacks values(null,'".$_POST["time"]."',";
                $sql .= "'" . htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') . "',";
                $sql .= "'" . htmlspecialchars($_POST['product'], ENT_QUOTES, 'UTF-8') . "',";
                $sql .= "'" . htmlspecialchars($_POST['platform'], ENT_QUOTES, 'UTF-8') . "',";
                $sql .= "'" . htmlspecialchars($_POST['version'], ENT_QUOTES, 'UTF-8') . "',";
                $sql .= "'" . htmlspecialchars($_POST['channel'], ENT_QUOTES, 'UTF-8') . "',";
                $sql .= "'" . htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8') . "',0)";
                $rs = $db->exec($sql);
                $rs_arr = $rs;
            }
            break;
        case 'query': // 条件查询
            $sql = "select * from feedbacks where ";
            $sql .= (! empty($_POST['startDate']) && ! empty($_POST['endDate'])) ? ("dateTime>='" . $_POST['startDate'] . "' and dateTime<='" . $_POST['endDate'] . "' and ") : '';
            $sql .= "username like '%" . (! isset($_POST['username']) ? '' : $_POST['username']) . "%' and ";
            $sql .= "product like '%" . (! isset($_POST['product']) ? '' : $_POST['product']) . "%' and ";
            $sql .= "platform like '%" . (! isset($_POST['platform']) ? '' : $_POST['platform']) . "%' and ";
            $sql .= "version like '%" . (! isset($_POST['version']) ? '' : $_POST['version']) . "%' and ";
            $sql .= "channel like '%" . (! isset($_POST['channel']) ? '' : $_POST['channel']) . "%' and ";
            $sql .= "isKilled like '%" . (! isset($_POST['isKilled']) ? '' : $_POST['isKilled']) . "%'";
			$sql .= " order by dateTime desc";
            $rs_arr = $db->query($sql)->fetchAll();
            break;
    }
    echo preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", json_encode($rs_arr));
}
?>