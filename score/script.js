// 使用 cookie 缓存常用不变的内容
var Cookie = {
    set: (cname,cvalue,exdays)=>{
        var d = new Date();
        d.setTime(d.getTime()+(exdays*24*60*60*1000));
        var expires = "expires="+d.toGMTString();
    
        document.cookie = cname + "=" + cvalue + "; " + expires;
    },
    get: (cname)=>{
        var name = cname + "=";
        var ca = document.cookie.split(';');
    
        for(var i=0; i<ca.length; i++) {
            var c = ca[i].trim();
            if (c.indexOf(name)==0) return c.substring(name.length,c.length);
        }
        return "";
    },
    autoSave: (...args)=>{
        args.forEach((item) => {
            let dom = $("#"+item).val();
    
            if(dom !== Cookie.get(item) || Cookie.get(item) != "") {
                Cookie.set(item,dom,365);
            }
        })
    },
    autoFill: (...args)=>{
        args.forEach((item) => {
            let dom = $("#"+item);
    
            if (Cookie.get(item) != "") {
                dom.val(Cookie.get(item));
            }
        })
    }
}
Cookie.autoFill('name', 'floor', 'dorm_type');


// 自动增加空内容输入框
let inputHtml = (a) => `<input type="number" class="form-control mb-3 ${a}">`;

$('#scoreSet').on('focus', '#scoreNum input',
    function () {
        let eq = $(this).index() - 1,
            dormNumInput = $(`#dormNum input:eq(${eq})`);

        if ($(`#dormNum input:eq(${$(this).index() + 1})`).length === 0) {
            if (dormNumInput.val() != '') {
                $('#dormNum').append(inputHtml('dormNum'));
                $('#scoreNum').append(inputHtml('scoreNum'));
            }
        }
    }
)

$('#scoreSet').on('focusout', '#scoreNum input',
    function () {
        if ($('#scoreSet input').length != 2 && $(this).val() == '') {
            $('#dormNum input').last().remove();
            $('#scoreNum input').last().remove();
        }
    }
)


// 提交操作
$('#submit').click(function() {
    // 获取需要提交的内容
    let name = $('#name').val(),
        dorm_type = $('#dorm_type').val(),
        floor= $('#floor').val(),
        scoreArr = [];

    for (let i = 0; i < $('.dormNum').length; i++) {
        if ($(`.dormNum:eq(${i})`).val() != '') {
            let scoreList = {};

            scoreList['dormNum'] = $(`.dormNum:eq(${i})`).val();
            scoreList['scoreNum'] = $(`.scoreNum:eq(${i})`).val();

            scoreArr.push(scoreList);
        }
    }

    let score = JSON.stringify(scoreArr);

    if (name != '' && floor != '') {
        // 开始提交
        $.ajax({
            type: 'POST',
            url: '/fn/newScore.php',
            data: {
                name: name,
                dorm_type: dorm_type,
                floor: floor,
                score: score
            },
            success: function () {
                $('#scoreSet input').remove();
                $('#dormNum').append(inputHtml('dormNum'));
                $('#scoreNum').append(inputHtml('scoreNum'));
                alert('成功提交宿舍评分！');

                Cookie.autoSave('name', 'floor', 'dorm_type');
            }
        })
    } else {
        alert('未填写楼层或评分人！');
    }
})