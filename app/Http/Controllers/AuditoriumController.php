<?php

namespace App\Http\Controllers;

use App\Auditorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class AuditoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all auditoriums with pagination of five.
        $auditoriums = Auditorium::orderBy('name', 'asc')->paginate(5);

        return view('auditoriums.index', ['auditoriums' => $auditoriums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auditoriums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation.
        $messages = [
            'name.required' => 'O nome é obrigatório!',
            'name.string' => 'O nome tem que ser uma cadeia de caracteres!',
            'name.unique' => 'O nome deve ser único no sistema!',
        ];

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:auditoriums',
        ], $messages);

        $validator->validate();

        // Create the schedule.
        $schedule = new Auditorium($request->all());
        $schedule->save();

        return redirect()->route('auditoriums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auditorium  $auditorium
     * @return \Illuminate\Http\Response
     */
    public function show(Auditorium $auditorium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auditorium  $auditorium
     * @return \Illuminate\Http\Response
     */
    public function edit(Auditorium $auditorium)
    {
        return view('auditoriums.edit', ['auditorium' => $auditorium]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auditorium  $auditorium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auditorium $auditorium)
    {
        // Validation.
        $messages = [
            'name.required' => 'O nome é obrigatório!',
            'name.string' => 'O nome tem que ser uma cadeia de caracteres!',
            'name.unique' => 'O nome deve ser único no sistema!',
        ];

        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                'string',
                Rule::unique('auditoriums')->ignore($auditorium),
            ],
        ], $messages);

        $validator->validate();

        // Update the auditorium.
        $auditorium->update($request->all());

        return redirect()->route('auditoriums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auditorium  $auditorium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auditorium $auditorium)
    {
        // Delete all the schedules of auditorium.
        $auditorium->schedules()->each( function($schedule) {
            $schedule->delete();
        });

        // Delete the auditorium.
        $auditorium->delete();

        return redirect()->route('auditoriums.index');
    }
}
