<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminModuleController extends Controller
{
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        return view('admin.modules.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required|string|max:255',
            'video_url' => 'nullable|string',
            'content'   => 'required|string',
            'order'     => 'required|integer'
        ]);

        Module::create($request->all());
        return redirect()->route('admin.courses.show', $request->course_id)->with('success', 'Modul baru berhasil ditambahkan!');
    }

    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'video_url' => 'nullable|string',
            'content'   => 'required|string',
            'order'     => 'required|integer'
        ]);

        $module->update($request->all());
        return redirect()->route('admin.courses.show', $module->course_id)->with('success', 'Modul berhasil diperbarui!');
    }

    public function destroy(Module $module)
    {
        $courseId = $module->course_id;
        try {
            $module->delete();
            return redirect()->route('admin.courses.show', $courseId)->with('success', 'Modul berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus modul. Pastikan tidak ada data yang tersangkut.');
        }
    }
}