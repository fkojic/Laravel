<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input as Input;

use App\Automobili;
use App\Kategorije;
use App\User;

class AutomobiliController extends Controller
{
    public function index()
    {
    	$automobili = DB::table('automobili')->join('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
                        ->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika', 'odobrenja.id as odobreniId')
                        ->where('odobrenja.odobren', true)->orderBy('automobili.created_at', 'DESC')->paginate(10);
    	$autoKategorija = DB::table('kategorije')->orderBy('ime', 'ASC')->get();

    	return view('auto.index', compact('automobili', 'autoKategorija'));
    }

    public function show($id)
    {
    	$auto = Automobili::join('kategorije', 'automobili.kategorija_id', '=', 'kategorije.id')
    			->join('users', 'automobili.user_id', '=', 'users.id')
    			->select('automobili.ime as autoIme', 'automobili.cena', 'kategorije.ime as katIme', 'automobili.godiste', 'automobili.km', 'automobili.slika', 'users.name', 'users.email')
    			->where('automobili.id', $id)->first();

    	return view('auto.show', compact('auto'));
    }

    public function create()
    {
    	$autoKategorija = DB::table('kategorije')->orderBy('ime', 'ASC')->get();

    	return view('auto.create', compact('autoKategorija'));
    }

    public function store(Request $request)
    {
    	if(Input::hasfile('slika')){
    		$slika = Input::file('slika');
    		$slika->move('uploads', $slika->GetClientOriginalName());
	    	$imeSlike = 'uploads/'.$slika->GetClientOriginalName();

            $od = new Automobili;
            $od->ime = $request->input('ime');
            $od->cena = $request->input('cena');
            $od->godiste = $request->input('godiste');
            $od->km = $request->input('km');
            $od->slika = $imeSlike;
            $od->user_id = $request->input('user_id');
            $od->kategorija_id = $request->input('kategorija_id');
            $od->save();

            return $this->index();
    	}
    }
    public function kategorije(Request $request)
    {
    	$id = $request->input('kategorija_id');
    	if($id == null)
    	{
    		$automobili = DB::table('automobili')->join('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
                        ->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika', 'odobrenja.id as odobreniId')
                        ->where('odobrenja.odobren', true)->orderBy('automobili.created_at', 'DESC')->get();
    	}
    	else
    	{
    	       $automobili = DB::table('automobili')->join('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
                        ->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika', 'automobili.kategorija_id', 'odobrenja.id as odobreniId')
                        ->where(['odobrenja.odobren'=> true, 'automobili.kategorija_id'=> $id])->orderBy('automobili.created_at', 'DESC')->get();
        }
    	if(count($automobili) == 0)
    	{
    		return '<div class="alert alert-danger" role="alert">Nema oglasa za trazenu kategoriju!</div>';
    	}	



    	return view('auto.kategorije', compact('automobili'));
    }
}
