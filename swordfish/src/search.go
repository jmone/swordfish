//检索服务
//TCP

package main

import(
	"fmt"
	"strings"
	"net"
	"encoding/json"
	"strconv"
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
	var stopwords Stopwords
	stopwords.Words = make(map[string] bool)
	stopwords.init()
	go stopwords.update()

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
		//数据传过来需要json解码
		dec := json.NewDecoder(strings.NewReader(input))
		type inputDataStruct struct{
			Input string
			Page int
			Size int
		}
		var inputData inputDataStruct
		err = dec.Decode(&inputData)
		fmt.Printf("%s %d %d\n-----------------\n", inputData.Input, inputData.Page, inputData.Size)
		//分词处理
		input = filter(inputData.Input)
		result := single_word_seg(input)
		result = dict_seg(result)

		docs := []string{}
		words := []string{}
		for _, word := range result{
			if(stopwords.IsStopword(word.Text) || word.Text == " "){
				fmt.Println(word.Text + " is stopword.")
				continue
			}
			fmt.Println(word.Text)
			//fmt.Println(i[Word(word.Text)])
			for docid, frequency := range i[Word(word.Text)]{
				docs = append(docs, string(docid))
				//fmt.Print(docid+":")
				//fmt.Println(frequency)
				docScoreMapping.scoring(string(docid), Word(word.Text), int(frequency))
			}
			words = append(words, word.Text)
		}
		scoreList.sort()
		fmt.Println(words)
		data := map[string][]string{}
		//data["docsid"] = docs[(inputData.Page-1)*inputData.Size : inputData.Size]
		startIndex := (inputData.Page-1)*inputData.Size;
		endIndex := inputData.Page*inputData.Size;
		//fmt.Println(len(scoreList))
		docs = []string{}
		for _, ds := range scoreList{
			//fmt.Println(ds.Id)
			docs = append(docs, string(ds.Id))
		}
		if(startIndex > len(docs)){
			data["docsid"] = docs[0:0]
		}else{
			if(endIndex > len(docs)){
				endIndex = len(docs)
			}
		fmt.Println(scoreList[startIndex:endIndex])
			data["docsid"] = docs[startIndex : endIndex]
		}
		data["words"] = words
		data["original"] = append(data["original"], input)
		data["original"] = append(data["original"], strconv.Itoa(len(docs)))
		data["original"] = append(data["original"], strconv.Itoa(inputData.Page))
		data["original"] = append(data["original"], strconv.Itoa(inputData.Size))
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
