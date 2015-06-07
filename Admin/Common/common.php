<?php 
function now(){
	return date('Y-m-d H:i:s',time());	
}

function getThumbPath($path){
	return __ROOT__.ltrim($path,'.');
}