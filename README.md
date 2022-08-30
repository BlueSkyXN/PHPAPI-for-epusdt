# PHPAPI-for-epusdt
PHP API 对接 Epusdt。极简代码，极速部署，狗都会用

本作的核心用途是用最简单的方式发起Epusdt支付请求，无需回调、管理、历史查询等无意义因素，符合个人应用场景

Epusdt项目地址 https://github.com/assimon/epusdt

注意本项目不支持中国大陆或其他限制加密货币的地区的用户、商户使用、应用、改写、模仿。

# TRON/TRX/TRC20网络和USDT相关知识
## 加密货币电子钱包介绍
https://www.blueskyxn.com/202207/6247.html
## 中心化交易所技术介绍 
① https://www.patreon.com/posts/71104280
本篇已更新的内容包括：Kraken、Okcoin、FTXUS、NEXO、FTX

② https://www.patreon.com/posts/71106578
本篇已更新的内容包括：Liquid、bitfinex、binance、okex、Huobi、MEXC、Kucoin、gateio、bybit、coinbase、cryptocom、paxos、cexio、advcash

# 风险披露与警告

## 法律风险披露与警告

仅供学习PHP对JSON的处理和PHP对接HTTP API的应用，请在24小时内删除。

不得用于中国大陆或其他限制加密货币的地区，不得用于企业、商业用途。

不得违反PRC、USA的相关法律法规。

请阅读《关于进一步防范和处置虚拟货币交易炒作风险的通知》 https://www.spp.gov.cn/spp/zdgz/202109/t20210924_530777.shtml

加密货币不具有与法定货币等同的法律地位、不具有法偿性、不应且不能作为货币在市场上流通使用

加密货币没有FDIC保险、无银行担保、可能贬值、可能归零、可能跑路、可能无法使用、可能被限制

使用或学习本代码的相关网站应主动阻止中国大陆IP访问、阻止中国大陆用户访问，直到清除相关代码

因为作者即本人，仅完成代码的开发和开源活动(开源即任何人都可以下载使用或修改分发)，从未参与用户的任何运营和盈利活动。

且不知晓用户后续将程序源代码用于何种用途，故用户使用过程中所带来的任何法律责任即由用户自己承担。

## 信息和其他安全风险披露与警告
未参与Epusdt、NGINX、MySQL等软件的核心代码开发

无法保证相关软件的安全性、可靠性、稳定性，请自行抉择

可能存在信息和其他安全相关信息泄露的风险

造成的任何损失由使用者自负

# 使用方法v0.1
只需要修改【】内的数据就能用

也可以进行学习性质的修改，比如修改Line 65的获取传输参数

根据相关法律法规，暂不提供相关前端对接页面

不得用于商业和非法用途，具体请阅读License

代码解读、设计思路等请阅读我的博客 https://www.blueskyxn.com/202204/5884.html

发起订单的方法是访问 https://your.domain/upay.php?n=88 【域名、文件名、金额等均可自定义】

体验地址 https://pay.skyit.uk/upay.php?n=50

## 使用方法v0.2
新增Post版本的PHP+HTML前后端，同时兼容v0.1的n参数

体验地址 https://pay.skyit.uk/upay.html
