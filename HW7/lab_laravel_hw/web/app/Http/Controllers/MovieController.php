<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function listRating(Request $request){
        $listRating = Movie::all();
        return view('display', ["data" => $listRating]);
    }

    public function importRating(Request $request){
        $lines = file( public_path () . '/ratings_small.csv');

        $header = array_shift($lines);
        
        $ratings = array_map(function ($line) use ($header) {
            $rating = array_combine(
                str_getcsv($header),
                str_getcsv($line)
            );        
            unset($rating['timestamp']);
            return $rating;
        }, $lines);

        Movie::insert(array_slice($ratings,0,1000));
        return redirect()->route('display');
    }

    public function clearRating(){
        Movie::truncate();
        return redirect()->route('display');
    }

    public function deleteRating(Request $request){
        Movie::where('id', $request['deleteId'])->delete();
        return redirect()->back();
    }

    public function searchRating(Request $request){
        $listRating = Movie::where('userId', $request['user_id'])->get();
        return view('display', ["data" => $listRating]);
    }

    public function updateRating(Request $request){
        $rating = Movie::where('userId', $request['user'])->where('movieId', $request['movie']);
        if($rating->get()->count() > 0) {
            $rating->update(['rating' => $request['rating']]);
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(['此user, movie組合不存在']);
        }
    }

    public function recommendMovie(Request $request){
        $lines = file( public_path () . '/recommend.csv');
        $header = array_shift($lines);
        
        $recommendList = array_map(function ($line) use ($header) {
            $recommend = array_combine(
                str_getcsv($header),
                str_getcsv($line)
            );
            return $recommend;
        }, $lines);
        $keyId = array_search($request['movie_id'], array_column($recommendList, 'userId'));
        $msg = '推薦電影ID:'.$recommendList[$keyId]['movieId'].', '.$recommendList[$keyId+1]['movieId'];
        return redirect()->back()->with('message', $msg);
    }
}
