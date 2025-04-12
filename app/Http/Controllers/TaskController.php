<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    public function index()
    {
        $data = [
            'task' => Task::where('status', 'Dalam Proses')->get(),
            'kategori' => Kategori::all()
        ];
        return view('task.index', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'due_date' => 'required'
        ], [
            'judul.required' => 'Judul harus diisi',
            'kategori_id.required' => 'Kategori harus diisi',
            'due_date.required' => 'Due date harus diisi'
        ]);

        $task = new Task;
        $task->judul = $request->judul;
        $task->kategori_id = $request->kategori_id;
        $task->due_date = $request->due_date;
        $task->status = 'Dalam Proses';

        $task->priority = $request->has('priority') ? $request->priority : null;

        $task->save(); 

        Alert::toast('Task berhasil ditambahkan', 'success');
        return redirect()->route('task');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'due_date' => 'required'
        ], [
            'judul.required' => 'Judul harus diisi',
            'kategori_id.required' => 'Kategori harus diisi',
            'due_date.required' => 'Due date harus diisi'
        ]);

        $task = Task::findOrFail($id);
        $task->judul = $request->judul;
        $task->kategori_id = $request->kategori_id;
        $task->due_date = $request->due_date;
        $task->priority = $request->has('priority') ? $request->priority : $task->priority;

        $task->save();

        Alert::toast('Task berhasil diperbarui', 'success');
        return redirect()->route('task');
    }

    public function importantTasks()
    {
        $task = Task::where('priority', 'ya')
                    ->where('status', 'Dalam Proses')
                    ->get();
        $kategori = Kategori::all();
        return view('task.important', compact('task', 'kategori'));
    }
    

    public function markAsDone($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'Selesai';
        $task->save();

        Alert::toast('Task berhasil ditandai sebagai selesai', 'success');
        return redirect()->route('task.AsCompleted');
    }

    public function completedTasks()
    {
        $task = Task::where('status', 'Selesai')->get();
        $kategori = Kategori::all();
        return view('task.completed', compact('task','kategori'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'Terhapus']);
        $task->delete();

        Alert::toast('Task telah dipindahkan ke menu terhapus', 'warning');
        return redirect()->route('task');
    }


    public function deletedTasks()
    {
        $task = Task::onlyTrashed()->get();
        $kategori = Kategori::all();
        return view('task.deleted', compact('task','kategori'));
    }

    // restore task
    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->update(['status' => 'Dalam Proses']);
        $task->restore();

        Alert::toast('Task berhasil dikembalikan', 'success');
        return redirect()->route('task');
    }

    // hapus Permanen
    public function forceDelete($id)
    {
        $task = Task::withTrashed()->findOrFail($id); // Pakai withTrashed() agar semua task bisa ditemukan
    
        if ($task->deleted_at) { // Pastikan hanya yang sudah di-soft delete yang bisa dihapus permanen
            $task->forceDelete();
            Alert::toast('Task telah dihapus secara permanen', 'danger');
        } else {
            Alert::toast('Task belum dihapus, tidak bisa dihapus permanen!', 'warning');
        }
    
        return redirect()->back();
    }
    


    public function autoDeleteOldTasks()
    {
        Task::onlyTrashed()
            ->where('deleted_at', '<', Carbon::now()->subDays(30))
            ->forceDelete();
    }

}
