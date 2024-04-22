<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Attachment::where("user_id", $user->id);

        // Check if there is a search query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('front_view', 'like', "%$search%")
                    ->orWhere('back_view', 'like', "%$search%")
                    ->orWhere('type', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        // Get paginated attachments
        $attachments = $query->paginate(10); // Change 10 to your desired pagination limit

        return view("user.attachment.index", compact("attachments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $attachment = null;
        return view("user.attachment.create", compact('attachment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'type' => 'required|in:driver_license,passport,utility_bill,credit_card,master_card,national_card',
            'front_view' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            'back_view' => $request->has('back_view') ? 'image|mimes:jpeg,png,jpg,gif|max:2048' : '', // Validate back view only if provided
            'description' => 'nullable|string|max:255',
        ]);

        // Process file uploads and save paths
        $frontViewPath = $request->file('front_view')->store('attachment', 'public');
        $backViewPath = $request->has('back_view') ? $request->file('back_view')->store('attachment', 'public') : null;

        // Store attachment details in the database
        $attachment = new Attachment();
        $attachment->user_id = auth()->id();
        $attachment->type = $validatedData['type'];
        $attachment->front_view = $frontViewPath;
        $attachment->back_view = $backViewPath;
        $attachment->description = $validatedData['description'];
        $attachment->save();

        // Redirect back to the attachment index page with a success message
        return redirect()->route('attachment.index')->with('success', 'Attachment created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attachment = Attachment::findOrFail($id);

        return view('user.attachment.show', compact('attachment'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachment $attachment)
    {
        //
        return view('user.attachment.create', compact('attachment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attachment $attachment)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'type' => 'required|in:driver_license,passport,utility_bill,credit_card,master_card,national_card',
            'front_view' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust maximum file size if needed
            'back_view' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust maximum file size if needed
            'description' => 'nullable|string|max:255',
        ]);

        // Handle front view file upload
        if ($request->hasFile('front_view')) {
            // Delete previous front view image if it exists
            if ($attachment->front_view) {
                Storage::delete($attachment->front_view);
            }
            // Store new front view image
            $validatedData['front_view'] = $request->file('front_view')->store('attachment-front-views', 'public');
        }

        // Handle back view file upload
        if ($request->hasFile('back_view')) {
            // Delete previous back view image if it exists
            if ($attachment->back_view) {
                Storage::delete($attachment->back_view);
            }
            // Store new back view image
            $validatedData['back_view'] = $request->file('back_view')->store('attachment-back-views', 'public');
        }

        // Update the attachment with the validated data
        $attachment->update($validatedData);

        // Redirect back to the attachment index page with a success message
        return redirect()->route('attachment.index')->with('success', 'Attachment updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);

        // Validate and delete front view image file from storage if it exists
        if ($attachment->front_view && Storage::exists($attachment->front_view)) {
            Storage::delete($attachment->front_view);
        }

        // Validate and delete back view image file from storage if it exists
        if ($attachment->back_view && Storage::exists($attachment->back_view)) {
            Storage::delete($attachment->back_view);
        }

        // Delete the attachment record from the database
        $attachment->delete();

        return redirect()->route('attachment.index')->with('success', 'Attachment deleted successfully.');
    }

}
