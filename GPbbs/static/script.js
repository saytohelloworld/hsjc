var input_Name = $('#form-nickname'),
    input_Mail = $('#form-email');
var nickname = getCookie('nickname'),
    email = getCookie('email');
var log = (t) => console.log(t);

// 创建 cookie
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime()+(exdays*24*60*60*1000));
    var expires = "expires="+d.toGMTString();

    document.cookie = cname + "=" + cvalue + "; " + expires;
}

// 获取 cookie
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');

    for(var i=0; i<ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(name)==0) return c.substring(name.length,c.length);
    }
    return "";
}

// 自动填充文本框
function fillInputInfo() {
    if (nickname != '' || email != '') {
        input_Name.val(nickname);
        input_Mail.val(email);
    }
}

// 帖子点击事件
function clickMsgBox() {
    $('div.msg-box').click(function () {
        let id    = { id: $(this).children('p.msg-title').attr('data-id') },
            title = $(this).children('p.msg-title').text();

        $('#msg-title').text(title);

        $.ajax({
            type: 'POST',
            url: 'getText.php',
            data: id,
            success: function (result) {
                $('#msg-text').html("");
                $('#msg-text').html(marked(result));
                renderMathInElement(document.body, {
                    // customised options
                    // • auto-render specific keys, e.g.:
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '$', right: '$', display: false},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '\\[', right: '\\]', display: true}
                    ],
                    // • rendering keys, e.g.:
                    throwOnError : false
                });
                $('table').wrap('<div class="table-div"></div>');
            }
        })

        $('#readMsg').modal('show');
    })
}

// 数据提交按钮点击事件
function clickPostBtn() {
        let postName = input_Name.val(),
            postMail = input_Mail.val(),
            postTitle = $('#form-title').val(),
            postText = $('#form-text').val();

        let data = {
            name: postName,
            email: postMail,
            title: postTitle,
            text: postText
        }

        $.ajax({
            type: 'POST',
            url: 'post.php',
            data: data,
            success: function (result) {
                $('#form-title').attr('placeholder', '标题 *');
                $('#form-text').attr('placeholder', '详细的内容 *');

                if (result != 0) {
                    $('#form-title').val('');
                    $('#form-text').val('');
                    
                    $('div.msg-list').html(result);
                    clickMsgBox();
                } else if (postTitle == '') {
                    $('#form-title').attr('placeholder', '请填写标题！');
                } else {
                    $('#form-text').attr('placeholder', '你没写内容呢！');
                }
            }
        })

        if(nickname != "" || input_Name.val() !== nickname) {
            nickname = input_Name.val();
            email    = input_Mail.val();

            if (nickname != "" && nickname != null) {
                setCookie("nickname",nickname,365);
                setCookie("email",email,365);
            }
        }
}


$(document).ready(function () {
    fillInputInfo();
    clickMsgBox();
    
    $('#form-postBtn').click(() => clickPostBtn());
    $('#form-text').keyup((e) => {
        let key = e.keyCode;

        if (e.ctrlKey && e.which == 13) {
            clickPostBtn()
        }
    });
})