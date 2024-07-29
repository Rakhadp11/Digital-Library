<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member; 

class MemberStatusController extends Controller
{
    public function check()
    {
        $user = Auth::user();
        $isMember = Member::where('user_id', $user->id)->exists();

        return response()->json([
            'is_member' => $isMember,
            // 'message' => $isMember ? '' : 'Anda perlu mendaftar sebagai member terlebih dahulu.'
        ]);
    }
}
