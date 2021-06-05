<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBTアプリ</title>
    <script src = "https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        var query=location.search;
        var value=query.split("=");
        var current_time_get=value[2];
        var question_pre=value[1].split("&");
        var question=Number(question_pre[0])+1;

        
        
        var start_flag = false;
        var intervalid;
        var to_timeup = current_time_get;
        var backstart = current_time_get;

            function count_start() {
                if (start_flag===false) {
                    intervalid = setInterval(count_down, 1000);
                    start_flag = true;
                }
            }

            function count_down() {
                var timer = document.getElementById("timer");
                if (to_timeup===0) {
                    location.href="result";
                   
                    $('#timer').html('Time up!');  
                    $('#timer').addClass('red');
                    
                    count_stop();
                   
                   
                } else {
                    to_timeup--;
                    padding();
                }
            }

            function count_stop() {
                clearInterval(intervalid);
                start_flag = false;
            }

            function count_reset() {
                var timer = document.getElementById("timer");
                to_timeup = backstart;
                padding();
                // timer.style.color="black"; 
                $('#timer').css('color','black');
                clearInterval(intervalid);
                start_flag = false;
            }

            function padding() {
                var min = 0;
                var sec = 0;
                var timer = document.getElementById("timer");
                min = Math.floor(to_timeup/60);
                sec = (to_timeup%60);
                min = ('0'+min).slice(-2);
                sec = ('0'+sec).slice(-2);
                
                var current_time=to_timeup;
                $("form").attr("action","question?question="+question+"&current_timer="+current_time);
                timer.innerHTML = min+':'+sec;
            }

            $(function () {
                
                padding();
                count_start();
                
                
            });

           
    </script>
    
    
    
    <style>
        img{
            width: 200px;
        }
    </style>
</head>
<body>
    
        <div id="timer"></div>
    

    <div class="for_flex">
        <div class="question_header">Q.{{$question_number}}</div>
        <div class="category">カテゴリー：{{$question->category}}</div>    
    </div>
    <div class="question_content">
        <div class="for_flex">
            <div class="question_sentence">問.{{$question->sentence}}</div>
            <div class="image"><img src="storage/{{substr($question->image,32)}}" alt=""></div>
        </div>    
        <div class="question_choice-container">  
            <form  method="post">
            @csrf
            @foreach($choices as $key=>$choice)   
                <div class="choice_id_and_sentence">
                    <label for="{{$key+1}}"><input type="radio" name="c_id" id="{{$key+1}}" value={{$key+1}}>{{$choice->c_id}}.{{$choice->c_sentence}}</label>
                </div>
               
            @endforeach
            @if($question_number==30)
                <input type="submit" value="結果へ" class="submit"> 
                @else
                <input type="submit" value="次の問題へ" class="submit"> 
                @endif
            </form>
        </div>
    </div>
    
</body>
</html>