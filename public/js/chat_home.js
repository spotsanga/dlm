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
    $("#message").focus();
};
var hideAlert=function(){
    $("#alert").hide();
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
        $("#messages").animate({
            scrollTop: $('#messages').prop("scrollHeight")
        }, 1000);
        $('#send').trigger("reset");
        console.log(data);
    }).fail(function () {
        $("#alert").html("Network Error <button onclick=$('#alert').hide();>X</button>");
        $("#alert").attr("class", "alert alert-danger");
        $("#alert").show();
    });
};
var add_minutes = function (dt, minutes) {
    return new Date(dt.getTime() + minutes * 60000);
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
        var count = 0;
        for (var i = 0; i < data.length; i++) {
            last_msg_id = data[i]['id'];
            code += '<div class="card border-info" style="margin-top:10px">';
            code += '<div style="padding:5px" class="card-text" ';
            if (data[i]['user_id'] != $("#user_id").val()) {
                code += 'align="left">';
                code += '<b><i>' + data[i]['first_name'] + '</i></b>: ';
                count++;
            } else {
                code += 'align="right">';
            }
            code += data[i]['message'];
            var d = add_minutes(new Date(data[i]['created_at']), 330).toString().split(' ');
            code += '<br><small class="text-muted">' + d[0] + ' ' + d[1] + ' ' + d[2] + ' ' + d[3] + ' ' + d[4] + ' ' + '</small>';
            code += '</div>';
            code += '</div>';
        }
        $("#messages").append(code);
        if(count){
            $("#alert").html(count+" New messages <button class='btn btn-success' onclick='hideAlert();'>X</button>");
            $("#alert").attr("class","alert alert-success");
            $("#alert").show();
        }
        setTimeout(recieve, 1000);
    });
};
recieve();
var toggle_emoji = function () {
    $("#emojis").toggle();
};