<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Respondent;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.prospek', [
            'respondents' => Respondent::paginate(20),
            'respondents_count' => Respondent::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.add-prospek');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'birthdate' => ['required'],
            'religion' => ['required'],
        ]);

        $validated['religion'] = str($validated['religion'])->title();
        $respondent = Respondent::create($validated);

        notyf()->success("Berhasil menambahkan $respondent->name");
        return redirect()
            ->route('admin.prospect.index')
            ->with('success', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Respondent $respondent)
    {
        return view('pages.add-prospek', [
            'respondent' => $respondent,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Respondent $respondent)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'birthdate' => ['required'],
            'religion' => ['required'],
        ]);

        $validated['religion'] = str($validated['religion'])->title();
        $respondent->update($validated);

        notyf()->success("Berhasil memperbaharui $respondent->name");
        return redirect()
            ->route('admin.prospect.index')
            ->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Respondent $respondent)
    {
        $respondent->delete();

        notyf()->success("Berhasil menghapus $respondent->name");
        return redirect()
            ->route('admin.prospect.index')
            ->with('success', true);
    }
}
