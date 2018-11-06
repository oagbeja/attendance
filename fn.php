<?php
	function mthnumdays($a,$b)
	{
		switch((int)$a)
		{
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12: return 31;
			case 4:
			case 6:
			case 9:
			case 11: return 30;
			case 2:  return leap($b);
			default: return 'NONE';
				 
		}
	}
	function leap($b)
	{
		if ((int)($b)%4 == 0)
		{
			return 29;
		}else
		{
			return 28;
		}
	}
	function mth($a)
	{
		switch((int)$a)
		{
			case 1:return 'JAN';
			case 2:return 'FEB';
			case 3:return 'MAR';
			case 4:return 'APR';
			case 5:return 'MAY';
			case 6:return 'JUN';
			case 7:return 'JUL';
			case 8:return 'AUG';
			case 9:return 'SEP';
			case 10:return 'OCT';
			case 11:return 'NOV';
			case 12:return 'DEC';
			default: return 'NONE';
				 
		}
	}
?>