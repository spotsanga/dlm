var col = 8;
for (var i = 128512; i <= 128591 - col; i += col) {
    var code = '<div class="row">',
        value;
    for (var j = i; j < i + col; j++) {
        value = "&#" + j + ";";
        code += '<button id="' + value + '" class="col-1" onclick="addEmoji(this);">' + value + '</button>';
    }
    code += "</div>";
    $("#emojis").append(code);
    //console.log(code);
}
var addEmoji = function (emoji) {
    var value = $("#message").val() + emoji.id;
    $("#message").val(value);
};
var send = function () {
    var data = {};
    data['user_id'] = $("#user_id").val();
    data['message'] = $("#message").val();
    data['_token'] = $("#_token").val();
    $.ajax({
        url: "send",
        data: data,
        type: "post",
    }).done(function (data) {
        $('#send').trigger("reset");
        console.log(data);
    }).fail(function () {
        console.log("Network Error");
    });
};
var last_msg_id = 0;
var recieve = function () {
    var data = {};
    data['id'] = last_msg_id;
    data['_token'] = $("#_token").val();
    $.ajax({
        url: "receive",
        data: data,
        type: "get",
    }).done(function (data) {
        console.log(data);
        var code = '';
        for (var i = 0; i < data.length; i++) {
            last_msg_id = data[i]['id'];
            code += '<div class="card border-info" style="margin-top:10px">';
            code += '<div style="padding:5px" class="card-text" ';
            if (data[i]['user_id'] != $("#user_id").val()) {
                code += 'align="left">';
                code += '<b><i>' + data[i]['first_name'] + '</i></b>: ';
            } else {
                code += 'align="right">';
            }
            code += data[i]['message'];
            code += '<br><small class="text-muted">'+data[i]['created_at']+'</small>';
            code += '</div>';
            code += '</div>';
        }
        $("#messages").append(code);
        setTimeout(recieve, 1000);
    });
};
recieve();
var toggle_emoji = function () {
    $("#emojis").toggle();
};