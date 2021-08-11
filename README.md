# 实现思路:

在 LocalSettings.php 判断是PC端入口，还是手机端入口;

给手机端单独一套皮肤，用正则将文件输出符合Amp格式;


1. 配置入口文件：mediawiki-1.27.3\LocalSettings.php
	A.新增： 方法isMobile() 	行数：19-76
	B.注释： 					行数206-217

2. 模板输出文件：mediawiki-1.27.3\includes\skins\QuickTemplate.php
	A.重构方法：function html( $str ) 	行数：112-335

3. 模板：mediawiki\skins\Example
	A.新增模板Example


# 参考链接 :

https://jamesqi.com/%E5%8D%9A%E5%AE%A2/MediaWiki%E7%BD%91%E7%AB%99%E6%B7%BB%E5%8A%A0AMP%E7%89%88%E6%9C%AC	
