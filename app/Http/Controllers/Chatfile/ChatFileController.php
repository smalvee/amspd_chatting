<?php

namespace App\Http\Controllers\Chatfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chatting;
use Illuminate\Support\Facades\Auth;

class ChatFileController extends Controller
{
    public function store(Request $request, $to_do_id)
    {

        $request->validate([
            'attachments' => 'max:2048',
        ]);
        // dd($to_do_id);
        // dd($file = $request->file('attachments'));

        if ($request->hasFile('attachments') && $request->file('attachments')->isValid()) {
            // $file = $request->file('attachments');
            $file = $request->file('attachments');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/chat_file', $fileName);

            // Save the file name and user ID in the database
            $newFile = new Chatting;
            $newFile->to_do_id = $to_do_id;
            $newFile->user_id = Auth::user()->email;
            $newFile->chat_details = 'File';
            $newFile->attachments = $fileName;
            // Add other data to be stored in the database
            $newFile->save();

            
        } else {
            // Log or handle the error
            $error = $request->file('attachments')->getErrorMessage();
            // dd('not found');
        }












        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Data has been successfully stored.');
    }
}
