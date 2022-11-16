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
    }
}

function disabledx(obj){
    //alert(obj.innerHTML);
    //alert(obj.name);
    //document.getElementById('radio1').disabled=true;
    //document.getElementById('radio2').disabled=true;
    //document.getElementById('radio3').disabled=true;
    //document.getElementById('radio4').disabled=true;

    var inputs=     document.getElementsByName(obj.name);//通常获取的是表单标签name
    console.log(inputs);
    for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled=true;
    }

    answers = inputs[0].value.split('-');
    document.getElementById(obj.name).innerHTML = answers[2];
    temp = document.getElementById('comment').innerHTML;
    document.getElementById('comment').innerHTML = answers[0]+ '-' + answers[1] + " " + temp;
}

$(document).ready(function () {
    let args = window.location.search.replace('?', '').split('&');

    $.each(args, function (i, item) {
        let retName = item.split('=')[0],
            ret = item.split('=')[1];
        switch(retName) {
            case "limit":
                $('input#limit').attr('value', ret);
                break;
            case "entype":
                $('input#entype').attr('value', ret);
                break;
        }
    });
});