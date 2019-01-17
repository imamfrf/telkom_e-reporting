<?php

namespace App\Http\Controllers;
date_default_timezone_set('Asia/Jakarta');


use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use mysql_xdevapi\Exception;
use App\Post;

class PagesController extends Controller
{
    public function dashboard(){
        $prj_prospect = $prj_sub = $prj_win = $prj_bill = array("DBS"=>0, "DGS"=>0, "DES"=>0);
        $rev_prospect = $rev_sub = $rev_win = $rev_bill = array("DBS"=>0, "DGS"=>0, "DES"=>0);
        if (!auth()->guest()){
            $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
            $prospect = array("proj"=>0, "revenue"=>0);
            $submission = array("proj"=>0, "revenue"=>0);
            $win = array("proj"=>0, "revenue"=>0);
            $billcomp = array("proj"=>0, "revenue"=>0);

            try{
                $filter_bud = Input::get('bud');
                $week = Input::get('week');

                if (count($posts) > 0){
                    if ($filter_bud == null && $week == null){
                        //foreach ($posts as $post){
                                $prospect["proj"] = Post::where('status', 'Prospect')->sum('nilai_proj');
                                $prospect["revenue"] = Post::where('status', 'Prospect')->sum('revenue');

                                $submission["proj"] = Post::where('status', 'Submission')->sum('nilai_proj');
                                $submission["revenue"] = Post::where('status', 'Submission')->sum('revenue');

                                $win["proj"] = Post::where('status', 'Win')->sum('nilai_proj');
                                $win["revenue"] = Post::where('status', 'Win')->sum('revenue');

                                $billcomp["proj"] = Post::where('status', 'BillComp')->sum('nilai_proj');
                                $billcomp["revenue"] = Post::where('status', 'BillComp')->sum('revenue');

                        //}
                    }
                    else{
                        foreach ($posts as $post){
                            $now = new DateTime(date('Y-m-d H:i:s'));
                            $update = new DateTime($post->updated_at);
                            $interval = $now->diff($update);
                            $interval_int = (int)$interval->format('%d');

                            if ($interval_int <= 7){

                                if ($post->status == 'Prospect'){
                                    if ($post->bud == 'DBS'){
                                        $prj_prospect['DBS'] += $post->nilai_proj;
                                        $rev_prospect['DBS'] += $post->revenue;
                                    }
                                    else if ($post->bud == 'DGS'){
                                        $prj_prospect['DGS'] += $post->nilai_proj;
                                        $rev_prospect['DGS'] += $post->revenue;
                                    }
                                    else{
                                        $prj_prospect['DES'] += $post->nilai_proj;
                                        $rev_prospect['DES'] += $post->revenue;

                                    }
                                }
                                else if($post->status == 'Submission'){
                                    $prj_sub[$post->bud] += $post->nilai_proj;
                                    $rev_sub[$post->bud] += $post->revenue;
                                }
                                else if($post->status == 'Win'){
                                    $prj_win[$post->bud] += $post->nilai_proj;
                                    $rev_win[$post->bud] += $post->revenue;
                                }
                                else if($post->status == 'Billcomp'){
                                    $prj_bill[$post->bud] += $post->nilai_proj;
                                    $rev_bill[$post->bud] += $post->revenue;
                                }
                            }
                        }

                        if ($week == 'this'){
                            if ($filter_bud == 'All'){

                                $prospect["proj"] = $prj_prospect['DBS']+$prj_prospect['DGS']+$prj_prospect['DES'];
                                $prospect["revenue"] = $rev_prospect['DBS']+$rev_prospect['DGS']+$rev_prospect['DES'];

                                $submission["proj"] = $prj_sub['DBS']+$prj_sub['DGS']+$prj_sub['DES'];
                                $submission["revenue"] = $rev_sub['DBS']+$rev_sub['DGS']+$rev_sub['DES'];

                                $win["proj"] = $prj_win['DBS']+$prj_win['DGS']+$prj_win['DES'];
                                $win["revenue"] = $rev_win['DBS']+$rev_win['DGS']+$rev_win['DES'];

                                $billcomp["proj"] = $prj_bill['DBS']+$prj_bill['DGS']+$prj_bill['DES'];
                                $billcomp["revenue"] = $rev_bill['DBS']+$rev_bill['DGS']+$rev_bill['DES'];
                            }
                            else{
                                $prospect["proj"] = $prj_prospect[$filter_bud];
                                $prospect["revenue"] = $rev_prospect[$filter_bud];

                                $submission["proj"] = $prj_sub[$filter_bud];
                                $submission["revenue"] = $rev_sub[$filter_bud];

                                $win["proj"] = $prj_win[$filter_bud];
                                $win["revenue"] = $rev_win[$filter_bud];

                                $billcomp["proj"] = $prj_bill[$filter_bud];
                                $billcomp["revenue"] = $rev_bill[$filter_bud];
                            }

                            //}
                        }
                        else{
                            if ($filter_bud == 'All'){
                                $prospect["proj"] = Post::where('status', 'Prospect')->sum('nilai_proj');
                                $prospect["revenue"] = Post::where('status', 'Prospect')->sum('revenue');

                                $submission["proj"] = Post::where('status', 'Submission')->sum('nilai_proj');
                                $submission["revenue"] = Post::where('status', 'Submission')->sum('revenue');

                                $win["proj"] = Post::where('status', 'Win')->sum('nilai_proj');
                                $win["revenue"] = Post::where('status', 'Win')->sum('revenue');

                                $billcomp["proj"] = Post::where('status', 'BillComp')->sum('nilai_proj');
                                $billcomp["revenue"] = Post::where('status', 'BillComp')->sum('revenue');
                            }
                            else{
                                $prospect["proj"] = Post::where('status', 'Prospect')->where('bud',$filter_bud)->sum('nilai_proj');
                                $prospect["revenue"] = Post::where('status', 'Prospect')->where('bud',$filter_bud)->sum('revenue');

                                $submission["proj"] = Post::where('status', 'Submission')->where('bud',$filter_bud)->sum('nilai_proj');
                                $submission["revenue"] = Post::where('status', 'Submission')->where('bud',$filter_bud)->sum('revenue');

                                $win["proj"] = Post::where('status', 'Win')->sum('nilai_proj');
                                $win["revenue"] = Post::where('status', 'Win')->sum('revenue');

                                $billcomp["proj"] = Post::where('status', 'BillComp')->where('bud', $filter_bud)->sum('nilai_proj');
                                $billcomp["revenue"] = Post::where('status', 'BillComp')->where('bud', $filter_bud)->sum('revenue');
                            }
                        }
                    }

                    
                }
            }
            catch (Exception $e){
            }



            return view('pages.dashboard')->with("posts", $posts)->with("prospect", $prospect)->with("submission", $submission)
                ->with("win", $win)->with("billcomp", $billcomp);
        }
        else{
            return redirect('/login');
        }
    }
}
