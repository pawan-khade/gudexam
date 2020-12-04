<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EAdminController extends Controller
{
  public function eadminhome()
  {
    if(Auth::user())
    {
      if(Auth::user()->role != 'EADMIN')
      {
        return response()->json([
          "status"    =>  "failure",
          "message"   =>  "Unauthorized User...",
        ], 401);
      }

      return response()->json([
        "status"    =>  "success",
        "message"   =>  "User logged in successfully...",
        "data"      =>  Auth::user(),
      ], 200);
    }
    else
    {
      return response()->json([
        "status"    =>  "failure",
        "message"   =>  "Unauthorized User...",
      ], 401);
    }
  }
}
