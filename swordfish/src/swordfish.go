// Swordfish search server
// Copyright 2013 JiangMing. All rights reserved.
// QQ:415193711
// email:admin@exephp.com
// website:www.exephp.com

package main

import(
	"fmt"
	"flag"
)

var(
	indexStart = flag.Bool("index", false, "开始索引服务")
	searchStart = flag.Bool("search", false, "开启检索服务")
	configFilePath = flag.String("config", "/data/swordfish/config.json", "配置文件路径")
)

//系统初始化
func init(){
	copyright()
	initConfig()
	flag.Parse()
}

//Copyright
func copyright(){
	fmt.Println("Swordfish search server")
	fmt.Println("Copyright 2013 JiangMing. All rights reserved.")
	fmt.Println("易普工作室（http://www.exephp.com/）")
}
//初始化配置文件
func initConfig(){

}

func main(){
}
