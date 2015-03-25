<?php
function get_rewards($rewards = null){
	$rewards = explode(',', $rewards);
	$full_reward_list = array();
    foreach ($rewards as $reward) {
        list($reward, $multiplier) = explode('*', $reward);
        if (!$reward) continue;
        $rewardList[$reward] += $multiplier;
        $totalMultiplier += $multiplier;
    }
    foreach ($rewardList as $reward => $multiplier)
        $full_reward_list = array_merge($full_reward_list, array_fill(0, $multiplier, $reward));
	
	foreach ($rewardList as $reward => $multiplier) {
		if ( round($totalMultiplier / $multiplier) > 10000)
			$percentage = '<0.01%';
		else
			$percentage = rtrim(rtrim(number_format($multiplier / $totalMultiplier * 100, 2), '0'), '.') . '%';
		$result[$reward] =$percentage;
	}
	return $result;
}

function chance_creator($entrance){
	$rewards = explode(',', $entrance);
	$full_reward_list = array();
    foreach ($rewards as $reward) {
        list($reward, $multiplier) = explode('*', $reward);
        if (!$reward) continue;
        $rewardList[$reward] += $multiplier;
        $totalMultiplier += $multiplier;
    }
    foreach ($rewardList as $reward => $multiplier)
        $full_reward_list = array_merge($full_reward_list, array_fill(0, $multiplier, $reward));
    $result = $full_reward_list[mt_rand(0, count($full_reward_list) - 1)];
	return $result;
}

function get_ip(){
    if ($GLOBALS['settings']['behind_proxy']) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $_SERVER['HTTP_X_FORWARDED_FOR'] = array_pop($ipList);
        } else {
            $_SERVER['HTTP_X_FORWARDED_FOR'] = false;
        }

        if (filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    return $_SERVER['REMOTE_ADDR'];
}


?>