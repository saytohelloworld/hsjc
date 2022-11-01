// 范围内随机数字函数
function rand(data) {
    var x = data - 1;
    var y = 0;
    var rand = parseInt(Math.random() * (x - y + 1) + y);
    
    return rand;
}


$(document).ready(() => {
    let history = $('#history');

    // 随机抽人按钮点击事件
    $('#randomPeople').click(()=>{
        let _class = $("input:radio:checked").val();

        $.getJSON('https://ran.hsjc.ml/api/data?table='+_class, (data)=>{
            let randNum = rand(data.length);

            if(data == 0) {
                history.prepend('<div><p>未选择班级！</p></div>');
            } else {
                history.prepend(`<div>
                                            <p>班级人数：${data.length}</p>
                                            <p>学号：${data[randNum].id}</p>
                                            <p>姓名：${data[randNum].name}</p>
                                        </div>`);
            }
        })
    });

    // 随机专业词汇按钮点击事件
    $('#randomWord').click(()=>{
        let _class = $("input:radio:checked").val();

        $.getJSON('https://ran.hsjc.ml/api/data?table='+_class, (data)=>{
            $.getJSON('https://ran.hsjc.ml/word', (word)=>{
                let randNum1 = rand(data.length);
                
                if(data == 0) {
                    history.prepend('<div><p>未选择班级！</p></div>');
                } else {
                    history.prepend(`<div>
                                                <p>学号：${data[randNum1].id}</p>
                                                <p>姓名：${data[randNum1].name}</p>
                                                <p>Word：${word["0"][0]} - ${word["0"][1]}</p>
                                                <p>CN：<span class="hide">${word["0"][2]}</span></p>
                                            </div>`);
                }
            })
        })
    });

    let num = 0;
    $('#randomGroup').click(()=>{
        let _class = $("input:radio:checked").val();

        $.getJSON('https://ran.hsjc.ml/api/data?table='+_class, (data)=>{
            let randNum1 = rand(data.length),
                randNum2 = rand(data.length);

            if(data == 0) {
                history.prepend('<div><p>未选择班级！</p></div>');
            } else {
                num += 1;
                history.prepend(`<div>
                                            <p>第 ${num} 小组</p>
                                            <p>学号：${data[randNum1].id} 和 ${data[randNum2].id}</p>
                                            <p>姓名：${data[randNum1].name} 和 ${data[randNum2].name}</p>
                                            <p>剩余人数：${data.length - (num * 2)}</p>
                                        </div>`);
            }
        })
    });

    // 清理历史记录按钮点击事件
    $('#clearHistory').click(()=>{
        history.empty();
        
        if(num != 0) {
            num = 0;
        }
    });
})
