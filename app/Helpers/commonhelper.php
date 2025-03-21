<?php 

function get_balance($id)
{
	$record = App\Models\User::Where('id',$id)->get();	
	if($record->isNotEmpty()){
		return $record[0]->balance;
	} else {
		return 0;
	}
}

function referralCode($num)
{
	$code = Str::upper('CS'.Str::random($num));
	$exist = App\Models\User::Where('referral_code', $code)->count();
	if($exist)
		$this->referralCode($num);
	else
		return $code;
}

function referralCodeDriver($num)
{
	$code = Str::upper('DV'.Str::random($num));
	$exist = App\Models\Driver::Where('referral_code', $code)->count();
	if($exist)
		$this->referralCodeDriver($num);
	else
		return $code;
}