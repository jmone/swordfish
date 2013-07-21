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
	DocId bson.ObjectId "_id"
	Title string
}
//获取原始文档数
func getOrigialDocCount() int{
	session, err := mgo.Dial("127.0.0.1")
	if err != nil{
		fmt.Println(err.Error())
	}
	defer session.Close()

	c := session.DB("swordfish").C("product")
	count, err := c.Count()
	//fmt.Println(count)
	return count
}
func getOrigialDoc(page int, size int) []OrigialDoc{
	session, err := mgo.Dial("127.0.0.1")
	if err != nil{
		fmt.Println("mgo dial fail")
	}
	defer session.Close()
	session.SetMode(mgo.Monotonic, true)
	c := session.DB("swordfish").C("product")
	result := []OrigialDoc{}
	err = c.Find(bson.M{}).Limit(size).Skip((page-1)*size).All(&result)
	//fmt.Println(result)
	return result
}

func main(){
	count := getOrigialDocCount()
	size := 1000
	totalPageNumber := count/size
	if count%size != 0{
		totalPageNumber += 1
	}
	fmt.Println(totalPageNumber)

	fmt.Println("待索引数据量：" + strconv.Itoa(int(count)))
	i := readIndex("sf.index")

	for page := 1; page <= totalPageNumber; page++{
		docs := getOrigialDoc(page, size)
		fmt.Println(page)
		for _, doc := range docs{
			text := filter(doc.Title)
			result := single_word_seg(text)
			result = dict_seg(result)
			dwp := new(DocWordsMapping)
			for _, word := range result{
				dwp.Words = append(dwp.Words, Word(word.Text))
			}
			//dwp.Id = Docid(doc.DocId.Hex())
			fmt.Println(dwp)
			i = updateIndex(*dwp, i)
			fmt.Println(doc)
			//fmt.Println(result)
		}
	}
	writeIndex(i, "sf.index")
	//fmt.Println(i)
}
