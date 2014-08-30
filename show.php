<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>bp 0.1, all for better product!</title>
<link rel="stylesheet" href="Public/css/bootstrap.min.css">
<link rel="stylesheet" href="Public/css/index.css">
<link href="Public/css/jquery-ui.min.css" rel="stylesheet">
</head>
<?php
    $db = new PDO('sqlite:feedback.db');
    $sql = "select * from feedbacks order by dateTime desc";
    $rs_arr = $db->query($sql)->fetchAll();
?>
<body>
	<div class="container-fluid">
        <nav id="header" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <h3 class="text-center">BP系统:Better Product
				<a href="./index.php">提意见</a>
			</h3>
        </nav>
        <div id="middle" class = "row">
            <div class = "col-md-2"></div>
            <div class = "col-md-8">
                <form id="form2" method="POST" class="form-horizontal" role="form">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2">条件查询</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">起始日期：</span>
                                    <input name="startDate" class="datepicker form-control" type="text">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">结束日期：</span>
                                    <input name="endDate" class="datepicker form-control" type="text">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">姓名：</span>
                                    <select name = "username" class="form-control">
                                        <option></option>
                                        <?php
                                            $sql = "select name from employee order by name asc";
                                            $rs = $db->query($sql);
                                            while($row = $rs->fetch()){
                                                echo '<option>'.$row[0].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">产品：</span>
                                    <select id="product" class="form-control" name = "product" >
                                        <option></option>
                                        <?php
                                            $sql = "select distinct(name) from product";
                                            $rs = $db->query($sql);
                                            while($row = $rs->fetch()){
                                                echo '<option>'.$row[0].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">平台：</span>
                                    <select id="platform" class="form-control" name = "platform" >
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">版本：</span>
                                    <select id="version" class="form-control" name = "version" >
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">渠道：</span>
                                    <select id="channel" class="form-control" name = "channel" >
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">状态：</span>
                                    <select id="isKilled" class="form-control" name = "isKilled" >
                                        <option></option>
                                        <option value="0">未修复</option>
                                        <option value="1">已修复</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"  align="center">
                                <input type="hidden" name="tag" value="query" class="btn btn-success">
                                <input type="submit" class="btn btn-success" value="点 击 查 询">
                            </td>
                        </tr>
                    </table>
                </form>
                <table id="gather" class="table table-striped table-bordered">
					<col style="width: 11%;">
                    <col style="width: 6%;">
                    <col style="width: 10%;">
                    <col style="width: 7%;">
                    <col style="width: 6%;">
                    <col style="width: 11%;">
                    <col style="width: 6%;">
                    <tr>
                        <th>日期</th>
                        <th>姓名</th>
                        <th>产品名称</th>
                        <th>平台</th>
                        <th>版本</th>
                        <th>渠道</th>
                        <th>是否修复</th>
                    </tr>
                    <?php
                        foreach ($rs_arr as $row)
                        {
                            $abc ='<td>'.$row["dateTime"].'</td>';
                            $abc .='<td>'.$row["username"].'</td>';
                            $abc .='<td>'.$row["product"].'</td>';
                            $abc .='<td>'.$row["platform"].'</td>';
                            $abc .='<td>'.$row["version"].'</td>';
                            $abc .='<td>'.$row["channel"].'</td>';
							if($row["isKilled"]){
								$str = '<tr class="dataRow success">';
								$str .= $abc;
								$str .='<td>已修复</td>';
							}else{
								$str = '<tr class="dataRow info">';
								$str .= $abc;
								$str .='<td>未修复</td>';
							}
                            $str .= '</tr>';
                            $str .='<tr class="dataRow"><td colspan="7">'.$row["content"].'</td></tr>';
                            echo $str;
                        }
                    ?>
                </table>
            </div>
            <div class = "col-md-2"></div>
        </div>
        <div id="footer" class = "row navbar-static-bottom">
            <h6 class="text-center">For a better product! Air Bay Creative Limited Copyright 2014,for internal use only</h6>
        </div>
	</div>
	<script src="Public/js/jquery-2.1.1.min.js"></script>
    <script src="Public/js/jquery-ui.min.js"></script>
	<script src="Public/js/bootstrap.min.js"></script>
	<script src="Public/js/show.js"></script>
</body>
</html>