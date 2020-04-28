var timeinterval;
var questions;
var currentNum = 0;
var scores = 0;
var ANSWER;
var selected_answer;
var pick = "";
var url;


function getQuestion() {
    if (typeof(Storage) !== "undefined") {
        school = localStorage.getItem("school");
        var s = localStorage.getItem("stage");
        if (s) {
            console.log(s);
            console.log(school)
            url = location.href.split(/=/);
            $.ajax({
                type: 'GET',
                url: './server/tables.php?s=' + url[1],
                success: function (result) {
                    questions = JSON.parse(result);
                    showQuestions();
                },
                error: function (error) {
                    alert(error)
                }
            });
        }

    }

}
function insertToDatabase() {

    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = './tables.php?s=scores=' + url[1];
        }
    };
    xhttp.open("POST", './server/insert.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('sch=' + school + '&pass=' + localStorage.getItem('stage') + '&score=' + scores + " / " + questions.length + '&picked=' + pick);
}
function showQuestions() {
    if (currentNum == questions.length) {
        insertToDatabase();
    } else {
        initializeClock();
        ANSWER = questions[currentNum]['Answer'];
        var question = questions[currentNum]['QUESTION'];
        var A = questions[currentNum]['A'];
        var B = questions[currentNum]['B'];
        var C = questions[currentNum]['C'];
        var D = questions[currentNum]['D'];
        document.getElementById('next').style.visibility = 'hidden';
        document.getElementById("question-view").innerHTML = question;
        document.getElementById("A").innerHTML = "<h3><input type=\"radio\" onchange='radioclick(\"A\")' name=\"opt\" value=\"A\" id=\"opt1\"/>  " + A + "</h3>";
        document.getElementById("B").innerHTML = "<h3><input type=\"radio\" onchange='radioclick(\"B\")' name=\"opt\" value=\"B\" id=\"opt2\"/> " + B + "</h3>";
        document.getElementById("C").innerHTML = "<h3><input type=\"radio\" onchange='radioclick(\"C\")' name=\"opt\" value=\"C\" id=\"opt3\"/>  " + C + "</h3>";
        document.getElementById("D").innerHTML = "<h3><input type=\"radio\" onchange='radioclick(\"D\")' name=\"opt\" value=\"D\" id=\"opt4\"/>  " + D + "</h3>";
        document.getElementById("ques").innerHTML = currentNum + 1 + " of " + questions.length;
        currentNum++;
    }

}
function radioclick(selected_ans) {
    document.getElementById('next').style.visibility = 'visible';
    selected_answer = selected_ans;
}
function addScore() {
    return scores++;
}
function timeUP() {
    stoptimer();
    showQuestions();
}
function calculate() {
    if (ANSWER == selected_answer) {
        addScore();
    }
    pick = pick + selected_answer + ",";
    timeUP()
}

function stoptimer() {
    clearInterval(timeinterval);
}


function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}


function initializeClock() {
    var totalSeconds = 60;
    if (localStorage.getItem('stage') == 'stage3') {
        totalSeconds = 90;
    }
    var clock = document.getElementById("game-timer");
    var deadline = new Date(Date.parse(new Date()) + totalSeconds * 1000);

    function updateClock() {
        var t = getTimeRemaining(deadline);
        clock.innerHTML = ('0' + t.minutes).slice(-2) + ":" + ('0' + t.seconds).slice(-2);
        if (t.total <= 0) {
            pick = pick + " " + ",";
            timeUP()
        }
    }

    timeinterval = setInterval(updateClock, 1000);
}


$("#start").click(function (e) {
    e.preventDefault();
    if($("#school").val() === ''){
        return alert('Team Name can not be empty')
    }else {
        alert($("#school").val())
    }

    localStorage.setItem("school", $("#school").val());
    localStorage.setItem("start", true);
    console.log(localStorage.getItem("school"))
    window.location.href = "./spell/" + $("#school").val() + "/1" ;
});

var school;


getQuestion();


$("#school").keyup(function (event) {
    if (event.keyCode === 13) {
        $("#start").click();
    }
});