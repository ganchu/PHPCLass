<?

$zip = new ZipArchive;
if ($zip->open('x.zip') === TRUE) {//压缩包名
	$zip->extractTo('./');//压缩包路径
	$zip->close();
}
