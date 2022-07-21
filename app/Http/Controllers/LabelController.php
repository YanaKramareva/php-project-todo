<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $labels = Label::orderBy('id', 'asc')->paginate();
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $labelInputData = $this->validate(
            $request,
            [
            'name' => 'required|in:urgent,not urgent|unique:labels'
            ],
            $messages = [
            'in' => __('validation.The label name may by only "urgent" or "not urgent"'),
                'unique' => __('validation.The label name has already been taken')

            ]
        );

        $label = new Label();
        $label->fill($labelInputData);
        $label->save();

        flash(__('labels.Label has been added successfully'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label $label
     * @return Application|Factory|View
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Label        $label
     * @return RedirectResponse
     */
    public function update(Request $request, Label $label)
    {
        $labelInputData = $this->validate(
            $request,
            [
            'name' => 'required|in:urgent,not urgent|unique:labels,name,' . $label->id
            ],
            $messages = [
                'in' => __('validation.The label name may by only "urgent" or "not urgent"'),
                'unique' => __('validation.The label name has already been taken'),
                'only' => __('validation.The label name may by only urgent or not urgent')
            ]
        );

        $label->fill($labelInputData);
        $label->save();

        flash(__('labels.Label has been updated successfully'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label $label
     * @return RedirectResponse
     */
    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('labels.Failed to delete label'))->error();
            return back();
        }

        $label->delete();
        flash(__('labels.Label has been deleted successfully'))->success();
        return redirect()->route('labels.index');
    }
}
