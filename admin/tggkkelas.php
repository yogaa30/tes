<html>
<head>
<title>Storan Bulan <?php ?></title>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function printPage() {
if (window.print) {
agree = confirm('Apakah Akan Mencetak ? > Klik OK');
if (agree) window.print();
   }
}
//  End -->
</script>

<style><!--
body { color:gray(0,0,0); font-family:����;}
th { color:rgb(0,0,0); font-family:����;}
td { color:rgb(0,0,0); font-family:����;}
h1 { color:rgb(0,0,0); font-size:12pt; font-family:����;}
h2 { color:rgb(0,0,0); font-size:12pt; font-family:����;}
p.namo-list { color:rgb(0,128,0); font-size:12pt; font-family:����;}
p.namo-sublist { color:rgb(26,89,54); font-size:10pt; font-family:����;}
a:link {}
a:visited {}
a:active {}
--></style>
</head>
<body OnLoad="printPage();" bgcolor="white" text="black" link="#1A5936" vlink="gray" alink="#857956">
<script language="javascript">setTimeout("self.close();",2000000)</script>
<font size='3' face='arial'align='center'><u></u><?php echo "$view_nilai[bulan]"?></font>
<br>
<?php
 $day=array("MINGGU","SENIN","SELASA","RABU","KAMIS","JUM'AT","SABTU");
 $bl=array("JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
 $d=date("w");
 $b=date("n");
 $hari=$day[$d];
 //$tanggal=date("d")." ".$bl[($b-1)].date("  Y");
 $tanggal=date("  Y");
 $tggl=date("  Y").date("  Y" )+(1);
 ?>
<?php
include "headerprint.php";
include("connect.php");
$params=$_GET['idkelas'];
	$param=explode('_',$params);
	$kelas=$param[0];
	$sems=$param[1];
	$q_kelas="SELECT * from stor INNER JOIN kelas ON kelas.id_kelas=stor.id_kelas where kelas='$kelas' and stor.semester='$sems'";
	$hasil2=mysql_query($q_kelas,$koneksi);
	$data2=mysql_fetch_array($hasil2);
	$q_nilai3="SELECT*from kelas where id_kelas='$kelas'";
	$hasil3=mysql_query($q_nilai3,$koneksi);
	$data3=mysql_fetch_array($hasil3);
	
	?>

	<h1>Laporan Tunggakan Per-Kelas</h1>		
	<table border="0" width="80%" id="table1" height="80" align="left" class= "table-form">
	<tr><td height="37" colspan="2" align="left"><font face="Arial" size="2"><b>Kelas    </font></td>
	  <td width="75%" height="37" align="left"><font face="Arial" size="3">:<?php echo" $kelas";?></font></td>
	  <tr><td height="37" colspan="2" align="left"><font face="Arial" size="2"><b>Semester    </font></td>
	  <td width="75%" height="37" align="left"><font face="Arial" size="3">:<?php echo" $sems";?></font></td>
	
	
<?php
	
	//$sql_kelas = "select walikelas from kelas where id_kelas='$id_kelas'";
	//$hasil_kelas = mysql_query($sql_kelas,$koneksi);
		
	$q_nilai1="SELECT id_bayar,bulan,id_kelas FROM stor INNER JOIN bulan ON 
	bulan.id_bulan = stor.id_bulan WHERE kelas='$kelas'AND semester='$sems' ORDER by stor.id_bulan ASC";
	$hasil1=mysql_query($q_nilai1,$koneksi);
	//$q_nis="SELECT nis sum(bayar) as dibayar from stor GROUP BY nis ";
	$q_nilai="SELECT nis,bayar ,SUM(bayar) as total,id_kelas,bln,SUM(bln) as kelase,id_bulan,semester  from stor where id_kelas='$kelas' and semester='$sems' GROUP BY nis";
	$q_sortir="SELECT nis,bayar ,SUM(bayar) as total,id_kelas,bln,SUM(bln) as kelase,id_bulan,semester  from stor where id_kelas='$kelas' and semester='$sems' GROUP By bayar";

	$tot=mysql_query($q_sortir,$koneksi);
	//$nise=mysql_query($q_nis,$koneksi);
	//$akhir=mysql_fetch_array($nise);
	//$totale += $akhir['dibayar'];
	$hasil=mysql_query($q_nilai,$koneksi);
	 $data1=mysql_fetch_array($tot);
	//print("<a href=\"nilaidetail.php?idn=$data[id_nilai]\">$data[matapelajaran]</a>");
		//print("<br/>");	
	//}	
	
		print("<table width=640 border=1 class=table-common>
		<tr>
			<th>NO</th>
			<th >NIS</th>
			<th >NAMA</th>
		    <th >IURAN / BULAN</th>
			<th >JML TUNGGAKKAN</th>
			<th >TOTAL TUNGGAKKAN</th>
			");
    	print("</tr>");	
	
	// banyaknya baris per halaman 
 		$rowsPerPage = 20; 
 		// halaman pertama atau default
 		$pageNum = 1; 
 		// digunakan untuk mengambil page number 
 		if(isset($_GET['page'])) { 
    		$pageNum = $_GET['page']; 
 		} 
 		// menambah offset 
 		$offset = ($pageNum - 1) * $rowsPerPage; 
	
	//while($data=mysql_fetch_array($hasil_siswa))
	$no=1;	
	$jml=$data[bayar];
	
	$tgl=date('d-M-Y');
	$q_stor1="SELECt * from tunggakan 
	INNER JOIN kelas on kelas.spp
	INNER JOIN siswa ON siswa.nis
	Where tunggakan.id_kelas='$kelas'AND tunggakan.semester='$sems' group by tunggakan.nis"; 
	$storan1=mysql_query($q_stor1,$koneksi);
	while($datal=mysql_fetch_array($storan1))
				{
			print("<tr>
				<td align='center'>$no</td>
			    <td align='left'>$datal[nis]</td>
				<td align='left'>$datal[nama]</td>
				<td align='center'>".number_format ($datal[spp],2,",",".")."</td>
				<td align='center'>".number_format ($datal[jml_bln_tunggakan],0,",",".").". Bulan</td>
				<td align='center'><font color='#464646'> <b>Rp. ".number_format ($datal[jml_tunggakkan] ,2,",",".")."</b></td>
				
				");
    	print("</tr>");
		$no++;
		}
					
		
		print("</table>");
		
		print("<table width=640 border=1 class=table-common>
				<tr>");
		
		print("</tr>");
		
		$query   = "SELECT COUNT(*) AS numrows FROM stor where nis='$nis'"; 
  		$result  = mysql_query($query); 
  		$row     = mysql_fetch_array($result); 
  		$numrows = $row['numrows']; 
		$q_jml="SELECT id_tunggakkan,jml_bln_tunggakan,jml_tunggakkan,SUM(jml_tunggakkan) as total,siswa.nis,nama,spp from tunggakan 
		INNER JOIN kelas ON kelas.spp 
		INNER JOIN siswa ON siswa.nis
		Where tunggakan.id_kelas='$kelas'AND tunggakan.semester='$sems' group by siswa.nis"; 
		$stot=mysql_query($q_jml,$koneksi);
		$dat=mysql_fetch_array($stot);
	$pilih_kelas=mysql_fetch_array($hasil_kelas);
		print("<tr>");
		print("<tr>");
		
		print("</table>");
		print("<table width=640 border=1 class=table-common>
				<tr>
				<td align='center'><b>TOTAL TUNGGAKAN</b></td>
				<td align='center'><b>Rp. ".number_format ($dat[total] ,2,",",".")."</b></td>
				
				");
		
		print("</table>");
		
			
				
		print("</tr>");		
		print("</table>");
		
		
	/*	
		// banyaknya row yang ada dalam database 
  		$query   = "SELECT COUNT(*) AS numrows FROM stor where id_kelas='$kelas'"; 
  		$result  = mysql_query($query); 
  		$row     = mysql_fetch_array($result); 
  		$numrows = $row['numrows']; 
    	// banyaknya halaman yang dipunyai yang digunakan paging 
  		$maxPage = ceil($numrows/$rowsPerPage); 
  		$self = $_SERVER['PHP_SELF']; 
	
	
	
	
 		// membuat link 'previous' dan 'next'  
 		if ($pageNum > 1) 
 		{ 
    		$page = $pageNum - 1; 
			print(" <a href=\"$self?page=1\">[First Page]</a> "); 
    		print(" <a href=\"$self?page=$page\">[Prev]</a> "); 
        }	
  		else 
 		{ 
    		print(" [First Page] "); 
			print(" [Prev] ");       
 		} 
	
  		if ($pageNum < $maxPage) 
  		{ 
    		$page = $pageNum + 1; 
    		print(" <a href=\"$self?page=$page\">[Next]</a> "); 
        	print(" <a href=\"$self?page=$maxPage\">[Last Page]</a> "); 
  		}  
   		else 
  		{ 
    		print(" [Next] ");       
    		print(" [Last Page] ");  
  		}
*/
?>
	<p align="right">Bontang, <?php echo"$tgl";?><br><br><br><br>..........................</b></p>
	<p><a href="laporan.php"><input type="submit" name="exit" value="Back" class="button" /></a>
	</p>                     
        <td width="1%"></td>
	</tr>
	</table>
	<p>&nbsp;</p></td>
	</center></p>
	
            
    </div>
	</div>
<?php
	//include "menu.php";
?>

