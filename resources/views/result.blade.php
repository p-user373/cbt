<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBTアプリ</title>
</head>
<body>

    <h1>結果</h1>
    <div class="pass_or_not">{{$pass_or_not}}</div>
    <div class="correct_quantity">正解数:{{$correct_quantity}}/30問</div>
    <div class="not_correct_list">
        <div class=".not_correct_title">間違えた問題</div>
        @foreach($question_number_not_correct_list as $question_number_not_correct)
            <div class="not_correct">
                <div class="number_and_sentence">
                    <div class="question_number">Q.{{$question_number_not_correct[1]}}:</div>
                    <div class="sentence">問:{{$question_number_not_correct[2]}}</div>
                </div>
                <div class="commentary">解説{{$question_number_not_correct[3]}}</div>
            </div>
        @endforeach
        
    </div>
    <a href="/">トップへ</a>
</body>
</html>