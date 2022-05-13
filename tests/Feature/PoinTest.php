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
    public function testDiemTbMon()
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
    public function testDiemQuyDoiChu()
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
    public function testKetQua()
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
        $diem1 = array(0,1,2,0,2.5);
        $tctl1 = array(2,3,2,2,4);
        $controller = new PointController;
        $tb = $controller->tbKi($diem1,$tctl1);
        $this->assertEquals(1.89,$tb);
    }

    /**
     * Test tín chỉ tích lũy 1 kì.
     *
     * @return void
     */
    public function testTinChiKi()
    {
        $diem = array(0,1,2,2.5,3,1);
        $tctl = array(2,3,2,3,2,4);
        $controller = new PointController;
        $tongTC = $controller->tinChiKi($diem,$tctl);
        $this->assertEquals(14,$tongTC);
    }

    /**
     * Test tín chỉ tích lũy cả khóa.
     *
     * @return void
     */
    public function testTinChiCaKhoa()
    {
        $tck = [13,14,16];
        $controller = new PointController;
        $tongTC = $controller->tinChiCaKhoa($tck);
        $this->assertEquals(43,$tongTC);
    }

    /**
     * Test điểm trung bình cả khóa.
     *
     * @return void
     */
    public function testTbCaKhoa()
    {
        $tbKi = array(2.34,3.12,1.47,2.5,0.24);
        $controller = new PointController;
        $tbKhoa = $controller->tbCaKhoa($tbKi);
        $this->assertEquals(1.93,$tbKhoa);
    }
}
