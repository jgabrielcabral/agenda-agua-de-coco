<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\User;
use App\Auditorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::orderBy('init', 'desc')->paginate(5);

        return view('schedules.index', ['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.create', ['users' => User::all(), 'auditoriums' => Auditorium::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $messages = [
            'auditorium.required' => 'O auditório é obrigatório!',
            'auditorium.integer' => 'O auditório tem que ser do tipo inteiro!',
            'auditorium.exists' => 'O auditório deve existir no sistema!',

            'init.required' => 'A data e horário de início é obrigatória!',
            'init.date' => 'A data e horário de início tem que ser do tipo data!',

            'end.required' => 'A data e horário de fim é obrigatória!',
            'end.date' => 'A data e horário de fim tem que ser do tipo data!',
            'end.after' => 'A data e horário de fim tem que ser depois da data e horário de ínicio!',

            'user.required' => 'O usuário é obrigatório!',
            'user.integer' => 'O usuário tem que ser do tipo inteiro!',
            'user.exists' => 'O usuário deve existir no sistema!',
        ];

        $validator = Validator::make($request->all(),[
            'auditorium' => 'required|integer|exists:auditoriums,id',
            'init' => 'required|date',
            'end' => 'required|date|after:init',
            'user' => 'required|integer|exists:users,id',
        ], $messages);

        $validator->after(function ($validator) use ($request) {
            if ($this->hasPeriod($request->init, $request->end, $request->auditorium)) {
                $validator->errors()->add('init', 'Data já está em um período existente!');
                $validator->errors()->add('end', 'Data já está em um período existente!');
            }
        });

        $validator->validate();

        // Create the schedule
        $schedule = new Schedule($request->all());
        $schedule->user()->associate($request->user);
        $schedule->auditorium()->associate($request->auditorium);
        $schedule->save();

        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', ['schedule' => $schedule, 'users' => User::all(), 'auditoriums' => Auditorium::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        // Validation
        $messages = [
            'user.required' => 'O usuário é obrigatório!',
            'user.integer' => 'O usuário tem que ser do tipo inteiro!',
            'user.exists' => 'O usuário deve existir no sistema!',

            'init.required' => 'A data e horário de início é obrigatória!',
            'init.date' => 'A data e horário de início tem que ser do tipo data!',

            'end.required' => 'A data e horário de fim é obrigatória!',
            'end.date' => 'A data e horário de fim tem que ser do tipo data!',
            'end.after' => 'A data e horário de fim tem que ser depois da data e horário de ínicio!',

            'auditorium.required' => 'O auditório é obrigatório!',
            'auditorium.integer' => 'O auditório tem que ser do tipo inteiro!',
            'auditorium.exists' => 'O auditório deve existir no sistema!',
        ];

        $validator = Validator::make($request->all(),[
            'user' => 'required|integer|exists:users,id',
            'init' => 'required|date',
            'end' => 'required|date|after:init',
            'auditorium' => 'required|integer|exists:auditoriums,id',
        ], $messages);

        $validator->after(function ($validator) use ($request) {
            if ($this->hasPeriod($request->init, $request->end, $request->auditorium)) {
                $validator->errors()->add('init', 'Data já está em um período existente!');
                $validator->errors()->add('end', 'Data já está em um período existente!');
            }
        });

        $validator->validate();

        // Update the schedule
        $schedule->user()->associate($request->user);
        $schedule->auditorium()->associate($request->auditorium);
        $schedule->save();
        $schedule->update($request->all());

        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    /**
     * Veirfy if a period has blocked to use.
     *
     * @return boolean
     */
    protected function hasPeriod($init, $end, $auditorium_id)
    {
        // Parse to date format.
        $date_init = Carbon::parse($init);
        $date_end = Carbon::parse($end);

        // Search for periods with the dates.
        foreach (Schedule::where('auditorium_id', '=', $auditorium_id)->get() as $schedule) {
            $schedule_init = $schedule->init;
            $schedule_end = $schedule->end;
            if ( ($date_init->greaterThanOrEqualTo($schedule_init) && $date_init->lessThanOrEqualTo($schedule_end)) || ($date_end->greaterThanOrEqualTo($schedule_init) && $date_end->lessThanOrEqualTo($schedule_end))) {
                return true;
            }
        }

        return false;
    }
}
