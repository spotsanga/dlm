var addCategoryInList = function (id) {
    var category = $("#input-category-" + id).val();
    if (!category.length) return;
    $("#input-category-" + id).val("");
    var code = '\
        <div class="col-lg-2 col-sm-1">\
            <label class="checkbox-inline" style="padding-right:10px;" contentEditable="false">\
                <input type="checkbox" name="categorie_id" value="' + category + '" checked onclick=$(this).parent().parent().remove()>\
                <i>' + category + '</i>\
            </label>\
        </div>\
    ';
    $("#categorized_list-" + id).append(code);
};

function getArticles() {
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
        var code = '',
            articles_len = articles.length,
            categories_len = categories.length;
        for (var i = 0; i < articles_len; i++) {
            code += '\
            <div class="card border-info" style="margin-top:10px;box-shadow: 7px 7px 5px #aaaaaa;" id="news-' + articles[i]['id'] + '">\
                <div class="card-header bg-info" style="padding:10px;text-transform:capitalize;">\
                    <b>' + articles[i]['title'] + '</b>\
                    <a style="float:right; color:black;" target="_blank" href="' + articles[i]['url'] + '"><i class="fas fa-external-link-alt"></i></a>\
                </div>\
                <div class="card-body"  style=" padding:10px;" >\
                    <p class="card-text">' + articles[i]['description'] + ' </p>\
                    <form style="padding:10px;margin:0;text-transform:capitalize;" onsubmit="categorize(this);return false;" id="' + articles[i]['id'] + '">\
                        <div class="row">\
                            <div class="col-11">\
                                <div class="input-group">\
                                    <input id="input-category-' + articles[i]['id'] + '" class="form-control" placeholder="Categories List" list="categories_list">\
                                    <datalist id="categories_list">';
            for (var j = 0; j < categories_len; j++) {
                code += '               <option>' + categories[j]['category'] + '</option>';
            }
            code += '               </datalist>\
                                    <div class="input-group-append">\
                                        <button class="btn btn-outline-success" onclick="addCategoryInList(this.id)" id="' + articles[i]['id'] + '" type="button">\
                                            <i class="fas fa-plus"></i>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col-1">\
                                <button type="submit" style="width:100%" class="btn btn-outline-success">\
                                    <font size=5px"><i class="fas fa-angle-right"></i></font>\
                                </button>\
                            </div>\
                        </div>\
                        <div class="row" id="categorized_list-' + articles[i]['id'] + '">\
                        </div>\
                    </form>\
                </div>\
            </div>\
            ';
        }
        $("#news").html(code);
    });
    $("#myBar").attr('width', '1');
}
getArticles();

function categorize(obj) {
    var content = $(obj).serializeArray();
    if (!content.length) return;
    var data = {
        'article_id': obj.id,
        'categorized_list': []
    };
    for (var i = 0; i < content.length; i++) {
        data['categorized_list'][i] = {
            'category': content[i]['value']
        };
    }
    data['id'] = $("#id").val();
    data['_token'] = $("#_token").val();
    console.log(data);
    $.ajax({
        data: data,
        url: 'categorize',
        type: 'POST',
    }).done(function (data) {
        console.log(data);
        if (data['data']['code'] == 0) {
            getArticles();
        }
    }).fail(function (res) {
        console.log(ress);
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