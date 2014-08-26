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