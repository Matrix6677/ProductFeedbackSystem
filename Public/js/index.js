document.write("<script src='Public/js/function.js'></script>");
$(function () {
    getPlat();
    getVersion();
    getChannel();
    $('#content').focus();
    $('#myModal').unbind('click');
    $('#toGatherBtn').click(function () {
        location.href = "show.php";
    });

    $('#againBtn').click(function () {
        $('#content').val('');
        $('#content').focus();
    });

    $('#product').change(function () {
        getPlat();
        getVersion();
        getChannel();
    });

    $('#platform').change(function () {
        getVersion();
        getChannel();
    });

    $('#version').change(function () {
        getChannel();
    });

    $('#form1').submit(function () {
		var time = new Date().Format("yyyy-MM-dd hh:mm:ss");
		$('#time').val(time);
        $.ajax({
            url: "./reciever.php",
            data: $('#form1').serialize(),
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('#myModal').modal();
                    document.cookie = "username=" + $('#username').val();
                    document.cookie = "product=" + $('#product').val();
                } else {
                    alert('提交失败！请填写必要信息~');
                }
            }
        });
        return false;
    });
});
