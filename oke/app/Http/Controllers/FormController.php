<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function step1(Request $request)
    {
        return view('Form.step1', [
            'data1' => $request->data1
        ]);
    }

    public function step2(Request $request)
    {
        return view('Form.step2', [
            'data1' => $request->data1,
            'data2' => $request->data2
        ]);
    }

    public function step3(Request $request)
    {
        return view('Form.step3', [
            'data1' => $request->data1,
            'data2' => $request->data2,
            'data3' => $request->data3
        ]);
    }
}
