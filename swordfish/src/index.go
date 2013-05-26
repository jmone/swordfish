package main

import(
	"fmt"
	"strconv"
	"path/filepath"
	"encoding/gob"
	"io/ioutil"
	"bytes"
)

type DocWordsMapping struct{
	Docid uint
	Words []string
}
type Index map[string][]string

//读取索引文件
//将索引文件读到内存
func readIndex(path string) Index{
	matches, err := filepath.Glob(path)
	if err != nil{
		fmt.Println(err.Error())
	}else if matches == nil{
		fmt.Println(path+" is not exists.")
	}
	index := make(Index)
	bytesIndex, _ := ioutil.ReadFile(path)
	bufIndex := bytes.NewBuffer(bytesIndex)
	dec := gob.NewDecoder(bufIndex)
	err = dec.Decode(&index)
	return index
}

//更新索引
//向主索引中添加新的DocWordsMapping
func updateIndex(mapping DocWordsMapping, index Index){

}

//合并索引
//将新索引newIndex与index合并
func mergeIndex(index Index, newIndex Index) Index{

}

//清除废弃的索引
//将废弃的索引wasteIndex从主索引中清除
func clearIndex(index Index, wasteIndex Index) Index{

}

//持久化
//将内存中的索引内容存储到文件
func writeIndex(index Index, path string) bool{
	var w bytes.Buffer
	enc := gob.NewEncoder(&w)
	err := enc.Encode(index)
	if err != nil{
		fmt.Println(err.Error())
		return false
	}
	err = ioutil.WriteFile(path, w.Bytes(), 0644)
	if err != nil{
		fmt.Println(err.Error())
		return false
	}
	return true
}

func main(){
	doc1 := []string{"hello", "test", "okay"}
	doc2 := []string{"hello", "world", "word", "golang"}
	doc3 := DocWordsMapping{Docid:1000, Words:[]string{"hello", "world"}}
	words := []string{}
	for i:=1; i<10; i++{
		words = append(words, "word_"+strconv.Itoa(i))
	}
	doc4 := DocWordsMapping{Docid:119, Words:words}
	//index := map[string][]int{}
	//index["hello"] = []int{1,2}
	//index["test"] = []int{1}
	fmt.Println()
	fmt.Println(doc1)
	fmt.Println(doc2)
	fmt.Println(doc3)
	fmt.Println()
	fmt.Println(doc4)
	index := map[string][]string{}
	index["hello"] = []string{"1","2","3"}
	index["test"] = []string{"5","7", "9"}
	for _, doc2word := range doc2{
		index["test"] = append(index["test"], doc2word)
	}
	fmt.Println(index)
	fmt.Println()
	fmt.Println()
	fmt.Println()
	fmt.Println()
	i := readIndex("swordfish.index")
	fmt.Println(i)
	i["China"] = []string{"中国", "Chinese", "zhong guo"}
	writeIndex(i, "swordfish.index")
}
