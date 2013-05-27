//检索服务
//TCP

package main

import(
	"fmt"
	"strings"
	"net"
	_ "strconv"
)

type Words []string
//接收查询请求
func getRequestString() string{
	return ""
}
//分词处理，将请求解析为多个独立词语
func segmentationRequestString(requestString) Words{
	words := make(Words)
	return words
}
//根据索引找出每个词语对应的docid
func getDocids(){

}
//动态排序算法，计算doc对应的权重


func search(){
	requestString := getRequestString()
	words := segmentationRequestString(requestString)
	getDocids()
}
