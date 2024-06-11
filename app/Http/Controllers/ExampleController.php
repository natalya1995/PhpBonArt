<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
 public function test(Request $request)
 {
    dd($request->header('token'));
    return 'hello';
    $t=14/0;
return response()->json(['hello'=>'Laravel'],201);
 }


}