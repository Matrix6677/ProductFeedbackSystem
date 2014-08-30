function getPlat() {
    $.ajax({
        url: "./reciever.php",
        data: {tag: 'getPlat', product: $('#product').val()},
        type: "POST",
        async: false,
        dataType: 'json',
        success: function (data) {
            $("#platform").empty();
            for (var i = 0; i < data.length; i++) {
                $("#platform").append("<option>" + data[i].plat + "</option>");
            }
        }
    });
}

function getVersion() {
    $.ajax({
        url: "./reciever.php",
        data: {tag: 'getVersion', product: $('#product').val(), platform: $('#platform').val()},
        type: "POST",
        async: false,
        dataType: 'json',
        success: function (data) {
            $("#version").empty();
            for (var i = 0; i < data.length; i++) {
                $("#version").append("<option>" + data[i].version + "</option>");
            }
        }
    });
}

function getChannel() {
    $.ajax({
        url: "./reciever.php",
        data: {tag: 'getChannel', product: $('#product').val(), platform: $('#platform').val(), version: $('#version').val()},
        type: "POST",
        async: false,
        dataType: 'json',
        success: function (data) {
            $("#channel").empty();
            for (var i = 0; i < data.length; i++) {
                $("#channel").append("<option>" + data[i].channel + "</option>");
            }
        }
    });
}

Date.prototype.Format = function(fmt)   
{
  var o = {   
    "M+" : this.getMonth()+1,                 //月份   
    "d+" : this.getDate(),                    //日   
    "h+" : this.getHours(),                   //小时   
    "m+" : this.getMinutes(),                 //分   
    "s+" : this.getSeconds(),                 //秒   
    "q+" : Math.floor((this.getMonth()+3)/3), //季度   
    "S"  : this.getMilliseconds()             //毫秒   
  };   
  if(/(y+)/.test(fmt))   
    fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));   
  for(var k in o)   
    if(new RegExp("("+ k +")").test(fmt))   
  fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));   
  return fmt;   
}