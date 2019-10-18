<html>
	<?php
			require_once '../excel_reader2.php';
	class SimpleClass
		{


			public $rdetsfull= 'COLLEGE';
			public $roomname= 'CSE';
			public $rowd = '5';
			public $cold = '5';
			public $currentpos=array();
			public $maxpos = '25';
			public $spt=3;   // SPECIFY THE NO OF STUDENTS PER TABLE
			public function getd($datss)
			{
				$this->rdetsfull = $datss;
				for($i=0;$i<$this->spt;$i++)
					$this->currentpos[$i]=0;
			}
			public function dispd()
			{
				echo "Test boom = \"$this->rdetsfull \"<br>";
				echo "Room Name = $this->roomname <br>";
				echo "Number of Rows = $this->rowd <br>";
				echo "Number of Columns = $this->cold <br>";
				echo "Current Pos =".$this->currentpos[0]." ".$this->currentpos[1]." ".$this->currentpos[2]." "."<br>";
			}
			public function procroomd()
			{
				list($this->roomname, $this->rowd, $this->cold) = explode("-",$this->rdetsfull);
				$this->maxpos=$this->rowd*$this->cold;
			}
			public function rname()
			{
				return $this->roomname;
			}
			public function rrowd()
			{
				return $this->rowd;
			}
			public function rcold()
			{
				return $this->cold;
			}
			public function rallcpos()
			{
				return $this->currentpos;
			}
			public function rcpos($num1)
			{
				return $this->currentpos[$num1];
			}
			public function icpos($num2)
			{
				$this->currentpos[$num2]++;
			}
			public function rmaxpos()
			{
				return $this->maxpos;
			}
			public function rminindex()
			{
				$index = array_search(min($this->currentpos), $this->currentpos);
				return $index;
			}
		}
		$aaa = array();
		function roomdetails($roomf)
		{
			$spt=3;   // SPECIFY THE NO OF STUDENTS PER TABLE
			$rooms = fopen($roomf, "r") or die("Unable to open file");
			while(!feof($rooms))
			{
				$rdets = fgets($rooms);
				$singleroom = explode(",", $rdets);
				for($i=0;$singleroom[$i]!=NULL;$i++)
				{
					//echo $singleroom[$i];
					$aaa[$i]= new SimpleClass();
					$aaa[$i]->getd($singleroom[$i]);
					$aaa[$i]->procroomd();
				}
			}
			fclose($rooms);
			$studentsub=array();
			$data = new Spreadsheet_Excel_Reader("../one.xls",false);
			$data->val(1, A);
			$data->dump(false, false, 0);
			$num_row = $data->rowcount() + 1;
			$index = 1;
			$studsub=array();
			
			while($index != $num_row)
			{
				echo"<tr>";
				
				$studsub[$index]=$data->val($index, 'A');
				echo $studsub[$index];echo'<br>';
				$index++;
			}
			$studentsub=array();
			$subfile= array('EC0001.txt','CS0002.txt','ME0003.txt','MA0001.txt','XX0006.txt');
			for($i=0; $i<count($subfile); $i++)
			{
				$tempfile[$i] = fopen($subfile[$i], "r") or die("Unable to open file");
				$sdets=fgets($tempfile[$i]);
				$studentsub[$i]=explode(",",$sdets);
				fclose($tempfile[$i]);
			}
			$seathold=array();
			$flag=0;


		$m=0;
$a=0;
$mini=0;
for($i=0; $i<count($subfile); $i++)
{

	$mini= $aaa[$m]->rminindex();
	while($aaa[$m]->rcpos($mini)>=$aaa[$m]->rmaxpos())
	{
		$mini= $aaa[$m]->rminindex();
		if($aaa[$m]->rcpos($mini)<$aaa[$m]->rmaxpos())
			break;
		$m++;
	}

		for($j=0; $j<count($studentsub[$i]);$j++)
		{
			$a=$aaa[$m]->rcpos($mini);
			$seathold[$m][$a][$mini]= $studentsub[$i][$j];
			$a++;
			$aaa[$m]->icpos($mini);
			if($a>=$aaa[$m]->rmaxpos())
			{
				$a=0;
				$m++;
			}
		}

	$m=0;
	$a=0;
	$mini=0;
}


			//		TABLE AREA
			echo "<br><br><br><br>";
			for($m=0;$m<count($aaa);$m++)
			{
				$LOC=0;
				echo "<center>CLASS: ". $aaa[$m]->rname()."<br><br>";
				echo "<table border=0 width = 1200>";
				for($i=0; $i<$aaa[$m]->rrowd(); $i++)
				{

					echo "<tr>";
					for($j=0; $j <$aaa[$m]->rcold(); $j++)
					{
						echo "<td>";
						$LOC=$j*$aaa[$m]->rrowd()+$i;

						echo "<table border=1 width=220> <tr>";
						for($x=0; $x<$spt ;$x++)
							echo "<td width=80 height = 30> ".$seathold[$m][$LOC][$x]." <br></td>";

						echo "</tr></table>";

						echo "</td>";
					}

					echo "</tr>";
				}
				echo "</table><br><br></center>";
			}

			fclose($rooms);
		}
	?>
	<body>
		<?php
			$roomdata= "rooms.txt";
			@roomdetails($roomdata); // NOTICE [errors] HANDLED WITH @ SYMBOL
		?>
	</body>
</html>
