<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function feedbackList(){
        $feedbacks = Feedback::paginate();
        return view('admin.feedback.index',compact('feedbacks'));
    }

    public function showFeedback($id){
        $feedbacks = Feedback::find($id);
        return view('admin.feedback.show',compact('feedbacks'));
    }

    public function destroy($id){
        $feedbacks = Feedback::find($id);
        $feedback->delete();
        return redirect()->route('feedbackList');
    }
}
