<?php

namespace app\models;

use Yii;
use yii\mongodb\file\ActiveRecord;

class AbsbFile extends ActiveRecord
{
	// private $name;
	public $basename = '';
	private $modelflag = '';
	private $absbdata = [];
	const ABSB_IMAGE = 'absbimage';

	public function getRecord($name='')
	{
		$record = self::find()
			->from('fs')
			->where(['like','filename',$name])
			->limit(1)
			->one();
		if ($record) {
			$record->basename = $name;
		}
		return $record;
	}

	public function getAbsbdata()
	{
		return $this->absbdata;
	}

	public function getImagePath()
	{
		return sprintf("%s/%s/%s/%s", 
			Yii::getAlias('@web'), 
			self::ABSB_IMAGE,
			$this->modelflag, 
			$this->basename
		);
	}

	public function generateImage()
	{
		$tmppath = sprintf("%s/%s/%s", Yii::getAlias('@runtime'), $this->modelflag, $this->basename);
        $tmpfile = sprintf("%s/%s", $tmppath, 'zipfile');
        if ($this->writeFile($tmpfile)) {
            // echo "write file";
            $cmd = '7z e '.$tmpfile.' -o'.$tmppath;
            $ret = exec($cmd);

            $data = [];
            //show生成图像

            $files=glob($tmppath."/*.txt");
            $imagepath = sprintf("%s/%s/%s/%s", 
				Yii::getAlias('@webroot'), 
				self::ABSB_IMAGE,
				$this->modelflag, 
				$this->basename
			);
            foreach ($files as $value) {
                $itemname = basename($value, '.txt');
                $filecontent=file_get_contents($value);
                if (stripos($value,'deviceinfo.txt')) {
                    $deviceinfo=$filecontent;
                }
                else{
                    $xgdarr=getxgd($filecontent);
                    makeimage($xgdarr,sprintf('%s/%s.jpg',$imagepath,$itemname),$itemname);
                    $data[] = [
                        'name' => $itemname,
                        'content' => $filecontent,
                    ];
                }
            }
            $this->absbdata = $data;
        }
	}
}

//获取吸光度
function getxgd($content){
    for ($i=0; $i < 40 ; $i++) { 
        $content=strstr($content, 'A:');
        if (!is_string($content)) {
          break;
        }
        $startpos=strpos($content, 'A:')+2;
        $endpos=strpos($content, chr(0x0a));
        $data[$i]=floatval(substr($content, $startpos,$endpos-$startpos));
        $content=strstr($content, chr(0x0a));//chr(0x0a)
    }
    return $data;
}
//生成图像
function makeimage($data=array(),$file='',$title=''){
    // $count=count($patharr);
    $imagelenth=400;//500;
    $imagewidth=800;//200;
    if (!file_exists($file)) {
        if (!file_exists(dirname($file))) {
            mkdir(dirname($file));
        }   
        $image = imagecreatetruecolor($imagelenth,$imagewidth);  
        $bgcolor = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgcolor);          
        //设置字体颜色  
        $textcolor = imagecolorallocate($image,255,0,0);         
        //把字符串写在图像左上角  
        imagestring($image,20,10,$imagewidth/2,$title,$textcolor);  
        $textcolor = imagecolorallocate($image,128,128,128); 
        $imagecolor = imagecolorallocate($image,0,255,0);
        $max=-100000;$min=100000; 
        $xlenth=0;
        foreach ($data as $key => $value) {
            if ($max<$value) {
              $max=$value;
            }
            if ($min>$value) {
              $min=$value;
            }
            if ($xlenth<$key) {
               $xlenth=$key;
            }
        }
        $res=calckbr2($data);
        $mink=0.05;//suofang
        $sub=(($max-$min)>$mink)?($max-$min):$mink;
        $aver=($max+$min)/2;

        foreach ($data as $key => $value) {
            $tempx=intval(($data[$key]-$aver)*$xlenth/$sub);//$imagelenth/$xlenth*$key;
            $tempy=$imagewidth/$xlenth*$key;//intval(($data[$key]-$aver)*$imagewidth/$sub);
            if (isset($px1)&&isset($py1)) {
                $px0=$px1;
                $py0=$py1;
                $px1=$tempx;
                $py1=$tempy;      
                imageline($image, 0.5*$imagelenth-$px0,$py0 ,0.5*$imagelenth-$px1 ,$py1 , $textcolor); 
                // if ($res['calc']&&$res['r2']>0.6) {
                //    imagestring($image,20,10,$imagewidth-30," k= ".round($res['k'],6)." b= ".round($res['b'],3)." r2= ".round($res['r2'],3)." sd= ".round($res['dy'],4)." count= ".$res['count'],$textcolor);
                // }
                // else{
                //     imagestring($image,20,10,$imagewidth-30," r2= ".round($res['r2'],3)." sd= ".round($res['dy'],4)." count= ".$res['count'],$textcolor);
                // }
            }
            else{
                $px1=$tempx;
                $py1=$tempy;
            }
            imageellipse($image, 0.5*$imagelenth-$px1 ,$py1, 5, 5, $imagecolor);         
        }
        imagejpeg($image,$file); 
    }
}
//计算k b r2
function calckbr2($data=array()){
    $n=count($data);
    if ($n<2) {
        return array('calc' =>0);
    }
    $xsum=$ysum=$y2sum=$x2sum=$xysum=0;
    foreach ($data as $key => $value) {
        $xsum+=$key;
        $x2sum+=$key*$key;
        $ysum+=$value;
        $y2sum+=$value*$value;
        $xysum+=$value*$key;
    }
    $tmp=$n*$xysum-$xsum*$ysum;
    $kval=$tmp/($n*$x2sum-$xsum*$xsum);
    $bval=($ysum-$kval*$xsum)/$n;
    $r2val=$tmp/($n*$y2sum-$ysum*$ysum)*$kval;
    $dyval=sqrt(($y2sum*$n-$ysum*$ysum))/$n;
    //var_dump($dyval);
    return array('calc' =>1,'k' =>$kval,'b' =>$bval,'r2' =>$r2val,'dy'=>$dyval,'count' =>$n,);

}