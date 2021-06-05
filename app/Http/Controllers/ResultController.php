<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;

class ResultController extends Controller
{
    public function result(){

        $correct_quantity=session("correct_quantity");

        $question_number_not_correct_list=session("question_number_not_correct");

        if($correct_quantity>=18 && session("A")==="A" && session("B")==="B" && session("C")==="C" && session("D")==="D" && session("E")==="E"){
            $pass_or_not="合格！";
        }else{
            $pass_or_not="不合格";
        }

        session()->flush();
        

        return view("result",compact("correct_quantity","question_number_not_correct_list","pass_or_not"));
    }
}
