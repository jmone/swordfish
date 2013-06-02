// Swordfish search server
// Copyright 2013 JiangMing. All rights reserved.
// QQ:415193711
// email:admin@exephp.com
// website:www.exephp.com

package main

import(
	"fmt"
	"flag"
	"labix.org/v2/mgo"
	"labix.org/v2/mgo/bson"
	"pkg/strconv"
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
	fmt.Println()
}
//初始化配置文件
func initConfig(){

}

type OrigialDoc struct{
	Title string
}
func getOrigialDocCount() uint{
	return 100
}
func getOrigialDoc() []OrigialDoc{
	session, err := mgo.Dial("127.0.0.1")
	if err != nil{
		fmt.Println("mgo dial fail")
	}
	defer session.Close()
	session.SetMode(mgo.Monotonic, true)
	c := session.DB("swordfish").C("product")
	result := []OrigialDoc{}
	err = c.Find(bson.M{}).Limit(100).All(&result)
	//fmt.Println(result)
	return result
}

func main(){
	count := getOrigialDocCount()
	fmt.Println("待索引数据量：" + strconv.Itoa(int(count)))
	docs := getOrigialDoc()
	for _, doc := range docs{
		//fmt.Println(doc.Title)
		text := filter(doc.Title)
		result := single_word_seg(text)
		result = dict_seg(result)
		fmt.Println(result)
	}
}
