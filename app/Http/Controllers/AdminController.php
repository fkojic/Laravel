<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input as Input;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Requests;

use App\Automobili;
use App\Kategorije;
use App\User;
use App\Odobrenje;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
    	$automobili = DB::table('automobili')->leftJoin('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
    				->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika')
    				->whereNull('odobrenja.automobili_id')->get();
    	
    	$odobreni = DB::table('automobili')->join('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
    					->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika', 'odobrenja.id as odobreniId')
    					->where('odobrenja.odobren', true)->get();


    	return view('admin.dashboard', compact('automobili', 'odobreni'));
    }

    public function store(Request $request)
    {
	 	$od = new Odobrenje;
        $od->odobren = $request->input('odobren');
        $od->automobili_id = $request->input('automobil_id');
        $od->save();

        $automobili = DB::table('automobili')->leftJoin('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
				->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika')
				->whereNull('odobrenja.automobili_id')->get();
	
		$odobreni = DB::table('automobili')->join('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
					->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika', 'odobrenja.id as odobreniId')
					->where('odobrenja.odobren', true)->get();


        	return view('admin.odobravenje', compact('automobili', 'odobreni'));
    }

    public function update(Request $request)
    {		
    	$automobili_id = $request->input('automobil_id');
        Odobrenje::where('id','=', $automobili_id)->delete();

	 	$automobili = DB::table('automobili')->leftJoin('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
				->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika')
				->whereNull('odobrenja.automobili_id')->paginate(10);
	
		$odobreni = DB::table('automobili')->join('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
					->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika', 'odobrenja.id as odobreniId')
					->where('odobrenja.odobren', true)->paginate(10);

        return view('admin.odobravenje', compact('automobili', 'odobreni'));
    }

    public function createKategoriju()
    {
    	$kategorije = DB::table('kategorije')->orderBy('ime', 'ASC')->get();
    	
    	return view('admin.kategorije', compact('kategorije'));
    }

    public function storeKategoriju(Request $request)
    {		
		 	$od = new Kategorije;
	        $od->ime = $request->input('imeKategorije');
	        $od->save();
        	return $this->createKategoriju();
    }

    public function destroyKategoriju(Request $request)
    {		
	        $kategorija_id = $request->input('kategorija_id');
	        
	        Kategorije::where('id','=', $kategorija_id)->delete();
            return $this->createKategoriju();
    }
    public function adminAutomobili()
    {
       $odobreni = DB::table('automobili')->join('odobrenja', 'automobili.id', '=', 'odobrenja.automobili_id')
                    ->select('automobili.id as autoId', 'automobili.ime', 'automobili.cena', 'automobili.km', 'automobili.godiste', 'automobili.slika', 'odobrenja.id as odobreniId')
                    ->where('odobrenja.odobren', true)->orderBy('automobili.created_at', 'DESC')->paginate(10);


            return view('admin.adminAutomobili', compact('odobreni'));
    }

    public function pushKategoriju(Request $request)
    {
        $kategorija = Kategorije::select('id')->where('ime', 'Audi')->get();
        $katId = json_decode($kategorija, true);

        $odobrenja = Automobili::select('id')->where('kategorija_id', '=', $katId)->get();
        $odId = json_decode($odobrenja, true);

        if($odId != ''){
            foreach ($odId as $od) {
                Odobrenje::where('automobili_id', '=', $od['id'])->delete();
            }
            
        }

        Automobili::where('kategorija_id','=', $katId)->delete();
        
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.polovniautomobili.com/putnicka-vozila/pretraga?page=1&sort=renewDate_desc&brand=38&price_from=40000&city_distance=0&showOldNew=all&without_price=1');
        
        $stranice = $crawler->filter('ul[class="uk-pagination uk-pagination-left"] > li ')->each(function ($node) {
                return json_decode($node->text(), true);
                });
        $brStrana = max($stranice);

        for($i = 1; $i <= $brStrana; $i++){

        $crawler = $client->request('GET', 'https://www.polovniautomobili.com/putnicka-vozila/pretraga?page='.$i.'&sort=renewDate_desc&brand=38&price_from=40000&city_distance=0&showOldNew=all&without_price=1');
        
        $ime[] = $crawler->filter('span[class=" uk-width-medium-7-10 uk-width-7-10"] > a')->each(function ($node) {
                return $node->attr('title');
                });

        $cena[] = $crawler->filter('span[class=" uk-width-medium-3-10 uk-width-3-10  uk-text-right uk-padding-remove"] > span')->each(function ($node) {
                    return $node->text();
                });

        $result[] = $crawler->filter('script[type="application/ld+json"]')->each(function ($node) {
            return json_decode($node->text(), true);
        });

        }

        $novaCena = array();
        for($i = 0; $i < $brStrana; $i++){
            foreach($cena[$i] as $ce){
                if(strpos($ce, ' €') == true){
                    $novaCena[] = $ce;
                }
            }
        }



        $k = 0;$br = 0;$im=0;
        for($i = 0; $i < $brStrana; $i++){
            foreach($result[$i] as $row){
                if($row[0]['@type'] == 'Car' && $row[0]['brand'] == ' Audi '){
                    //echo $k.'<br>';
                    //echo $katId[0]['id'].'<br>';
                    //echo $row[0]['productionDate'].'<br>';
                    if(strpos($row[0]['mileageFromOdometer'], '.') == true){
                        $kmT = str_replace(" KMT","",$row[0]['mileageFromOdometer']);
                        $km = str_replace(".","", $kmT);
                        //echo 'Kilometraza: '.$km.'<br>';
                    }
                    else{
                        $km = str_replace(" KMT","",$row[0]['mileageFromOdometer']);
                        //echo 'Kilometraza: '.$km.'<br>';
                    }
                    //echo $row[0]['image'].'<br>';
                    //echo $row[0]['name'].'<br>';
                    $ce = str_replace(" €","",$novaCena[$k]);
                    $c = str_replace(".","",$ce);
                    //echo $c.'<br>';
                    $k++;

                $au = new Automobili;
                $au->ime = $row[0]['name'];
                $au->cena = $c;
                $au->godiste = $row[0]['productionDate'];
                $au->km = $km;
                $au->slika = $row[0]['image'];
                $au->user_id = Auth::user()->id;
                $au->kategorija_id = $katId[0]['id'];
                $au->save();

                }
            }
        }

        $odobrenja = Automobili::select('id')->where('kategorija_id', '=', $katId)->get();
        $odobren = json_decode($odobrenja, true);
            foreach($odobren as $od){
                $id = $od['id'];
                $od = new Odobrenje;
                $od->odobren = 1;
                $od->automobili_id = $id;
                $od->save();
            }

        return redirect('/adminAutomobili');
        
        
    }
}