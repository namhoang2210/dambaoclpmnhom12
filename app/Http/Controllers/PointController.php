<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function tbmon($cc,$bt,$th,$kt,$ck,$cchs,$bths,$thhs,$kths,$ckhs){
        $tb = ($cc*$cchs/100) + ($bt * $bths/100) + ($th*$thhs/100) + ($kt * $kths/100) + ($ck * $ckhs/100); 
        return $tb;
    }
    
    public function diemChu($tk){
        $dc = '';
        if ($tk<4) {
            $dc = "F";
          }elseif ($tk>=4 && $tk<5.0) {
            $dc = "D";
          }elseif ($tk>=5.0 && $tk<5.5) {
            $dc = "D+";
          }
          elseif ($tk>=5.5 && $tk<6.5) {
            $dc = "C";
          }
          elseif ($tk>=6.5 && $tk<7.0) {
            $dc = "C+";
          }
          elseif ($tk>=7.0 && $tk<8.0) {
            $dc = "B";
          }
          elseif ($tk>=8.0 && $tk<8.5) {
            $dc = "B+";
          }
          elseif ($tk>=8.5 && $tk<9.0) {
            $dc = "A";
          }
          elseif ($tk>=9.0 && $tk<10) {
            $dc = "A+";
          }
          return $dc;
    }

    public function ketQua($tk){
        $kq = 'X';
        if($tk >=4){
            $kq = "Đạt"; 
        }
        return $kq;
    }

    public function tbKi($diem, $tctl){
        $tbm = array();
        $i =0;
        $n = count($diem);
        if($diem != null && $tctl !=null)
        for($i = 0; $i< $n; $i++){
            if ($diem[$i] == 0 ){
                $tctl[$i] = 0;
            }
            $tbm[$i] =  $diem[$i] * $tctl[$i];
        }
        $tbk =  array_sum($tbm)/ array_sum($tctl);
        $tbk = round($tbk,2);
        return $tbk;
    }

    public function tinChiKi($diem, $tctl){
      $i =0;
        $n = count($diem);
        for($i = 0; $i< $n; $i++){
            if ($diem[$i] == 0 ){
                $tctl[$i] = 0;
            }
        }
        $tongTC =  array_sum($tctl);
        return $tongTC;
    }

    public function tinChiCaKhoa($tck){
      $tcck = array_sum($tck);
      return $tcck;
    }

    public function tbCaKhoa($tbK){
      $tbKhoa = array_sum($tbK)/count($tbK);
      $tbK = round($tbKhoa,2);
      return $tbK;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::id();
        $data = DB::table('points')
            ->select('*')
            ->where('student_id','=',$id)
            ->orderBy('no_semester')
            ->get();
        return view('pages.diem',['data' => $data]);
    }

}
