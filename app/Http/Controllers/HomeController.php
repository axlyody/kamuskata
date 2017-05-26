<?php

namespace Kamus\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 * @package Kamus\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bahasa = DB::table('bahasa');
        return view('home', array('bahasa' => $bahasa));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tambah_arti()
    {
        $bahasa = DB::table('bahasa')
            ->get();
        return view('tentukan', array('bahasa' => $bahasa));
    }


    // ADMIN SECTION

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function database(Request $request)
    {
        $ambilDB = "";
        $ambilBahasa = "";
        $judulb = "";
        if ($request->get('bahasa')) {
            $ambilDB = DB::table('kamus')
                ->join('bahasa', 'kamus.bahasa_awal_slug', '=', 'bahasa.slug')
                ->where('kamus.bahasa_awal_slug', $request->get('bahasa'))
                ->get();
            $judulb = DB::table('bahasa')->where('slug', $request->get('bahasa'))->first();
            if (empty($judulb)) {
                return redirect('/');
            }
        }

        $ambilBahasa = DB::table('bahasa')
            ->orderBy('slug', 'asc')
            ->get();
        return view('admin_database', array('data' => $ambilDB, 'bahasa' => $ambilBahasa, 'judul' => $judulb));
    }

    /**
     * @param $slug
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function database_del($slug, $id)
    {
        DB::table('kamus')
            ->where([
                'kamus.kamus_id' => $id,
                'kamus.bahasa_awal_slug' => $slug
            ])
            ->delete();
        return redirect('database?bahasa=' . $slug);
    }

    /**
     * @param $slug
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function database_acc($slug, $id)
    {
        DB::table('kamus')
            ->where([
                'kamus.kamus_id' => $id,
                'kamus.bahasa_awal_slug' => $slug
            ])
            ->update([
                'kamus.disetujui' => 1
            ]);
        return redirect('database?bahasa=' . $slug);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bahasa()
    {
        $data = DB::table('bahasa')->get();
        return view('admin_bahasa', array('data' => $data));
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function bahasa_del($slug)
    {
        DB::table('bahasa')
            ->where([
                'bahasa.slug' => $slug,
            ])
            ->delete();
        return redirect('bahasa');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bahasa_add(Request $request)
    {

        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'slug' => 'required',
                'bahasa' => 'required'
            ]);

            DB::table('bahasa')
                ->insert([
                    'slug' => $request->input('slug'),
                    'bahasa' => $request->input('bahasa'),
                    'created_at' => Carbon::now()
                ]);

            $request->session()->flash('alert-success', 'Bahasa telah ditambahkan');
        }

        return view('admin_bahasa_tambah');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terjemahan_saya()
    {
        $data = DB::table('kamus')
            ->where('submitter', Auth::user()->email)
            ->get();
        return view('terjemahan_saya', array('data' => $data));
    }


}
