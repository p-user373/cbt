<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;

class QuestionController extends Controller
{
    public function question(Request $request){
        
        $question_number_pre=$request->question;
        $question_number=intval($question_number_pre);
        
       if($question_number!=31){

            if($question_number==1){    
                $array_A=range(1,100);
                shuffle($array_A);
                $array_A=array_slice($array_A,0,8);

                $array_B=range(101,200);
                shuffle($array_B);
                $array_B=array_slice($array_B,0,4);

                $array_C=range(201,300);
                shuffle($array_C);
                $array_C=array_slice($array_C,0,5);

                $array_D=range(301,400);
                shuffle($array_D);
                $array_D=array_slice($array_D,0,6);

                $array_E=range(401,500);
                shuffle($array_E);
                $array_E=array_slice($array_E,0,7);

                $array=array_merge($array_A,$array_B,$array_C,$array_D,$array_E);

                foreach($array as $key=>$data){
                    $key_for_session="key".$key;
                    $request->session()->put($key_for_session,$data);
                }

                $request->session()->put("correct_quantity_one",1);
                $question_number_not_correct=[];
                $request->session()->put("correct_quantity",0);
                $request->session()->put("question_number_not_correct",$question_number_not_correct);
            }
            //////
            $pre_question_number=$question_number-1;
            $key_for_session_get="key".$pre_question_number;
            $question_id=session($key_for_session_get);

            $question=Question::where("id",$question_id)->first();
            

            $choices=Choice::where("q_id",$question_id)->get();

        }

        
        if($question_number!=1){
            $selected_c_id=$request->c_id;
            
            $question_number_pre_pre=$question_number-2;
            $pre_key_for_session_get="key".$question_number_pre_pre;
            $pre_question_id=session($pre_key_for_session_get);

            $pre_question=Question::where("id",$pre_question_id)->first();
            $sentence=$pre_question->sentence;
            $commentary=$pre_question->commentary;
            $category=$pre_question->category;
            if(isset($selected_c_id)){    
                $correct_or_not_pre=Choice::where("q_id",$pre_question_id)
                                ->where("c_id",$selected_c_id)
                                ->first();
                $correct_or_not=$correct_or_not_pre->correct_or_not;
            }else{
                $correct_or_not=0;
            }




            if($correct_or_not==1){
                $correct_quantity=session("correct_quantity");
                
                    $correct_quantity+=1;
                $request->session()->forget(["correct_quantity"]);
                $request->session()->put("correct_quantity",$correct_quantity);
                $request->session()->put($category,$category);
            }else{
                $question_number_not_correct=session("question_number_not_correct");
                $question_number_not_correct[]=[$pre_question_id,$question_number-1,$sentence,$commentary,$category];
                
                $request->session()->forget(["question_number_not_correct"]);
                $request->session()->put("question_number_not_correct",$question_number_not_correct);
            
            }
        }

          //あとで31に変更
        if($question_number!=31){
        
            return view("question",compact("question_number","question_id","question","choices"));
        }else{
    
            $correct_quantity=session("correct_quantity");
            $question_number_not_correct=session("question_number_not_correct");

            return view("complete",compact("correct_quantity","question_number_not_correct"));
        }
        

       


        
        
        
        
        
        
    }
}
