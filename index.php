<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <title>bp 0.1, all for better product!</title>
    <link rel = "stylesheet" href = "Public/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "Public/css/index.css">
</head>
<body>
<div class = "container-fluid">
    <nav id="header" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <h3 class="text-center">BP系统:Better Product</h3>
    </nav>
    <div id="middle" class = "row">
        <div class = "col-md-2"></div>
        <div class = "col-md-8">
            <div class = "panel panel-default">
                <div class = "panel-heading">
                    <h3 class = "panel-title">产品改进意见</h3>
                </div>
                <div class = "panel-body">
                    <form role = "form" id = "form1" method = "POST">
                        <div class = "input-group">
                            <span class = "input-group-addon">*姓名：</span>
                            <select id="username" name = "username" class = "form-control">
                                <?php
                                    $db = new PDO('sqlite:feedback.db');
                                    $sql = "select name from employee order by name asc";
                                    $rs = $db->query($sql);
                                    while($row = $rs->fetch()){
                                        if($row[0]==$_COOKIE["username"]){
                                            echo '<option selected>'.$row[0].'</option>';
                                        }else{
                                            echo '<option>'.$row[0].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class = "input-group">
                            <span class = "input-group-addon">*产品：</span>
                            <select id="product" name = "product" class = "form-control">
                                <?php
                                    $sql = "select distinct(name) from product";
                                    $rs = $db->query($sql);
                                    while($row = $rs->fetch()){
                                        if($row[0]==$_COOKIE["product"]){
                                            echo '<option selected>'.$row[0].'</option>';
                                        }else{
                                            echo '<option>'.$row[0].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class = "input-group">
                            <span class = "input-group-addon">*平台：</span>
                            <select id="platform" name = "platform" class = "form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class = "input-group">
                            <span class = "input-group-addon">*版本：</span>
                            <select id="version" name = "version" class = "form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class = "input-group">
                            <span class = "input-group-addon">&nbsp;渠道：</span>
                            <select id="channel" name = "channel" class = "form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class = "input-group">
                            <label>反馈内容</label>
                            <textarea id="content" name = "content" class = "form-control" rows = "10"></textarea>
                        </div>
                        <input type="hidden" name="tag" value="record">
                        <button type = "submit" class = "btn btn-info pull-right">提  交</button>
                    </form>
                </div>
            </div>
        </div>
        <div class = "col-md-2"></div>
    </div>
    <div id="footer" class = "row navbar-fixed-bottom">
        <h6 class="text-center">
            For a better product!
            Air Bay Creative Limited
            Copyright 2014,for internal use only
        </h6>
    </div>
    <!--modal start-->
    <div id = "myModal" class = "modal fade">
        <div class = "modal-dialog">
            <div class = "modal-content">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal">
                        <span aria-hidden = "true">&times;</span><span class = "sr-only">Close</span>
                    </button>
                    <h4 class = "modal-title">温馨提示</h4>
                </div>
                <div class = "modal-body">
                    <p>提交成功</p>
                </div>
                <div class = "modal-footer">
                    <button type = "button" id="againBtn" class = "btn btn-default" data-dismiss = "modal">再来一条</button>
                    <button type = "button" id="toGatherBtn" class = "btn btn-primary">意见汇总</button>
                </div>
            </div>
        </div>
    </div>
    <!--  modal end -->
</div>
<script src = "Public/js/jquery-2.1.1.min.js"></script>
<script src = "Public/js/bootstrap.min.js"></script>
<script src = "Public/js/index.js"></script>
</body>
</html>