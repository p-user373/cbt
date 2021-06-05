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
    <div class="pass_or_not"><?php echo e($pass_or_not); ?></div>
    <div class="correct_quantity">正解数:<?php echo e($correct_quantity); ?>/30問</div>
    <div class="not_correct_list">
        <div class=".not_correct_title">間違えた問題</div>
        <?php $__currentLoopData = $question_number_not_correct_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question_number_not_correct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="not_correct">
                <div class="number_and_sentence">
                    <div class="question_number">Q.<?php echo e($question_number_not_correct[1]); ?>:</div>
                    <div class="sentence">問:<?php echo e($question_number_not_correct[2]); ?></div>
                </div>
                <div class="commentary">解説<?php echo e($question_number_not_correct[3]); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </div>
    <a href="/">トップへ</a>
</body>
</html><?php /**PATH C:\xampp\htdocs\CBT\resources\views/result.blade.php ENDPATH**/ ?>