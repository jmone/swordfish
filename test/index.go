package main

import "fmt"
type word string
type docid string
type frequency uint
//type wordFrequency map[docid][frequency]
//type Index map[word][]docid
type Index map[word]map[docid]frequency

func main(){
	index := make(Index)
	index["hello"] = map[docid]frequency{"Doc0001":10, "Doc0003":3}
	index["girls"] = map[docid]frequency{"Doc001":1, "Doc002":5}
	fmt.Println(index)
	fmt.Println(index["hello"]["Doc0005"] == 0)
}
