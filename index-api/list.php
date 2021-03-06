<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2018-12-28 21:08:17
 * @version $Id$
 */
require_once '../functions.php';


//得到客户端传递过来的分页页码 
$page = empty($_GET['page']) ? 1:intval($_GET['page']);

$length=10;
$skip=($page-1) * $length;

//查询所有的评论数据
$sql=sprintf("select 
	comments.*,
	posts.title as post_title 
	from comments 
inner join posts on comments.post_id=posts.id
ORDER BY comments.created DESC
LIMIT %d,%d;",$skip,$length);
$comments=xiu_fetch($sql);

$total_count=xiu_fetch_one("select count(1) as num from comments inner join posts on comments.post_id=posts.id;")['num'];
$totalPages = ceil($total_count/$length);
//虽然返回的数据类型是float 但是数字一定是一个整数


//因为网络之间传输的只能是字符串
//所有我们先将数据转换成字符串(序列化)
$json = json_encode(array(
	'totalPages' => $totalPages,
	'comments' => $comments
));

//设置响应的响应体是json
header('Content-Type:application/json');
//响应给客户端
echo $json;

