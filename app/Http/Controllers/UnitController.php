<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Department;
use App\Models\UnitHead;
use App\Models\User;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('manage unit'))
        {
            $units = Unit::get();

            return view('units.index', compact('units'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('create unit'))
        {
            $users = User::all()->pluck("name","id");
            $departments = Department::get()->pluck('name', 'id');

            return view('units.create', compact('departments','users'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('create unit'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'department_id' => 'required',
                                   'user_id' => 'required',
                                   'name' => 'required|max:20',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $unit             = new Unit();
            $unit->department_id  = $request->department_id;
            $unit->name       = $request->name;
            $unit->save();

            $unit_head_id = $request->input("user_id");
            if (!empty($unit_head_id)) {
                $unitHead             = new UnitHead();
                $unitHead->unit_id = $unit->id;
                $unitHead->user_id = $unit_head_id;
                $unitHead->save();
                }

            return redirect()->route('unit.index')->with('success', __('Unit  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Unit $unit)
    {
        return redirect()->route('department.index');
    }

    public function edit(Unit $unit)
    {
        if(\Auth::user()->can('edit unit'))
        {
            $head = UnitHead::where('unit_id', $unit->id)->first();
            $users = User::all()->pluck("name","id");
            $departments = Department::get()->pluck('name', 'id');

                return view('units.edit', compact('unit', 'departments','users','head'));
            
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Unit $unit)
    {
        if(\Auth::user()->can('edit unit'))
        {
            
                $validator = \Validator::make(
                    $request->all(), [
                                       'department_id' => 'required',
                                       'user_id' => 'required',
                                       'name' => 'required|max:20',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $unit->department_id = $request->department_id;
                $unit->name      = $request->name;
                $unit->save();

                $user_head_id = $request->input("user_id");
            if (!empty($user_head_id)) {
                $unitHead = UnitHead::where('unit_id', $unit->id)->first();
                $unitHead->unit_id = $unit->id;
                $unitHead->user_id = $user_head_id;
                $unitHead->save();
                }


                return redirect()->route('unit.index')->with('success', __('Unit successfully updated.'));
           
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Unit $unit)
    {
        if(\Auth::user()->can('delete unit'))
        {
            
                $unit->delete();

                return redirect()->route('unit.index')->with('success', __('Unit successfully deleted.'));
            
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
