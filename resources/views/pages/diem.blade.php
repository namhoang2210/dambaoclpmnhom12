@extends('layouts.app')
@section('title', 'HVCNBCVT - Xem điểm')
@section('content')
<div class="container">
  <?php
    $tbhk = []; //trung bình học kì
    $tbh4 = []; //trung bình hệ 4
    $tcd = []; // tín chỉ đạt
    $tctl = []; // tín chỉ tích lũy
  ?>
    <h2>Xem điểm</h2>
    @foreach ($data as $key =>$data)
      <p style="font-weight: 600; color: rgb(82, 82, 233)">{{$data->name_semester}}</p> 
      <table class="table table-bordered" style="text-align: center; white-space: nowrap" >
        <thead>
          <tr>
              <th>STT</th>
              <th style="width: 380px; text-align: left; padding-left: 10px">Tên môn</th>
              <th>TC</th>
              <th>HS</th>
              <th>CC</th>
              <th>BT</th>
              <th>TH</th>
              <th>KT</th>
              <th>CK</th>
              <th>TK (10)</th>
              <th>TK (CH)</th>
              <th>KQ</th>  
          </tr>   
        </thead>
        <tbody>
          <?php $point = json_decode($data->subject) ?>
        </tbody>
        @foreach ($point as $key1 => $point)
            <tr>
              <td>{{$key1 + 1}}</td>
              <td style=" text-align: left; padding-left: 10px">{{$point->name ?? null}}</td>
              <td>{{$tc=$point->tc ?? null}}</td>
              <td>
                <a data-toggle="modal" data-target="#myModal_{{$key}}_{{$key1}}">Xem</a>
                 <!-- Modal -->
                <div class="modal fade" id="myModal_{{$key}}_{{$key1}}" role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Hệ số điểm</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body" style="text-align: left">
                        <p>Môn học: {{$point->name}}</p>
                        <p>Chuyên cần (CC): {{$point->cc->hs}}% </p>
                        <p>Bài tập (BT): {{$point->bt->hs}}% </p>
                        <p>Thực hành (TH): {{$point->th->hs}}% </p>
                        <p>Kiểm tra (KT): {{$point->kt->hs}}% </p>
                        <p>Cuối kì (CK): {{$point->ck->hs}}% </p>
                      </div>
                      <div class="modal-footer" style="justify-content: center;">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Đóng</button>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </td>
              <td>{{$cc=$point->cc->d ?? null}}</td>
              <td>{{$bt=$point->bt->d ?? null}}</td>
              <td>{{$th=$point->th->d ?? null}}</td>
              <td>{{$kt=$point->kt->d ?? null}}</td>
              <td>{{$ck=$point->ck->d ?? null}}</td>
              <td>
                @if ($ck > 0)
                  {{$tk = $cc*($point->cc->hs)/100 + $bt*($point->bt->hs)/100 + $kt*($point->kt->hs)/100 + $th*($point->th->hs)/100 + $ck*($point->ck->hs)/100}}
                @else
                  {{$tk = 0}}
                @endif
              </td>
              <?php
              $dc ='';
              if ($ck == 0) {
                $dc = "F";
                $tb = null;
                $tcd[$key1] = null;
              }else{
                if ($tk<4) {
                  $dc = "F";
                  $tb = null;
                  $tcd[$key1] = null;
                }elseif ($tk>=4 && $tk<5.0) {
                  $dc = "D";
                  $tb = 1;
                  $tcd[$key1] = $point->tc;
                }elseif ($tk>=5.0 && $tk<5.5) {
                  $dc = "D+";
                  $tb = 1.5;
                  $tcd[$key1] = $point->tc;
                }
                elseif ($tk>=5.5 && $tk<6.5) {
                  $dc = "C";
                  $tb = 2;
                  $tcd[$key1] = $point->tc;
                }
                elseif ($tk>=6.5 && $tk<7.0) {
                  $dc = "C+";
                  $tb = 2.5;
                  $tcd[$key1] = $point->tc;
                }
                elseif ($tk>=7.0 && $tk<8.0) {
                  $dc = "B";
                  $tb = 3;
                  $tcd[$key1] = $point->tc;
                }
                elseif ($tk>=8.0 && $tk<8.5) {
                  $dc = "B+";
                  $tbh4[$key1] = 3.5;
                  $tcd[$key1] = $point->tc;
                }
                elseif ($tk>=8.5 && $tk<9.0) {
                  $dc = "A";
                  $tb = 3.7;
                  $tcd[$key1] = $point->tc;
                }
                elseif ($tk>=9.0 && $tk<10) {
                  $dc = "A+";
                  $tb = 4;
                  $tcd[$key1] = $point->tc;
                }
                if ($dc !='F') {
                  $tbh4[$key1] = $tb * $tcd[$key1];
                } else {
                  $tbh4[$key1] = null;
                }
              }
            ?>
            <td>{{$dc}}</td>
            <td>@if($dc=='F') X @else Đạt @endif</td>
            </tr>
        @endforeach
      </table>  
      <div style="margin-left: 4px; padding-bottom: 10px; font-size: 16px">
        <?php
          $array = array_filter($tbh4);
          $tctl[$key] = array_sum($tcd);
          if ($tctl[$key] >0) {
            $tb4 = array_sum($array)/$tctl[$key];
          }
          $tbhk[$key] = $tb4;  
          $ttctl = array_sum($tctl);
          $tbn = array_sum($tbhk)/count($tbhk);
        ?>
        <p>Điểm trung bình học kì (hệ 4): {{round($tb4,2)}}</p>
        <p>Điểm trung bình tích lũy (hệ 4): {{round($tbn,2)}}</p> 
        <p>Tín chỉ đạt: {{$tctl[$key]}}</p>
        <p>Tín chỉ tích lũy: {{$ttctl}}</p>
      </div>
    @endforeach
  </div>
@endsection