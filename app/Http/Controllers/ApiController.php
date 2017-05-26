<?php
/**
 * Created by PhpStorm.
 * User: Axl Yody
 * Date: 2017/05/26
 * Time: 15:06
 */

namespace Kamus\Http\Controllers;


use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController
{
    use ValidatesRequests;

    public function __construct()
    {

    }

    public function v1(Request $request, $sub)
    {
        if ($sub == 'terjemah') {
            $db = DB::table('kamus')
                ->join('bahasa', 'kamus.bahasa_awal_slug', '=', 'bahasa.slug')
                ->where([
                    'kamus.kata' => $request->get('kata'),
                    'kamus.bahasa_awal_slug' => $request->get('dari'),
                    'kamus.bahasa_akhir_slug' => $request->get('ke'),
                    'kamus.disetujui' => 1
                ])
                ->first();
            if (!$db) {
                return response()->json(array('arti' => $request->get('kata')));
            } else {
                return response()->json($db);
            }
        } elseif ($sub == 'tambah_arti') {
            if ($request->isMethod('POST')) {

                $this->validate($request, [
                    'kata' => 'required',
                    'arti' => 'required'
                ]);

                if (Auth::guest()) {
                    $submitter = '-';
                } else {
                    $submitter = Auth::user()->email;
                }

                DB::table('kamus')
                    ->join('bahasa', 'kamus.bahasa_awal_slug', '=', 'bahasa.slug')
                    ->insert([
                        'kamus.kamus_id' => rand(1000, 9999),
                        'kamus.bahasa_awal_slug' => $request->input('bahasa_awal_slug'),
                        'kamus.bahasa_akhir_slug' => $request->input('bahasa_akhir_slug'),
                        'kamus.slug' => $request->input('slug'),
                        'kamus.kata' => $request->input('kata'),
                        'kamus.arti' => $request->input('arti'),
                        'kamus.disetujui' => false,
                        'kamus.submitter' => $submitter,
                    ]);
                DB::table('kamus')
                    ->join('bahasa', 'kamus.bahasa_awal_slug', '=', 'bahasa.slug')
                    ->insert([
                        'kamus.kamus_id' => rand(1000, 9999),
                        'kamus.bahasa_akhir_slug' => $request->input('bahasa_awal_slug'),
                        'kamus.bahasa_awal_slug' => $request->input('bahasa_akhir_slug'),
                        'kamus.slug' => $request->input('slug'),
                        'kamus.arti' => $request->input('kata'),
                        'kamus.kata' => $request->input('arti'),
                        'kamus.disetujui' => false,
                        'kamus.submitter' => $submitter,
                    ]);
            } else {
                return response()->json(array('kesalahan' => 'Tidak dapat mengirim ke API'));
            }
        } else {
            return response()->json(array('kesalahan' => 'API tidak ditemukan'));
        }
    }
}