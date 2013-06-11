package main

import(
	"fmt"
	"path/filepath"
	"encoding/gob"
	"io/ioutil"
	"bytes"
)

type Word string
type Docid string
type Frequency uint
type DocWordsMapping struct{
	Id Docid
	Words []Word
}
type Index map[Word]map[Docid]Frequency

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
func updateIndex(mapping DocWordsMapping, index Index) Index{
	for _, word := range mapping.Words{
		if index[word] == nil{
			index[word] = make(map[Docid]Frequency)
		}
		index[word][mapping.Id]++
	}
	return index
}

//合并索引
//将新索引newIndex与index合并
func mergeIndex(index Index, newIndex Index) Index{
	return nil
}

//清除废弃的索引
//将废弃的索引wasteIndex从主索引中清除
func clearIndex(index Index, wasteIndex Index) Index{
	return nil
}

//索引滤重
func duplicateDocIdRemove(index Index) Index{
	return index
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

/*
func main(){
	doc := DocWordsMapping{Id:"1000", Words:[]Word{"hello", "world"}}
	fmt.Println(doc)
	i := readIndex("sf.index")
	fmt.Println(i)
	i = updateIndex(doc, i)
	fmt.Println(i)
	i["girls"] = map[Docid]Frequency{"Doc001":1, "Doc002":5}
	writeIndex(i, "sf.index")
}
*/
