function getArticles(len=10) {
    var data = {};
    data['id'] = $("#id").val();
    $.ajax({
        type: 'GET',
        data: data,
        url: 'datasets',
    }).done(function (res) {
        var articles = res['data']['articles'];
        var categories = res['data']['categories'];
        move();
        var code = '';
        for (var i = 0; i < articles.length; i++) {
            code += '<div class="card border-info" style="margin-top:10px;box-shadow: 7px 7px 5px #aaaaaa;border-radius:7px;" id="news-' + articles[i]['id'] + '">';
            code += '<div class="code-header bg-info" style="padding:10px;border-top-left-radius:5px;border-top-right-radius:5px;text-transform:capitalize;">';
            code += '<b>' + articles[i]['title'] + '</b>';
            code += '<a style="float:right; color:black;" target="_blank" href="' + articles[i]['url'] + '"><i class="fas fa-external-link-alt"></i></a>';
            code += '</div>';
            code += '<div class="code-body"  style=" padding:10px;" ><p class="card-text">' + articles[i]['description'] + ' </p></div>';
            code += '<div class="code-footer">';
            code += '<form class="row" style="padding-left:10px;padding-right:10px;text-transform:capitalize;" onsubmit="categorize(this);return false;"; id="' + articles[i]['id'] + '">';
            code += '<div class="col-11">';
            for (var j = 0; j < categories.length; j++) {
                code += '<label class="checkbox-inline" style="padding-right:10px;">';
                code += '<input type="checkbox" name="categorie_id" value="' + categories[j]['id'] + '">';
                code += '<i>'+categories[j]['category'] + '</i>';
                code += '</label>';
            }
            code +='</div>';
            code += '<div class="col-1">';
            code += '<button type="submit" style="border-radius:50%;" class="btn btn-outline-success">';
            code += '<font><i class="fas fa-angle-right"></i></font>';
            code += '</button>';
            code += '</div>';
            code += '</form>';
            code += '</div>';
            code += '</div>';
        }
        $("#news").html(code);
    });
    $("#myBar").attr('width', '1');
}
getArticles();
function categorize(obj){
    var con=$(obj).serializeArray();
    if(!con.length) return;
    var data={'categories':[]};
    for(var i=0;i<con.length;i++){
        data['categories'][i]={'article_id':obj.id,'category_id':con[i]['value']};
    }
    data['id'] = $("#id").val();
    data['_token'] = $("#_token").val();
    $.ajax({
        data:data,
        url:'categorize',
        type:'POST',
    }).done(function(data){
        if(data['data']['code']==0){
            getArticles();
        }
    });
}
function signout() {
    var data = {};
    data['_token'] = $("#_token").val();
    $.ajax({
        type: "POST",
        url: "signout",
        data: data,
    }).done(function (res) {
        location.replace("/");
    });
}

function move() {
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);

    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';
        }
    }
}
