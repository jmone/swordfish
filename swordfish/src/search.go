//检索服务
//TCP

package main

import(
	"fmt"
	"strings"
	"net"
	"encoding/json"
	_ "strconv"
	"bytes"
)

type Words []string
type requestString string
//接收查询请求
func getRequestString() string{
	return ""
}
//分词处理，将请求解析为多个独立词语
func segmentationRequestString(requestString) Words{
	return nil
}
//根据索引找出每个词语对应的docid
func getDocids(){

}
//动态排序算法，计算doc对应的权重


func search(){
	//requestString := getRequestString()
	//words := segmentationRequestString(requestString)
	getDocids()
}

func work(){
	//fmt.Println("work.")
}

func main(){
	i := readIndex("sf.index")
	ln, err := net.Listen("tcp", ":8080")
	if err != nil{
		//
	}
	defer ln.Close()
	for{
		conn, err := ln.Accept()
		if err != nil{
			fmt.Println(err.Error())
			continue
		}
		buffer := make([]byte, 1024)
		size, err := conn.Read(buffer)
		if err != nil{
			fmt.Println(err.Error())
			continue
		}
		input := string(buffer[:size])
		input = strings.Replace(input, "\n", "", -1)
		result := single_word_seg(input)
		result = dict_seg(result)

		docs := []string{}
		words := []string{}
		for _, word := range result{
			fmt.Println(word.Text)
			//fmt.Println(i[Word(word.Text)])
			for docid, frequency := range i[Word(word.Text)]{
				docs = append(docs, string(docid))
				fmt.Print(docid+":")
				fmt.Println(frequency)
			}
			words = append(words, word.Text)
		}
		data := map[string][]string{}
		data["docsid"] = docs
		data["words"] = words
		fmt.Println(data)
		var w bytes.Buffer
		enc := json.NewEncoder(&w)
		err = enc.Encode(data)
		if err != nil{

		}
		fmt.Println(string(w.Bytes()))
		_, werr := conn.Write(w.Bytes())
		if werr != nil{
			fmt.Println(werr.Error())
		}else{
		}

		go work()
	}
}
