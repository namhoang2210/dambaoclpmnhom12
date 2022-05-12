<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\PointController;
class PoinTest extends TestCase
{
       /**
     * Test tính điểm trung bình môn.
     *
     * @return void
     */
    public function testTbMon()
    {   
        $cc = '7';
        $bt = '2';
        $th = '0';
        $kt = '3';
        $ck = '8';
        $cchs = '10';
        $bths = '10';
        $thhs = '0';
        $kths = '10';
        $ckhs = '70';
        $controller = new PointController;
        $tbm = $controller->tbmon($cc,$bt,$th,$kt,$ck,$cchs,$bths,$thhs,$kths,$ckhs);
        $this->assertEquals(6.8,$tbm); 
    }

    /**
     * Test quy đổi điểm chữ.
     *
     * @return void
     */
    public function testDiemChu()
    {   
        $tk = 3;
        $controller = new PointController;
        $tbm = $controller->diemChu($tk);
        $this->assertEquals('F',$tbm); 
    }

    /**
     * Test kết quả môn học đạt hay trượt.
     *
     * @return void
     */
    public function testKetqua()
    {
        $tk =4;
        $controller = new PointController;
        $kq = $controller->ketQua($tk);
        $this->assertEquals('Đạt',$kq); 
    }

    /**
     * Test điểm trung bình 1 học kì
     *
     * @return void
     */
    public function testTbKi()
    {
        $diem = array(0,1,2);
        $tctl = array(2,3,2);
        $controller = new PointController;
        $tb = $controller->tbKi($diem,$tctl);
        $tbk = round($tb,2);
        $this->assertEquals(1.4,$tbk);
    }
}
