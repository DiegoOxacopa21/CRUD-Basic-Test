<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{


    public function store(Request $request) {
        $validated = $request->validate(
            [
                'codigo'    => 'required|unique:students,codigo',
                'name'      => 'required',
                'surname'   => 'required',
                'age'       => 'required|numeric',
                'email'     => 'required|email'
            ]
        );

        Student::create($validated);

        return redirect()->route('students.index')->with('info', 'Se creó correctamente');
    }


    public function update(Request $request, string $id) {
        $validated = $request->validate([
            'codigo'    => 'required|unique:students,codigo,' . $id,
            'name'      => 'required',
            'surname'   => 'required',
            'age'       => 'required|numeric',
            'email'     => 'required|email'
        ]);

        $student = Student::findOrFail($id);

        $student->fill($validated)->save();

        return redirect()->route('students.index')->with('info', 'Se guardaron los cambios correctamente.');
    }

    /**
     * ELIMINAR
     */
    public function destroy(string $id) {
        Student::findOrFail($id)->delete();

        return redirect()->route('students.index')->with('info', 'Se eliminó correctamente.');
    }


    /**
     * LISTADO DE TODOS LOS ESTUDIANTES
     */
    public function index() {
        $students = Student::all();

        return view('students.index')->with('students', $students);
    }


}