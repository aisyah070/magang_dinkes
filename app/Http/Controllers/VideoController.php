<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function Video()
    {
        $data = Video::all(); // Mengambil semua data video dari tabel 'videos'
        return view('video', compact('data')); // Mengirim data video ke view 'video'
    }

    public function createVideo()
    {
        return view('video.create'); // Menampilkan form untuk menambahkan video baru
    }

    public function storeVideo(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'iframe_video' => 'nullable|string|required_without:file_video', // Wajib jika file_video kosong
            'file_video' => 'nullable|file|mimes:mp4,mkv|max:204800|required_without:iframe_video', // Wajib jika iframe_video kosong
        ]);

        // Upload file video jika ada
        $filePath = null;
        $namaFile = null; // Variabel untuk menyimpan nama file asli
        if ($request->hasFile('file_video')) {
            // Mendapatkan ekstensi file

            $extension = $request->file('file_video')->getClientOriginalExtension();

            // Membuat nama file berdasarkan judul dan ekstensi
            $namaFile = $request->judul . '-' . time() . '.' . $extension; // Misal: "meeting kkg.mp4"

            // Menyimpan file dengan nama yang telah dibuat
            $filePath = $request->file('file_video')->storeAs('videos', $namaFile, 'public');
        }

        // Simpan data ke database
        Video::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'iframe_video' => $request->iframe_video,
            'file_video' => $filePath,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);


        return redirect()->route('video')->with('success', 'Video berhasil diunggah');
    }


    public function editVideo($id)
    {
        $video = Video::findOrFail($id); // Cari video berdasarkan ID
        return view('video.edit', compact('video')); // Mengirim data video untuk diedit
    }

    public function updateVideo(Request $request, $id)
    {
        $video = Video::findOrFail($id); // Cari video berdasarkan ID

        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'iframe_video' => 'nullable|string|',
            'file_video' => 'nullable|file|mimes:mp4,mkv|max:204800|',
        ]);

        if ($request->hasFile('file_video')) {
            $newFileVideo = $request->file('file_video');
            $newFileVideoPath = $newFileVideo->storeAs('videos', $request->judul . '-' . time() . '.' . $newFileVideo->getClientOriginalExtension(), 'public');

            if ($video->file_video) {

                Storage::disk('public')->delete($video->file_video);
            }


            $video->file_video = $newFileVideoPath;
        }

        // Update data lainnya
        $video->judul = $request->judul;
        $video->deskripsi = $request->deskripsi;
        $video->iframe_video = $request->iframe_video;
        $video->save();

        return redirect()->route('video')->with('success', 'Video berhasil diperbarui');
    }

    public function deleteVideo($id)
    {
        $video = Video::findOrFail($id); // Cari video berdasarkan ID

        // Hapus file video jika ada
        if ($video->file_video) {
            Storage::disk('public')->delete($video->file_video);
        }

        // Hapus data video dari database
        $video->delete();

        return redirect()->route('video')->with('success', 'Video berhasil dihapus');
    }

    public function deleteOnlyVideo($id)
    {
        $video = Video::findOrFail($id);

        if ($video->file_video) {
            Storage::disk('public')->delete($video->file_video);
        }
        $video->file_video = null;
        $video->save();

        return back()->with('success', 'berhasil menghapus video saja!!');
    }
}
