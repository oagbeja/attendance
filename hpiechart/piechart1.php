<?php

	$img_height=400;
	$img_width=500;
	$radious=150;
	$bar_width=4;
	//$i=0;
	$pfullnam=explode(',',$_REQUEST['pitems']);
	$itemnam=explode(',',$_REQUEST['abbritems']);
	$itemval=explode(',',$_REQUEST['pvalues']);
	for($i=0;$i<count($itemnam);$i++)
	{
		$itemnam[$i]=strtoupper($itemnam[$i]);
	}
	
	include 'piecolor.php';
	include("pChart/pData.class");
	include("pChart/pChart.class");
	//$count=count($maxval);
	
	 // Dataset definition 
	 $DataSet = new pData;
	 $DataSet->AddPoint($itemval,"Serie1");
	 //print_r($DataSet);
	 $DataSet->AddPoint($itemnam,"Serie2");
	 $DataSet->AddAllSeries();
	 $DataSet->SetAbsciseLabelSerie("Serie2");
	 // Initialise the graph
	 $Test = new pChart($img_width,$img_height);
	 $Test->drawFilledRoundedRectangle(4,0,$img_width-5,$img_height,5,$baground_colr,$baground_colg,$baground_colb);//225,144,82);
	 $Test->drawRoundedRectangle(5,0,$img_width-5,$img_height,5,$baground_colr,$baground_colg,$baground_colb);
	 $Test->createColorGradientPalette(255,204,56,223,1,2,1);
	
	// Draw the pie chart
	 $Test->setFontProperties("Fonts/tahoma.ttf",8);
	 $Test->AntialiasQuality = 0;
	 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),$img_width/2,$img_height/2,$radious,PIE_PERCENTAGE_LABEL,FALSE,50,20,5,"",$txtcolr,$txtcolg,$txtcolb);
	 $Test->drawPieLegend($img_width-65,20,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
	
	 // Write the title
	 $Test->setFontProperties("Fonts/tahoma.ttf",12);
	 $Test->drawTitle(($img_width-50)/2,20,$title,$titcolr,$titcolg,$titcolb);
	 $today=getdate();
	 $img="chart/piechart".$today['year'].$today['month'].$today['mday'].$today['hours'].$today['minutes'].$today['seconds'].".png";
	 //echo $img;
	 $Test->Render($img);
	 
	
?>
    <table cellspacing="0" cellpadding="2">
      <tr>
      	<td align="center"><font size="+1"><?php echo strtoupper($_REQUEST['ptitle']);?></font> </td>
      </tr>
      <tr>
        <td>
        	<?php echo '<img src='.$img.' >';?>
        </td>
        <td valign="top">
        	<table border="1" cellspacing="0" cellpadding="2">
              <tr>
                <td colspan="2"><strong>Legends</strong></td>
              </tr>
              
              	<?php
					for($i=0;$i<count($pfullnam);$i++)
					{
					?><tr>
                        <td><?php echo strtoupper($itemnam[$i])?></td>
                        <td><?php echo ucwords(strtolower($pfullnam[$i]))?></td>
                       </tr><?php
					}?>
              
            </table>

        </td>
      </tr>
    </table>
