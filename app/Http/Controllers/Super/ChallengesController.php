<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ChallengesController extends Controller
{
    public function index()
    {
        $challenges = Challenge::where('status', '!=', 'preExist')->get();
        return view('interface.super.changamoto.wabungeChangamoto')
            ->with('challenges', $challenges);
    }

    public function updateChallenge(Request $request,  Challenge $challenge)
    {
        $isImagePresent = false;

        $path = null;

        $user = Auth::user();

        $file = $request->file('pdfFile');

        $rules = ['pdfFile' => 'sometimes|mimes:pdf|max:50000'];

        $messages = ['mimes' => 'Tafadhali Weka Pdf Pekee', 'max' => 'pdf isizidi ukubwa wa 5MB'];

        $request->validate($rules, $messages);

        if ($file) {
            $path = Storage::putFile('pdfs', $file);
            $fileNamesParticles = explode('/', $path);
            $isImagePresent = true;
            $fileName = end($fileNamesParticles);
        }

        $feedback = $request->input('feedback');

        $challenge->update([
            'status' => 'onProgress',
            'feedback' => $request->feedback,
        ]);

        if (isset($path) || $path) {
            if ($isImagePresent) {
                $challenge->assets()->create([
                    'type' => 'pdf',
                    'url' => $fileName,
                    'user_id' => $user->id
                ]);
            }
        }

        return redirect()->back()->with(['status' => 'success', 'message' => 'Changamoto Imetolewa Muongozo']);
    }

    public function show(Challenge $challenge)
    {
        return view('interface.super.changamoto.changamotoMoja')
            ->with('challenge', $challenge);
    }


    public function acomplished(Request $request, Challenge $challenge)
    {
        $challenge->update([
            'status' => 'complete'
        ]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Changamoto Imekamilishwa']);
    }
}
