document.write("<script src='Public/js/function.js'></script>");
$(function () {
    $('.datepicker').datepicker({ dateFormat: "yy-mm-dd" });
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

    $('#form2').submit(function () {
        $.ajax({
            url: "./reciever.php",
            data: $('#form2').serialize(),
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if (data.length == 0) {
                    $('#gather .dataRow').remove();
                    alert('无查询数据！');
                } else {
                    $('#gather .dataRow').remove();
                    for (var i = 0; i < data.length; i++) {
                        var cls = data[i]["isKilled"] == 1 ? 'success' : 'info';
                        var str = '<tr class="dataRow ' + cls + '">';
                        str += '<td>' + data[i]["dateTime"] + '</td>';
                        str += '<td>' + data[i]["username"] + '</td>';
                        str += '<td>' + data[i]["product"] + '</td>';
                        str += '<td>' + data[i]["platform"] + '</td>';
                        str += '<td>' + data[i]["version"] + '</td>';
                        str += '<td>' + data[i]["channel"] + '</td>';
                        str += '<td>' + (data[i]["isKilled"] == 1 ? "已修复" : "未修复") + '</td>';
                        str += '</tr>';
                        str += '<tr class="dataRow"><td colspan="7">' + data[i]["content"] + '</td></tr>';
                        $('#gather').append(str);
                    }
                    alert('查询成功！');
                }
            }
        });
        return false;
    });
});